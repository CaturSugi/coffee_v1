<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\LogsActivity;

class Transaction extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'transaction_code',
        'user_id',
        'member_id',
        'subtotal',
        'discount_amount',
        'discount_percentage',
        'tax_amount',
        'total_amount',
        'payment_method',
        'payment_status',
        'order_status',
        'payment_date',
        'notes',
    ];

    protected $casts = [
        'payment_date' => 'datetime',
        'subtotal' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    /**
     * Local Scopes
     */
    public function scopeCompleted($query)
    {
        return $query->where('payment_status', 'completed');
    }

    public function scopePending($query)
    {
        return $query->where('payment_status', 'pending');
    }

    public function scopeCancelled($query)
    {
        return $query->where('payment_status', 'cancelled');
    }

    public function scopeByPaymentMethod($query, $method)
    {
        return $query->where('payment_method', $method);
    }

    public function scopeBetweenDates($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    public function scopeByOrderStatus($query, $status)
    {
        return $query->where('order_status', $status);
    }

    /**
     * Accessors & Mutators
     */
    public function getOrderStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="px-2 py-1 text-xs font-semibold text-gray-700 bg-gray-100 rounded">Menunggu</span>',
            'preparing' => '<span class="px-2 py-1 text-xs font-semibold text-blue-700 bg-blue-100 rounded">Diproses</span>',
            'ready' => '<span class="px-2 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded">Siap Diambil</span>',
            'served' => '<span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded">Disajikan</span>',
        ];
        return $badges[$this->order_status] ?? $this->order_status;
    }

    public function getPaymentStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="px-3 py-1 text-xs font-medium text-yellow-800 bg-yellow-100 rounded-full">Pending</span>',
            'completed' => '<span class="px-3 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Completed</span>',
            'cancelled' => '<span class="px-3 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">Cancelled</span>',
        ];
        return $badges[$this->payment_status] ?? '';
    }

    public function getPaymentMethodLabelAttribute()
    {
        $methods = [
            'cash' => 'Cash',
            'card' => 'Debit/Credit Card',
            'e-wallet' => 'E-Wallet',
            'qris' => 'QRIS',
        ];
        return $methods[$this->payment_method] ?? $this->payment_method;
    }

    /**
     * Methods
     */
    public function markAsCompleted()
    {
        $this->update([
            'payment_status' => 'completed',
            'payment_date' => now(),
        ]);
    }

    public function cancel()
    {
        $this->update(['payment_status' => 'cancelled']);
        // Return stock
        foreach ($this->details as $detail) {
            $detail->product->increaseStock($detail->quantity);
        }
    }

    public function getItemCount()
    {
        return $this->details->sum('quantity');
    }

    public function getFinalAmount()
    {
        return $this->total_amount;
    }
}
