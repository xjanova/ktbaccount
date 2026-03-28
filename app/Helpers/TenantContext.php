<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Models\Tenant;
use Illuminate\Http\Request;

/**
 * Static helper class for managing the current tenant context.
 *
 * Stores the active tenant in the application container so it can be
 * accessed globally by scopes, traits, and middleware.
 */
class TenantContext
{
    /**
     * The container binding key for the current tenant.
     */
    private const CONTAINER_KEY = 'current_tenant';

    /**
     * Set the current tenant in the application container.
     */
    public static function set(Tenant $tenant): void
    {
        app()->instance(self::CONTAINER_KEY, $tenant);
    }

    /**
     * Get the current tenant from the application container.
     */
    public static function get(): ?Tenant
    {
        if (app()->bound(self::CONTAINER_KEY)) {
            return app(self::CONTAINER_KEY);
        }

        return null;
    }

    /**
     * Get the current tenant's ID.
     */
    public static function id(): ?int
    {
        return self::get()?->id;
    }

    /**
     * Clear the current tenant from the container.
     */
    public static function forget(): void
    {
        app()->forgetInstance(self::CONTAINER_KEY);
    }

    /**
     * Resolve the tenant from the incoming request.
     *
     * For web requests: resolves from the session's `tenant_id`.
     * For API requests: resolves from the `X-Tenant-ID` header.
     */
    public static function resolve(Request $request): ?Tenant
    {
        $tenantId = null;

        // API requests: resolve from header
        if ($request->is('api/*') || $request->expectsJson()) {
            $tenantId = $request->header('X-Tenant-ID');
        }

        // Web requests: resolve from session
        if ($tenantId === null) {
            $tenantId = $request->session()?->get('tenant_id');
        }

        if ($tenantId === null) {
            return null;
        }

        return Tenant::where('id', $tenantId)
            ->where('is_active', true)
            ->first();
    }
}
