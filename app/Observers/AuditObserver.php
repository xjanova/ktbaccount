<?php

namespace App\Observers;

use App\Helpers\TenantContext;
use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AuditObserver
{
    public function created(Model $model): void
    {
        $this->log('created', $model, null, $model->getAttributes());
    }

    public function updated(Model $model): void
    {
        $original = $model->getOriginal();
        $changes = $model->getChanges();

        // Remove timestamps from audit
        unset($changes['updated_at'], $original['updated_at']);

        if (empty($changes)) {
            return;
        }

        // Get only the original values for changed fields
        $oldValues = array_intersect_key($original, $changes);

        $this->log('updated', $model, $oldValues, $changes);
    }

    public function deleted(Model $model): void
    {
        $this->log('deleted', $model, $model->getAttributes(), null);
    }

    private function log(string $action, Model $model, ?array $oldValues, ?array $newValues): void
    {
        // Prevent infinite recursion for AuditLog itself
        if ($model instanceof AuditLog) {
            return;
        }

        // Mask sensitive fields
        $sensitiveFields = ['password', 'national_id_encrypted', 'channel_secret', 'access_token', 'remember_token'];
        $oldValues = $this->maskSensitive($oldValues, $sensitiveFields);
        $newValues = $this->maskSensitive($newValues, $sensitiveFields);

        try {
            AuditLog::create([
                'tenant_id' => TenantContext::id(),
                'user_id' => Auth::id(),
                'action' => $action,
                'model_type' => get_class($model),
                'model_id' => $model->getKey(),
                'old_values' => $oldValues,
                'new_values' => $newValues,
                'ip_address' => Request::ip(),
                'user_agent' => Request::userAgent(),
            ]);
        } catch (\Exception $e) {
            // Silently fail - don't break the main operation for audit logging
            report($e);
        }
    }

    private function maskSensitive(?array $values, array $fields): ?array
    {
        if ($values === null) {
            return null;
        }

        foreach ($fields as $field) {
            if (isset($values[$field])) {
                $values[$field] = '********';
            }
        }

        return $values;
    }
}
