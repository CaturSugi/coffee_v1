<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today     = Carbon::today();
        $yesterday = Carbon::yesterday();

        /* ── Today's revenue & transactions ── */
        $todayRevenue       = Transaction::whereDate('created_at', $today)->where('payment_status', 'completed')->sum('total_amount');
        $yesterdayRevenue   = Transaction::whereDate('created_at', $yesterday)->where('payment_status', 'completed')->sum('total_amount');
        $todayTransactions  = Transaction::whereDate('created_at', $today)->count();
        $yesterdayTxCount   = Transaction::whereDate('created_at', $yesterday)->count();

        $revenueGrowth = $yesterdayRevenue > 0
            ? round((($todayRevenue - $yesterdayRevenue) / $yesterdayRevenue) * 100, 1)
            : ($todayRevenue > 0 ? 100 : 0);

        $txGrowth = $yesterdayTxCount > 0
            ? round((($todayTransactions - $yesterdayTxCount) / $yesterdayTxCount) * 100, 1)
            : ($todayTransactions > 0 ? 100 : 0);

        /* ── Members ── */
        $totalMembers       = Member::count();
        $newMembersThisMonth = Member::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();

        /* ── Products ── */
        $totalProducts = Product::where('is_active', true)->count();
        $lowStockCount = Product::where('is_active', true)->whereColumn('stock', '<=', 'min_stock')->count();

        /* ── 7-day chart data ── */
        $salesChartData = $this->buildSalesChartData(7);

        /* ── Payment method breakdown (this month) ── */
        $paymentMethods = $this->buildPaymentMethods();

        /* ── Recent transactions ── */
        $recentTransactions = Transaction::with('user')
            ->orderByDesc('created_at')
            ->take(8)
            ->get();

        /* ── Top 5 products (all time) ── */
        $topProducts = DB::table('transaction_details')
            ->join('products', 'products.id', '=', 'transaction_details.product_id')
            ->join('transactions', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->where('transactions.payment_status', 'completed')
            ->select(
                'products.id',
                'products.name',
                DB::raw('SUM(transaction_details.quantity) as total_sold'),
                DB::raw('SUM(transaction_details.subtotal)  as revenue')
            )
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'todayRevenue', 'todayTransactions',
            'revenueGrowth', 'txGrowth',
            'totalMembers', 'newMembersThisMonth',
            'totalProducts', 'lowStockCount',
            'salesChartData', 'paymentMethods',
            'recentTransactions', 'topProducts'
        ));
    }

    /* ── AJAX: fetch chart data ── */
    public function chartData(\Illuminate\Http\Request $request)
    {
        $days = $request->get('days', 7);
        $data = $this->buildSalesChartData((int) $days);
        return response()->json($data);
    }

    /* ── Helper: build last N days chart data ── */
    private function buildSalesChartData(int $days): array
    {
        $labels       = [];
        $revenue      = [];
        $transactions = [];

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $labels[] = $date->isoFormat('D MMM');

            $stats = Transaction::whereDate('created_at', $date)
                ->where('payment_status', 'completed')
                ->select(
                    DB::raw('SUM(total_amount) as total_revenue'),
                    DB::raw('COUNT(*) as total_tx')
                )
                ->first();

            $revenue[]      = (float) ($stats->total_revenue ?? 0);
            $transactions[] = (int)   ($stats->total_tx ?? 0);
        }

        return compact('labels', 'revenue', 'transactions');
    }

    /* ── Helper: payment method breakdown ── */
    private function buildPaymentMethods(): array
    {
        $total = Transaction::whereMonth('created_at', now()->month)
            ->where('payment_status', 'completed')
            ->count();

        $methods = [
            ['key' => 'cash',     'label' => 'Tunai',    'color' => '#f97316'],
            ['key' => 'qris',     'label' => 'QRIS',     'color' => '#3b82f6'],
            ['key' => 'card',     'label' => 'Kartu',    'color' => '#a855f7'],
            ['key' => 'e-wallet', 'label' => 'E-Wallet', 'color' => '#22c55e'],
        ];

        return collect($methods)->map(function ($m) use ($total) {
            $count = Transaction::whereMonth('created_at', now()->month)
                ->where('payment_status', 'completed')
                ->where('payment_method', $m['key'])
                ->count();

            return array_merge($m, [
                'count'   => $count,
                'percent' => $total > 0 ? round(($count / $total) * 100) : 0,
            ]);
        })->all();
    }
}

