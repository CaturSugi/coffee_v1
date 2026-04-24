<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'invoice_number',
        'printer_type',
        'print_count',
        'printed_at',
    ];

    protected $casts = [
        'printed_at' => 'datetime',
    ];

    /**
     * Relationships
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
