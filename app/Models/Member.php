<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\LogsActivity;

class Member extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

    protected $fillable = [
        'user_id',
        'member_code',
        'member_phone',
        'member_email',
        'discount_percentage',
        'points_balance',
        'total_spent',
        'is_active',
    ];

    protected $appends = ['member_name'];

    protected $casts = [
        'is_active' => 'boolean',
        'discount_percentage' => 'decimal:2',
        'total_spent' => 'decimal:2',
    ];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Local Scopes
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('member_code', 'like', "%{$search}%")
            ->orWhere('member_phone', 'like', "%{$search}%")
            ->orWhere('member_email', 'like', "%{$search}%")
            ->orWhereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
    }

    /**
     * Accessors & Mutators
     */
    public function getMemberNameAttribute()
    {
        return $this->user->name ?? 'N/A';
    }

    public function getMemberTierAttribute()
    {
        if ($this->total_spent >= 5000000) {
            return 'Platinum';
        } elseif ($this->total_spent >= 2000000) {
            return 'Gold';
        } elseif ($this->total_spent >= 1000000) {
            return 'Silver';
        }
        return 'Bronze';
    }

    /**
     * Methods
     */
    public function addPoints($amount)
    {
        $points = (int)($amount / 1000); // 1000 = 1 point
        $this->increment('points_balance', $points);
        return $points;
    }

    public function redeemPoints($points)
    {
        if ($this->points_balance >= $points) {
            $this->decrement('points_balance', $points);
            return true;
        }
        return false;
    }

    public function updateTotalSpent($amount)
    {
        $this->increment('total_spent', $amount);
    }

    public function getAvailableDiscount()
    {
        return $this->discount_percentage ?? 0;
    }

    public function hasPoints($required)
    {
        return $this->points_balance >= $required;
    }
}
