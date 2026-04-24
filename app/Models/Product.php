<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\LogsActivity;

class Product extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'sku',
        'purchase_price',
        'sell_price',
        'stock',
        'min_stock',
        'image',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'purchase_price' => 'decimal:2',
        'sell_price' => 'decimal:2',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if ($this->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->image)) {
            return \Illuminate\Support\Facades\Storage::url($this->image);
        }
        return asset('images/product-placeholder.png');
    }

    /**
     * Relationships
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Local Scopes
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeLowStock($query)
    {
        return $query->whereColumn('stock', '<=', 'min_stock');
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
            ->orWhere('sku', 'like', "%{$search}%");
    }

    /**
     * Accessors & Mutators
     */
    public function getStatusBadgeAttribute()
    {
        if (!$this->is_active) {
            return '<span class="px-3 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">Inactive</span>';
        }
        if ($this->stock <= $this->min_stock) {
            return '<span class="px-3 py-1 text-xs font-medium text-yellow-800 bg-yellow-100 rounded-full">Low Stock</span>';
        }
        return '<span class="px-3 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Active</span>';
    }

    public function getProfitMarginAttribute()
    {
        if ($this->purchase_price == 0) return 0;
        return (($this->sell_price - $this->purchase_price) / $this->purchase_price) * 100;
    }

    public function getTotalStockValueAttribute()
    {
        return $this->stock * $this->purchase_price;
    }

    /**
     * Methods
     */
    public function decreaseStock($quantity)
    {
        $this->stock -= $quantity;
        $this->save();
    }

    public function increaseStock($quantity)
    {
        $this->stock += $quantity;
        $this->save();
    }

    public function isLowStock()
    {
        return $this->stock <= $this->min_stock;
    }
}
