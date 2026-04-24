<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    // audit_logs only has created_at (no updated_at column)
    const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'action',
        'model',
        'model_id',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    /**
     * The user who triggered this action.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
