<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait LogsActivity
{
    /**
     * Boot the trait and register Eloquent model event listeners.
     */
    public static function bootLogsActivity(): void
    {
        static::created(function ($model) {
            $model->logActivity('created', null, $model->getAttributes());
        });

        static::updated(function ($model) {
            $model->logActivity('updated', $model->getOriginal(), $model->getChanges());
        });

        static::deleted(function ($model) {
            $model->logActivity('deleted', $model->getAttributes(), null);
        });
    }

    /**
     * Write an entry to the audit_logs table.
     */
    protected function logActivity(string $action, ?array $oldValues, ?array $newValues): void
    {
        try {
            // Strip sensitive fields before persisting
            $sensitiveFields = ['password', 'remember_token', 'token'];

            $clean = function (?array $values) use ($sensitiveFields): ?array {
                if ($values === null) {
                    return null;
                }
                return array_diff_key($values, array_flip($sensitiveFields));
            };

            AuditLog::create([
                'user_id'    => Auth::id(),
                'action'     => $action,
                'model'      => class_basename(static::class),
                'model_id'   => $this->getKey(),
                'old_values' => $clean($oldValues),
                'new_values' => $clean($newValues),
                'ip_address' => Request::ip(),
                'user_agent' => Request::userAgent(),
            ]);
        } catch (\Throwable $e) {
            // Never let audit-log failures break the main operation.
            logger()->error('LogsActivity: failed to write audit log — ' . $e->getMessage());
        }
    }
}
