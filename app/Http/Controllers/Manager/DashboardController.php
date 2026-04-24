<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Member;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $startOfMonth = Carbon::now()->startOfMonth();

        // Stats
        $todayRevenue = Transaction::whereDate('created_at', $today)->completed()->sum('total_amount');
        $yesterdayRevenue = Transaction::whereDate('created_at', $yesterday)->completed()->sum('total_amount');
        $revenueGrowth = $yesterdayRevenue > 0 ? (($todayRevenue - $yesterdayRevenue) / $yesterdayRevenue) * 100 : 0;

        $todayTransactions = Transaction::whereDate('created_at', $today)->completed()->count();
        $yesterdayTransactions = Transaction::whereDate('created_at', $yesterday)->completed()->count();
        $txGrowth = $yesterdayTransactions > 0 ? (($todayTransactions - $yesterdayTransactions) / $yesterdayTransactions) * 100 : 0;

        $totalMembers = Member::count();
        $newMembersThisMonth = Member::where('created_at', '>=', $startOfMonth)->count();

        $activePromotions = Promotion::where('is_active', true)
            ->where(function($q) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', Carbon::now());
            })->count();

        // Chart Data (7 Days)
        $salesChartData = $this->getSalesChartData();

        // Top Products
        $topProducts = Product::select('products.*')
            ->join('transaction_details', 'products.id', '=', 'transaction_details.product_id')
            ->join('transactions', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->where('transactions.payment_status', 'completed')
            ->selectRaw('SUM(transaction_details.quantity) as total_sold')
            ->selectRaw('SUM(transaction_details.subtotal) as revenue')
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();

        // Recent Promotions
        $recentPromotions = Promotion::latest()->limit(5)->get();

        return view('manager.dashboard', compact(
            'todayRevenue', 'revenueGrowth', 
            'todayTransactions', 'txGrowth',
            'totalMembers', 'newMembersThisMonth',
            'activePromotions', 'salesChartData',
            'topProducts', 'recentPromotions'
        ));
    }

    public function chartData(Request $request)
    {
        $days = (int) $request->get('days', 7);
        $data = $this->getSalesChartData($days);
        return response()->json($data);
    }

    private function getSalesChartData(int $days = 7)
    {
        $dateLabels = collect();
        for ($i = $days - 1; $i >= 0; $i--) {
            $dateLabels->push(Carbon::now()->subDays($i)->format('Y-m-d'));
        }

        $sales = Transaction::where('created_at', '>=', Carbon::now()->subDays($days - 1)->startOfDay())
            ->completed()
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_amount) as revenue'),
                DB::raw('COUNT(*) as transactions')
            )
            ->groupBy('date')
            ->get()
            ->keyBy('date');

        return [
            'labels' => $dateLabels->map(fn($d) => Carbon::parse($d)->isoFormat('DD MMM'))->toArray(),
            'revenue' => $dateLabels->map(fn($d) => (float)($sales->get($d)->revenue ?? 0))->toArray(),
            'transactions' => $dateLabels->map(fn($d) => (int)($sales->get($d)->transactions ?? 0))->toArray(),
        ];
    }
}
