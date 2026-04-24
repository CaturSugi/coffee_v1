<?php

namespace App\Http\Controllers\CS;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Member;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $today = Carbon::today();

        // Stats for this CS
        $todayMySales = Transaction::where('user_id', $user->id)
            ->whereDate('created_at', $today)
            ->completed()
            ->sum('total_amount');

        $todayMyTransactions = Transaction::where('user_id', $user->id)
            ->whereDate('created_at', $today)
            ->completed()
            ->count();

        $totalMembers = Member::count();
        
        // Recent activity for this CS
        $recentTransactions = Transaction::where('user_id', $user->id)
            ->latest()
            ->limit(10)
            ->get();

        $activePromotions = \App\Models\Promotion::active()->get();
        
        return view('cs.dashboard', compact(
            'todayMySales', 
            'todayMyTransactions', 
            'totalMembers',
            'recentTransactions',
            'activePromotions'
        ));
    }
}
