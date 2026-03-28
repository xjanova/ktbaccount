<?php

namespace App\Providers;

use App\Models\BankAccount;
use App\Models\CommitteeMember;
use App\Models\Loan;
use App\Models\LoanPayment;
use App\Models\Member;
use App\Models\ProfitAllocation;
use App\Models\SavingsAccount;
use App\Models\Share;
use App\Models\Tenant;
use App\Models\Transaction;
use App\Models\User;
use App\Observers\AuditObserver;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Use public_html as public path (DirectAdmin compatibility)
        $this->app->usePublicPath(base_path('public_html'));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS in production
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // Share app version with all views
        View::share('appVersion', trim(file_get_contents(base_path('VERSION'))));

        // Register audit observers for key models
        $auditableModels = [
            Tenant::class,
            User::class,
            Member::class,
            CommitteeMember::class,
            Loan::class,
            LoanPayment::class,
            SavingsAccount::class,
            Share::class,
            Transaction::class,
            BankAccount::class,
            ProfitAllocation::class,
        ];

        foreach ($auditableModels as $model) {
            if (class_exists($model)) {
                $model::observe(AuditObserver::class);
            }
        }
    }
}
