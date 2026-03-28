<?php

namespace App\Http\Controllers\Fund;

use App\Helpers\TenantContext;
use App\Http\Controllers\Controller;
use App\Models\LineOaConfig;
use Illuminate\Http\Request;

class LineSettingsController extends Controller
{
    /**
     * Show LINE OA settings page.
     */
    public function index()
    {
        $tenant = TenantContext::get();

        // Demo mode หรือไม่มี tenant → ใช้ข้อมูลตัวอย่าง
        if (! $tenant) {
            $config = new LineOaConfig;
            $webhookUrl = url('/api/line/webhook/demo');
            $tenant = (object) ['code' => 'demo', 'name' => 'กองทุนตัวอย่าง', 'id' => 0];

            return view('fund.settings.line', compact('config', 'webhookUrl', 'tenant'));
        }

        $config = $tenant->lineOaConfig ?? new LineOaConfig;
        $webhookUrl = url("/api/line/webhook/{$tenant->code}");

        return view('fund.settings.line', compact('config', 'webhookUrl', 'tenant'));
    }

    /**
     * Update LINE OA settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'channel_id' => 'nullable|string|max:255',
            'channel_secret' => 'nullable|string|max:255',
            'access_token' => 'nullable|string|max:500',
            'greeting_message' => 'nullable|string|max:1000',
        ], [
            'channel_id.max' => 'Channel ID ต้องไม่เกิน 255 ตัวอักษร',
            'channel_secret.max' => 'Channel Secret ต้องไม่เกิน 255 ตัวอักษร',
            'access_token.max' => 'Access Token ต้องไม่เกิน 500 ตัวอักษร',
            'greeting_message.max' => 'ข้อความต้อนรับต้องไม่เกิน 1,000 ตัวอักษร',
        ]);

        $tenant = TenantContext::get();

        $config = $tenant->lineOaConfig ?? new LineOaConfig(['tenant_id' => $tenant->id]);
        $config->fill($validated);

        // Reset verification status if credentials changed
        if ($config->isDirty(['channel_id', 'channel_secret', 'access_token'])) {
            $config->webhook_verified = false;
        }

        $config->save();

        return redirect()
            ->route('fund.settings.line')
            ->with('success', 'บันทึกการตั้งค่า LINE OA เรียบร้อยแล้ว');
    }
}
