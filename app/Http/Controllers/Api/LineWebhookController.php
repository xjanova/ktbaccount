<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Services\Line\LineNotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LineWebhookController extends Controller
{
    public function __construct(
        private LineNotificationService $lineService,
    ) {}

    /**
     * Handle LINE webhook events for a specific tenant.
     * POST /api/line/webhook/{tenantCode}
     */
    public function handle(Request $request, string $tenantCode): JsonResponse
    {
        $tenant = Tenant::where('code', $tenantCode)->where('is_active', true)->first();

        if (! $tenant) {
            return response()->json(['message' => 'Tenant not found'], 404);
        }

        // Verify LINE signature
        if (config('ktbaccount.line.webhook_verify')) {
            $signature = $request->header('X-Line-Signature');

            if (! $this->verifySignature($request->getContent(), $signature, $tenant)) {
                Log::warning('LINE webhook signature verification failed', [
                    'tenant_code' => $tenantCode,
                ]);

                return response()->json(['message' => 'Invalid signature'], 403);
            }
        }

        $body = $request->all();
        $events = $body['events'] ?? [];

        if (empty($events)) {
            // LINE sends empty events for webhook verification
            return response()->json(['message' => 'OK']);
        }

        try {
            $this->lineService->handleWebhook($tenant, $events);
        } catch (\Exception $e) {
            Log::error('LINE webhook processing error', [
                'tenant_code' => $tenantCode,
                'error' => $e->getMessage(),
            ]);
        }

        return response()->json(['message' => 'OK']);
    }

    /**
     * Verify LINE webhook signature.
     */
    private function verifySignature(string $body, ?string $signature, Tenant $tenant): bool
    {
        if (! $signature) {
            return false;
        }

        $lineConfig = $tenant->lineOaConfig;

        if (! $lineConfig || ! $lineConfig->channel_secret) {
            return false;
        }

        $hash = hash_hmac('sha256', $body, $lineConfig->channel_secret, true);
        $expectedSignature = base64_encode($hash);

        return hash_equals($expectedSignature, $signature);
    }
}
