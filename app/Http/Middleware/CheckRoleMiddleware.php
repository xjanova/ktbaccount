<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Helpers\TenantContext;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware that checks if the authenticated user has the required role
 * within the current tenant context.
 *
 * Usage in routes: `->middleware('role:fund_admin,fund_manager')`
 * Super admins bypass all role checks.
 */
class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  string  ...$roles  Comma-separated list of allowed roles.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => 'กรุณาเข้าสู่ระบบ',
                ], Response::HTTP_UNAUTHORIZED);
            }

            return redirect()->route('login');
        }

        // Super admins bypass all role checks
        if ($user->is_super_admin) {
            return $next($request);
        }

        $tenantId = TenantContext::id();

        if ($tenantId === null) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => 'ไม่สามารถระบุกองทุนได้',
                ], Response::HTTP_FORBIDDEN);
            }

            return redirect()->route('tenants.select');
        }

        // Check if the user has any of the required roles in the current tenant
        $userRole = $user->currentTenantRole();

        if ($userRole === null || ! in_array($userRole, $roles, true)) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => 'คุณไม่มีสิทธิ์ในการเข้าถึงส่วนนี้',
                ], Response::HTTP_FORBIDDEN);
            }

            abort(Response::HTTP_FORBIDDEN, 'คุณไม่มีสิทธิ์ในการเข้าถึงส่วนนี้');
        }

        return $next($request);
    }
}
