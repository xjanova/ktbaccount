<?php

namespace App\Services\Line;

use App\Models\Loan;
use App\Models\LoanPayment;
use App\Models\NotificationLog;
use App\Models\SavingsTransaction;
use App\Models\Tenant;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LineNotificationService
{
    private const API_URL = 'https://api.line.me/v2/bot';

    /**
     * ส่งข้อความ push ไปยัง LINE user
     */
    public function sendMessage(Tenant $tenant, string $lineUserId, string $message): bool
    {
        $config = $tenant->lineOaConfig;

        if (! $config || ! $config->access_token) {
            return false;
        }

        try {
            $response = Http::withToken($config->access_token)
                ->post(self::API_URL.'/message/push', [
                    'to' => $lineUserId,
                    'messages' => [
                        ['type' => 'text', 'text' => $message],
                    ],
                ]);

            $success = $response->successful();

            // บันทึกประวัติ
            NotificationLog::create([
                'tenant_id' => $tenant->id,
                'channel' => 'line',
                'type' => 'push_message',
                'title' => 'LINE Message',
                'body' => $message,
                'data' => ['line_user_id' => $lineUserId, 'status' => $success ? 'sent' : 'failed'],
                'sent_at' => $success ? now() : null,
            ]);

            if (! $success) {
                Log::warning('LINE push message failed', [
                    'tenant_id' => $tenant->id,
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
            }

            return $success;
        } catch (\Exception $e) {
            Log::error('LINE push message error', [
                'tenant_id' => $tenant->id,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }

    /**
     * แจ้งเตือนครบกำหนดชำระสินเชื่อ
     */
    public function sendLoanReminder(Loan $loan, int $daysBefore): bool
    {
        $member = $loan->member;
        $lineUserId = $member->user?->line_user_id;

        if (! $lineUserId) {
            return false;
        }

        $schedule = $loan->schedules()->where('status', 'pending')->orderBy('installment_no')->first();

        if (! $schedule) {
            return false;
        }

        $formattedAmount = number_format($schedule->total_amount, 2);
        $dueDate = Carbon::parse($schedule->due_date)->locale('th')->translatedFormat('j F Y');

        if ($daysBefore > 0) {
            $message = "🔔 แจ้งเตือนชำระสินเชื่อ\n\n"
                ."สัญญาเลขที่: {$loan->loan_code}\n"
                ."งวดที่: {$schedule->installment_no}\n"
                ."จำนวนเงิน: ฿{$formattedAmount}\n"
                ."ครบกำหนด: {$dueDate}\n"
                ."(อีก {$daysBefore} วัน)\n\n"
                .'กรุณาชำระตามกำหนดเวลา';
        } elseif ($daysBefore === 0) {
            $message = "⚠️ วันนี้ครบกำหนดชำระ!\n\n"
                ."สัญญาเลขที่: {$loan->loan_code}\n"
                ."งวดที่: {$schedule->installment_no}\n"
                ."จำนวนเงิน: ฿{$formattedAmount}\n\n"
                .'กรุณาชำระภายในวันนี้';
        } else {
            $overdueDays = abs($daysBefore);
            $message = "🚨 สินเชื่อเลยกำหนดชำระ {$overdueDays} วัน\n\n"
                ."สัญญาเลขที่: {$loan->loan_code}\n"
                ."งวดที่: {$schedule->installment_no}\n"
                ."จำนวนเงิน: ฿{$formattedAmount}\n"
                ."ครบกำหนด: {$dueDate}\n\n"
                .'กรุณาติดต่อกองทุนเพื่อชำระโดยเร็ว';
        }

        return $this->sendMessage($loan->tenant, $lineUserId, $message);
    }

    /**
     * แจ้งยืนยันการชำระสินเชื่อ
     */
    public function sendPaymentConfirmation(LoanPayment $payment): bool
    {
        $loan = $payment->loan;
        $lineUserId = $loan->member->user?->line_user_id;

        if (! $lineUserId) {
            return false;
        }

        $formattedAmount = number_format($payment->amount, 2);
        $formattedBalance = number_format($loan->outstanding_balance, 2);

        $message = "✅ รับชำระสินเชื่อเรียบร้อย\n\n"
            ."สัญญา: {$loan->loan_code}\n"
            ."จำนวนเงิน: ฿{$formattedAmount}\n"
            ."ยอดคงเหลือ: ฿{$formattedBalance}\n"
            .'วันที่: '.Carbon::parse($payment->payment_date)->locale('th')->translatedFormat('j F Y');

        return $this->sendMessage($loan->tenant, $lineUserId, $message);
    }

    /**
     * แจ้งยืนยันฝาก/ถอนเงิน
     */
    public function sendSavingsConfirmation(SavingsTransaction $transaction): bool
    {
        $account = $transaction->savingsAccount;
        $lineUserId = $account->member->user?->line_user_id;

        if (! $lineUserId) {
            return false;
        }

        $type = $transaction->type === 'deposit' ? 'ฝากเงิน' : 'ถอนเงิน';
        $icon = $transaction->type === 'deposit' ? '💰' : '💸';
        $formattedAmount = number_format($transaction->amount, 2);
        $formattedBalance = number_format($transaction->balance_after, 2);

        $message = "{$icon} {$type}สำเร็จ\n\n"
            ."บัญชี: {$account->account_number}\n"
            ."จำนวนเงิน: ฿{$formattedAmount}\n"
            ."ยอดคงเหลือ: ฿{$formattedBalance}";

        $tenant = $account->tenant ?? Tenant::find($account->tenant_id);

        return $this->sendMessage($tenant, $lineUserId, $message);
    }

    /**
     * Broadcast ข้อความไปยังสมาชิกทุกคนในกองทุน
     */
    public function broadcast(Tenant $tenant, string $message): int
    {
        $config = $tenant->lineOaConfig;

        if (! $config || ! $config->access_token) {
            return 0;
        }

        try {
            Http::withToken($config->access_token)
                ->post(self::API_URL.'/message/broadcast', [
                    'messages' => [
                        ['type' => 'text', 'text' => $message],
                    ],
                ]);

            return 1; // broadcast doesn't return individual count
        } catch (\Exception $e) {
            Log::error('LINE broadcast error', ['error' => $e->getMessage()]);

            return 0;
        }
    }

    /**
     * Handle incoming LINE webhook events
     */
    public function handleWebhook(Tenant $tenant, array $events): void
    {
        foreach ($events as $event) {
            $type = $event['type'] ?? null;

            match ($type) {
                'follow' => $this->handleFollow($tenant, $event),
                'message' => $this->handleMessage($tenant, $event),
                default => null,
            };
        }
    }

    private function handleFollow(Tenant $tenant, array $event): void
    {
        $config = $tenant->lineOaConfig;

        if ($config?->greeting_message) {
            $userId = $event['source']['userId'] ?? null;
            if ($userId) {
                $this->sendMessage($tenant, $userId, $config->greeting_message);
            }
        }
    }

    private function handleMessage(Tenant $tenant, array $event): void
    {
        // รับข้อความและตอบกลับเบื้องต้น
        $userId = $event['source']['userId'] ?? null;
        $text = $event['message']['text'] ?? '';

        if (! $userId || ! $text) {
            return;
        }

        $reply = match (true) {
            str_contains($text, 'ยอด') || str_contains($text, 'สินเชื่อ') => 'กรุณาตรวจสอบยอดสินเชื่อผ่านแอป KTB Account หรือเว็บไซต์',
            str_contains($text, 'ฝาก') || str_contains($text, 'ถอน') => 'กรุณาติดต่อเจ้าหน้าที่กองทุนเพื่อทำรายการฝาก/ถอน',
            str_contains($text, 'ติดต่อ') => "กองทุน: {$tenant->name}\nโทร: {$tenant->phone}\nอีเมล: {$tenant->email}",
            default => 'สวัสดีครับ/ค่ะ กรุณาใช้แอป KTB Account เพื่อดูข้อมูลกองทุนหมู่บ้าน',
        };

        // Reply via reply token
        $config = $tenant->lineOaConfig;
        $replyToken = $event['replyToken'] ?? null;

        if ($config?->access_token && $replyToken) {
            Http::withToken($config->access_token)
                ->post(self::API_URL.'/message/reply', [
                    'replyToken' => $replyToken,
                    'messages' => [['type' => 'text', 'text' => $reply]],
                ]);
        }
    }
}
