<?php

namespace App\Console\Commands;

use App\Models\FiscalPeriod;
use App\Models\Tenant;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateFiscalPeriods extends Command
{
    protected $signature = 'accounting:generate-periods {year?}';

    protected $description = 'สร้างงวดบัญชี 12 เดือนสำหรับปีที่ระบุ (ทุกกองทุน)';

    public function handle(): int
    {
        $year = (int) ($this->argument('year') ?? Carbon::now()->year);

        $tenants = Tenant::where('is_active', true)->get();
        $created = 0;

        foreach ($tenants as $tenant) {
            for ($period = 1; $period <= 12; $period++) {
                $exists = FiscalPeriod::withoutGlobalScopes()
                    ->where('tenant_id', $tenant->id)
                    ->where('year', $year)
                    ->where('period', $period)
                    ->exists();

                if ($exists) {
                    continue;
                }

                $startDate = Carbon::createFromDate($year, $period, 1);
                $endDate = $startDate->copy()->endOfMonth();

                FiscalPeriod::withoutGlobalScopes()->create([
                    'tenant_id' => $tenant->id,
                    'year' => $year,
                    'period' => $period,
                    'start_date' => $startDate->toDateString(),
                    'end_date' => $endDate->toDateString(),
                    'is_closed' => false,
                ]);

                $created++;
            }
        }

        $this->info("สร้างงวดบัญชีสำเร็จ {$created} งวด สำหรับปี {$year}");

        return self::SUCCESS;
    }
}
