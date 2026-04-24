<?php

namespace App\Http\Controllers\CS;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function sales(Request $request)
    {
        $user = auth()->user();
        
        // Default to today
        $startDate = $request->get('start_date', Carbon::today()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::today()->format('Y-m-d'));

        $query = Transaction::where('user_id', $user->id)
            ->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);

        $transactions = $query->latest()->paginate(15);

        $stats = [
            'total_sales' => $query->clone()->completed()->sum('total_amount'),
            'transaction_count' => $query->clone()->completed()->count(),
            'avg_sale' => $query->clone()->completed()->avg('total_amount') ?? 0,
        ];

        return view('cs.reports.sales', compact('transactions', 'startDate', 'endDate', 'stats'));
    }
}
