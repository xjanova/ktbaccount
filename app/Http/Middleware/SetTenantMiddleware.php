<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Helpers\TenantContext;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware that resolves and sets the current tenant context.
 *
 * For web requests: resolves from the session's tenant_id.
 * For API requests: resolves from the X-Tenant-ID header.
 * Returns 403 if no tenant can be resolved (super admins are exempt).
 */
class SetTenantMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Super admins can bypass tenant requirement
        $user = $request->user();
        if ($user && $user->is_super_admin) {
            // Still try to resolve tenant for super admins (they may be operating within one)
            $tenant = TenantContext::resolve($request);
            if ($tenant) {
                TenantContext::set($tenant);
            }

            return $next($request);
        }

        $tenant = TenantContext::resolve($request);

        if ($tenant === null) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => 'ไม่สามารถระบุกองทุนได้ กรุณาเลือกกองทุนก่อนดำเนินการ',
                ], Response::HTTP_FORBIDDEN);
            }

            return redirect('/')
                ->with('error', 'กรุณาเลือกกองทุนก่อนดำเนินการ');
        }

        TenantContext::set($tenant);

        return $next($request);
    }
}
