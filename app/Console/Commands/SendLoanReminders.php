<?php

namespace App\Console\Commands;

use App\Models\LoanSchedule;
use App\Services\Line\LineNotificationService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendLoanReminders extends Command
{
    protected $signature = 'loans:send-reminders';

    protected $description = 'ส่งแจ้งเตือนครบกำหนดชำระสินเชื่อผ่าน LINE OA';

    public function handle(LineNotificationService $lineService): int
    {
        $reminderDays = config('ktbaccount.loan.overdue_reminder_days', [7, 3, 1, 0]);
        $today = Carbon::today();
        $sent = 0;

        foreach ($reminderDays as $days) {
            $targetDate = $today->copy()->addDays($days);

            $schedules = LoanSchedule::with(['loan.member.user', 'loan.tenant.lineOaConfig'])
                ->whereHas('loan', fn ($q) => $q->whereIn('status', ['active', 'disbursed']))
                ->where('status', 'pending')
                ->whereDate('due_date', $targetDate)
                ->get();

            foreach ($schedules as $schedule) {
                $loan = $schedule->loan;
                $member = $loan->member;
                $tenant = $loan->tenant;

                if (! $tenant->lineOaConfig || ! $member->user?->line_user_id) {
                    continue;
                }

                try {
                    $success = $lineService->sendLoanReminder($loan, $days);
                    if ($success) {
                        $sent++;
                    }
                } catch (\Exception $e) {
                    Log::error('Failed to send loan reminder', [
                        'loan_id' => $loan->id,
                        'member_id' => $member->id,
                        'error' => $e->getMessage(),
                    ]);
                }
            }
        }

        $this->info("ส่งแจ้งเตือนสำเร็จ {$sent} รายการ");

        return self::SUCCESS;
    }
}
