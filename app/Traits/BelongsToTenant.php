<?php

declare(strict_types=1);

namespace App\Traits;

use App\Helpers\TenantContext;
use App\Models\Tenant;
use App\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait for models that belong to a tenant.
 *
 * Automatically applies the TenantScope global scope and sets the
 * tenant_id on model creation from the current TenantContext.
 */
trait BelongsToTenant
{
    /**
     * Boot the trait: register the global scope and the creating event.
     */
    public static function bootBelongsToTenant(): void
    {
        static::addGlobalScope(new TenantScope);

        static::creating(function ($model) {
            $tenantId = TenantContext::id();

            if ($tenantId !== null && empty($model->tenant_id)) {
                $model->tenant_id = $tenantId;
            }
        });
    }

    /**
     * Get the tenant that owns this model.
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
