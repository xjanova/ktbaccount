<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware that verifies the authenticated user has given PDPA consent.
 *
 * Redirects to the consent page if pdpa_consented_at is null.
 * API requests receive a 403 response with instructions.
 */
class VerifyPdpaConsentMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            return $next($request);
        }

        if ($user->pdpa_consented_at === null) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => 'กรุณายินยอมนโยบายความเป็นส่วนตัว (PDPA) ก่อนใช้งาน',
                    'redirect' => route('pdpa.consent'),
                ], Response::HTTP_FORBIDDEN);
            }

            return redirect()->route('pdpa.consent')
                ->with('warning', 'กรุณายินยอมนโยบายความเป็นส่วนตัว (PDPA) ก่อนใช้งาน');
        }

        return $next($request);
    }
}
