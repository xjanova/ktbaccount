# KTB Account - ระบบบริหารกองทุนหมู่บ้าน

## Project Overview
Village Fund Management SaaS platform (ระบบบริหารกองทุนหมู่บ้าน) - multi-tenant system where each village fund registers and uses for free. Licensed by XMAN Studio (https://xman4289.com).

## Tech Stack
- **Backend**: Laravel 11, PHP 8.2+, MySQL
- **Frontend**: Blade + Tailwind CSS 4 + Alpine.js + Vite + Chart.js
- **Mobile**: Flutter (Android) at `flutter_app/`
- **API Auth**: Laravel Sanctum (token-based for mobile)
- **Notifications**: LINE Messaging API (per-tenant LINE OA)

## Architecture
- **Multi-tenant**: Single database with `tenant_id` column, `TenantScope` global scope
- **Tenant resolution**: Session (web), `X-Tenant-ID` header (API)
- **Accounting basis**: Cash basis (เกณฑ์เงินสด)
- **Fiscal year**: Calendar year (Jan 1 - Dec 31), 12 monthly periods
- **Account codes**: 5-digit standardized (1xxxx=Asset, 2xxxx=Liability, 3xxxx=Equity, 4xxxx=Revenue, 5xxxx=Expense)

## Key Directories
```
app/Enums/          - FundRole, AccountCategory, JournalType, LoanStatus, etc.
app/Helpers/        - TenantContext (static tenant resolver)
app/Http/Controllers/Admin/  - Super admin controllers
app/Http/Controllers/Api/    - Flutter API controllers
app/Http/Controllers/Auth/   - Login, Register
app/Http/Controllers/Fund/   - Fund management controllers
app/Http/Middleware/          - SetTenant, CheckRole, VerifyPdpaConsent
app/Models/         - All Eloquent models (25+)
app/Scopes/         - TenantScope
app/Services/       - Business logic (Accounting/, Fund/, Line/)
app/Traits/         - BelongsToTenant, Auditable
config/ktbaccount.php - App-specific configuration
flutter_app/        - Flutter mobile app
```

## Development Commands
```bash
# PHP/Composer (Laragon)
"C:/laragon/bin/php/php-8.3.26-Win32-vs16-x64/php.exe" "C:/laragon/bin/composer/composer.phar" install

# Artisan
php artisan serve
php artisan migrate
php artisan test
php artisan db:seed

# Frontend
npm run dev
npm run build

# Code style
./vendor/bin/pint

# Flutter
cd flutter_app && flutter run
```

## Domain & Deploy
- **Production**: https://ktbaccount.xman4289.com
- **GitHub**: https://github.com/xjanova/ktbaccount
- **CI/CD**: GitHub Actions (auto-deploy on push to main)
- **Flutter APK**: Built and attached to GitHub Releases

## User Roles (per tenant)
| Role | Thai Label | Access |
|------|-----------|--------|
| super_admin | ผู้ดูแลระบบใหญ่ | All tenants, platform management |
| fund_admin | ผู้ดูแลระบบกองทุน | Full access to own fund |
| fund_manager | ผู้จัดการกองทุน | Operations, accounting, reports |
| accountant | ผู้จัดทำบัญชี | Accounting only |
| committee | คณะกรรมการ | Approve loans, view reports |
| bank_officer | เจ้าหน้าที่ธนาคาร | Limited view |
| gov_officer | เจ้าหน้าที่ สทบ. | Oversight/reporting |
| member | สมาชิก | View own data only |

## Important Notes
- **Thai language primary** for all UI text, validation messages, tooltips
- **PDPA compliance**: Encrypt national IDs, consent tracking, audit logs
- **Dark theme**: XMAN Studio branding (purple/indigo gradients)
- **LINE OA**: Each fund has own LINE OA, webhook URL: `/api/line/webhook/{tenantCode}`
