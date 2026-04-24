<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Member;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function dashboard(Request $request)
    {
        return $this->sales($request);
    }

    public function sales(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));

        $query = Transaction::completed()
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);

        $transactions = $query->latest()->paginate(15)->withQueryString();
        
        // Summary Stats
        $totalRevenue = $query->sum('total_amount');
        $totalTransactions = $query->count();
        $avgTransaction = $totalTransactions > 0 ? $totalRevenue / $totalTransactions : 0;
        $totalItems = TransactionDetail::whereHas('transaction', function($q) use ($startDate, $endDate) {
            $q->completed()->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        })->sum('quantity');

        // Chart Data (Sales per day)
        $chartData = Transaction::completed()
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.reports.sales', compact(
            'transactions', 'totalRevenue', 'totalTransactions', 'avgTransaction', 'totalItems', 'startDate', 'endDate', 'chartData'
        ));
    }

    public function products(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));

        $products = TransactionDetail::whereHas('transaction', function($q) use ($startDate, $endDate) {
                $q->completed()->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            })
            ->select('product_id', DB::raw('SUM(quantity) as total_qty'), DB::raw('SUM(subtotal) as total_revenue'))
            ->groupBy('product_id')
            ->with('product.category')
            ->orderBy('total_qty', 'desc')
            ->paginate(15);

        return view('admin.reports.products', compact('products', 'startDate', 'endDate'));
    }

    public function members(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));

        $members = Member::with('user')
            ->withCount(['transactions' => function($q) use ($startDate, $endDate) {
                $q->completed()->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            }])
            ->withSum(['transactions' => function($q) use ($startDate, $endDate) {
                $q->completed()->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            }], 'total_amount')
            ->orderBy('transactions_sum_total_amount', 'desc')
            ->paginate(15);

        return view('admin.reports.members', compact('members', 'startDate', 'endDate'));
    }

    public function export(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));
        $type = $request->input('type', 'csv');

        $transactions = Transaction::completed()
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->with(['user', 'member'])
            ->latest()
            ->get();

        if ($type === 'pdf') {
            $data = [
                'transactions' => $transactions,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'totalRevenue' => $transactions->sum('total_amount'),
                'totalTransactions' => $transactions->count()
            ];
            
            $pdf = Pdf::loadView('admin.reports.pdf', $data);
            return $pdf->download('Laporan-Penjualan-'.$startDate.'-ke-'.$endDate.'.pdf');
        }

        // CSV Export
        $filename = "Laporan-Penjualan-{$startDate}-ke-{$endDate}.csv";
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use ($transactions) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['No', 'Kode Transaksi', 'Tanggal', 'Member', 'Kasir', 'Subtotal', 'Diskon', 'Total', 'Metode']);

            foreach ($transactions as $index => $row) {
                fputcsv($file, [
                    $index + 1,
                    $row->transaction_code,
                    $row->created_at->format('d/m/Y H:i'),
                    $row->member->member_name ?? 'Guest',
                    $row->user->name,
                    $row->subtotal,
                    $row->discount_amount,
                    $row->total_amount,
                    ucfirst($row->payment_method)
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
