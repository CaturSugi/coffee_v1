<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Product;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function sales(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->format('Y-m-d'));

        $transactions = Transaction::whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(), 
                Carbon::parse($endDate)->endOfDay()
            ])
            ->completed()
            ->latest()
            ->paginate(15);

        $stats = [
            'total_revenue' => Transaction::whereBetween('created_at', [Carbon::parse($startDate)->startOfDay(), Carbon::parse($endDate)->endOfDay()])->completed()->sum('total_amount'),
            'total_transactions' => Transaction::whereBetween('created_at', [Carbon::parse($startDate)->startOfDay(), Carbon::parse($endDate)->endOfDay()])->completed()->count(),
            'avg_transaction' => Transaction::whereBetween('created_at', [Carbon::parse($startDate)->startOfDay(), Carbon::parse($endDate)->endOfDay()])->completed()->avg('total_amount') ?? 0,
        ];

        return view('manager.reports.sales', compact('transactions', 'startDate', 'endDate', 'stats'));
    }

    public function products()
    {
        $products = Product::select('products.*')
            ->leftJoin('transaction_details', 'products.id', '=', 'transaction_details.product_id')
            ->leftJoin('transactions', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->selectRaw('SUM(CASE WHEN transactions.payment_status = "completed" THEN transaction_details.quantity ELSE 0 END) as total_sold')
            ->selectRaw('SUM(CASE WHEN transactions.payment_status = "completed" THEN transaction_details.subtotal ELSE 0 END) as total_revenue')
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->paginate(15);

        return view('manager.reports.products', compact('products'));
    }

    public function members()
    {
        $members = Member::withCount(['transactions' => function($q) {
            $q->where('payment_status', 'completed');
        }])
        ->withSum(['transactions' => function($q) {
            $q->where('payment_status', 'completed');
        }], 'total_amount')
        ->orderByDesc('transactions_count')
        ->paginate(15);

        return view('manager.reports.members', compact('members'));
    }
}
