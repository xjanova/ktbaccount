<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

/**
 * Trait that automatically logs create/update/delete events to the audit_logs table.
 *
 * Records old values, new values, action type, authenticated user, and IP address.
 */
trait Auditable
{
    /**
     * Boot the trait: register model event listeners for auditing.
     */
    public static function bootAuditable(): void
    {
        static::created(function ($model) {
            $model->logAudit('created', [], $model->getAttributes());
        });

        static::updated(function ($model) {
            $oldValues = collect($model->getOriginal())
                ->only(array_keys($model->getDirty()))
                ->toArray();

            $newValues = $model->getDirty();

            if (! empty($newValues)) {
                $model->logAudit('updated', $oldValues, $newValues);
            }
        });

        static::deleted(function ($model) {
            $model->logAudit('deleted', $model->getOriginal(), []);
        });
    }

    /**
     * Create an audit log entry.
     *
     * @param  string  $action  The action performed (created, updated, deleted).
     * @param  array  $oldValues  The previous attribute values.
     * @param  array  $newValues  The new attribute values.
     */
    protected function logAudit(string $action, array $oldValues, array $newValues): void
    {
        // Strip sensitive attributes from audit logs
        $hidden = $this->getHidden();
        $oldValues = array_diff_key($oldValues, array_flip($hidden));
        $newValues = array_diff_key($newValues, array_flip($hidden));

        try {
            AuditLog::create([
                'auditable_type' => $this->getMorphClass(),
                'auditable_id' => $this->getKey(),
                'action' => $action,
                'old_values' => ! empty($oldValues) ? $oldValues : null,
                'new_values' => ! empty($newValues) ? $newValues : null,
                'user_id' => Auth::id(),
                'ip_address' => Request::ip(),
            ]);
        } catch (\Throwable $e) {
            // Silently fail - don't break main operation for audit logging
            // (e.g. table doesn't exist yet during initial setup)
        }
    }

    /**
     * Get all audit log entries for this model.
     *
     * @return MorphMany
     */
    public function auditLogs()
    {
        return $this->morphMany(AuditLog::class, 'auditable');
    }
}
