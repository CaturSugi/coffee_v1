<?php

namespace App\Http\Controllers\Kitchen;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class KitchenController extends Controller
{
    public function index()
    {
        // Get active orders (not yet served)
        $orders = Transaction::with(['details.product', 'member'])
            ->whereIn('order_status', ['pending', 'preparing', 'ready'])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('kitchen.index', compact('orders'));
    }

    public function updateStatus(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'status' => 'required|in:preparing,ready,served'
        ]);

        $updateData = [
            'order_status' => $validated['status']
        ];

        // Jika pesanan disajikan, otomatis set status pembayaran menjadi Lunas (jika belum)
        if ($validated['status'] === 'served' && $transaction->payment_status !== 'completed') {
            $updateData['payment_status'] = 'completed';
            $updateData['payment_date'] = now();
        }

        $transaction->update($updateData);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Status pesanan diperbarui',
                'status' => $transaction->order_status,
                'badge' => $transaction->order_status_badge
            ]);
        }

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
