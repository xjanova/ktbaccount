<?php

declare(strict_types=1);

namespace App\Scopes;

use App\Helpers\TenantContext;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

/**
 * Global scope that automatically filters queries by the current tenant.
 *
 * Applied via the BelongsToTenant trait, this scope adds a
 * `WHERE tenant_id = ?` clause to every query on tenant-scoped models.
 */
class TenantScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $tenantId = TenantContext::id();

        if ($tenantId !== null) {
            $builder->where($model->qualifyColumn('tenant_id'), $tenantId);
        }
    }
}
