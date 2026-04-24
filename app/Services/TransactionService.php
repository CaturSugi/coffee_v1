<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Member;
use App\Models\Promotion;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Exception;

class TransactionService
{
    /**
     * Create a new transaction
     */
    public function createTransaction(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Generate transaction code
            $transactionCode = $this->generateTransactionCode();

            // Calculate totals
            $subtotal = 0;
            $items = $data['items'] ?? [];

            // Validate products exist and have sufficient stock
            foreach ($items as $item) {
                $product = Product::findOrFail($item['product_id']);
                if ($product->stock < $item['quantity']) {
                    throw new Exception("Stok {$product->name} tidak cukup");
                }
                $subtotal += $product->sell_price * $item['quantity'];
            }

            // Apply member discount if applicable
            $discountAmount = 0;
            $discountPercentage = 0;
            $memberId = $data['member_id'] ?? null;

            if ($memberId) {
                $member = Member::findOrFail($memberId);
                $discountPercentage = $member->discount_percentage;
                $discountAmount = ($subtotal * $discountPercentage) / 100;
            }

            // Apply promotion if applicable
            if (isset($data['promotion_code'])) {
                $promotion = Promotion::where('code', $data['promotion_code'])->firstOrFail();
                if ($promotion->isValid()) {
                    $promoDiscount = $this->calculatePromoDiscount($promotion, $subtotal - $discountAmount);
                    $discountAmount += $promoDiscount;
                    $promotion->increment('usage_count');
                }
            }

            // Calculate tax (PPN 10%)
            $taxableAmount = $subtotal - $discountAmount;
            $taxAmount = ($taxableAmount * 10) / 100;

            // Total amount
            $totalAmount = $taxableAmount + $taxAmount;

            // Create transaction
            $transaction = Transaction::create([
                'transaction_code' => $transactionCode,
                'user_id' => auth()->id() ?? $data['user_id'] ?? null,
                'member_id' => $memberId,
                'subtotal' => $subtotal,
                'discount_amount' => $discountAmount,
                'discount_percentage' => $discountPercentage,
                'tax_amount' => $taxAmount,
                'total_amount' => $totalAmount,
                'payment_method' => $data['payment_method'] ?? 'cash',
                'payment_status' => $data['payment_status'] ?? 'pending',
                'order_status' => 'preparing',
                'notes' => $data['notes'] ?? null,
            ]);

            // Create transaction details and decrease stock
            foreach ($items as $item) {
                $product = Product::find($item['product_id']);
                
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->sell_price,
                    'subtotal' => $product->sell_price * $item['quantity'],
                    'notes' => $item['notes'] ?? null,
                ]);

                // Decrease stock
                $product->decreaseStock($item['quantity']);
            }

            // Update member total spent and add points
            if ($memberId) {
                $member->updateTotalSpent($totalAmount);
                $member->addPoints($totalAmount);
            }

            return $transaction;
        });
    }

    /**
     * Process payment
     */
    public function processPayment(Transaction $transaction, array $paymentData)
    {
        $transaction->update([
            'payment_method' => $paymentData['payment_method'],
            'payment_status' => 'completed',
            'payment_date' => now(),
        ]);

        return $transaction;
    }

    /**
     * Generate unique transaction code
     */
    private function generateTransactionCode()
    {
        $date = date('Ymd');
        $count = Transaction::whereDate('created_at', today())->count() + 1;
        return sprintf('TRX-%s-%05d', $date, $count);
    }

    /**
     * Calculate promotion discount
     */
    private function calculatePromoDiscount(Promotion $promotion, $amount)
    {
        if (!$promotion->isValid()) {
            return 0;
        }

        if ($promotion->discount_type === 'percentage') {
            $discount = ($amount * $promotion->discount_value) / 100;
            
            if ($promotion->max_discount) {
                $discount = min($discount, $promotion->max_discount);
            }
        } else {
            $discount = min($promotion->discount_value, $amount);
        }

        return $discount;
    }

    /**
     * Cancel transaction (reverse stock)
     */
    public function cancelTransaction(Transaction $transaction)
    {
        return DB::transaction(function () use ($transaction) {
            if ($transaction->payment_status === 'cancelled') {
                throw new Exception("Transaksi sudah dibatalkan");
            }

            $transaction->cancel();
            return $transaction;
        });
    }

    /**
     * Get transaction summary
     */
    public function getTransactionSummary(Transaction $transaction)
    {
        return [
            'code' => $transaction->transaction_code,
            'date' => $transaction->created_at->format('d/m/Y H:i'),
            'customer' => $transaction->member->member_name ?? 'Tanpa Member',
            'items' => $transaction->details->count(),
            'subtotal' => $transaction->subtotal,
            'discount' => $transaction->discount_amount,
            'tax' => $transaction->tax_amount,
            'total' => $transaction->total_amount,
            'payment_method' => $transaction->payment_method_label,
            'payment_status' => $transaction->payment_status,
        ];
    }
}
