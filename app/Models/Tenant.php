<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Tenant model representing a village fund (กองทุนหมู่บ้าน).
 *
 * This is the root of the multi-tenant hierarchy. All tenant-scoped
 * models belong to a Tenant. The Tenant model itself is NOT tenant-scoped.
 *
 * @property int $id
 * @property string $name
 * @property string|null $code
 * @property string|null $village_name
 * @property string|null $sub_district
 * @property string|null $district
 * @property string|null $province
 * @property string|null $postal_code
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $logo_path
 * @property array|null $settings
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
class Tenant extends Model
{
    use Auditable, HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'village_name',
        'sub_district',
        'district',
        'province',
        'postal_code',
        'phone',
        'email',
        'logo_path',
        'settings',
        'is_active',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'settings' => 'array',
            'is_active' => 'boolean',
        ];
    }

    // ---------------------------------------------------------------
    // Relationships
    // ---------------------------------------------------------------

    /**
     * Users associated with this tenant (via pivot).
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'tenant_user')
            ->withPivot(['role', 'is_primary', 'permissions', 'joined_at'])
            ->withTimestamps();
    }

    /** @return HasMany<Member> */
    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }

    /** @return HasMany<AccountSet> */
    public function accountSets(): HasMany
    {
        return $this->hasMany(AccountSet::class);
    }

    /** @return HasMany<BankAccount> */
    public function bankAccounts(): HasMany
    {
        return $this->hasMany(BankAccount::class);
    }

    /** @return HasMany<Loan> */
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    /** @return HasMany<Transaction> */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /** @return HasMany<JournalEntry> */
    public function journalEntries(): HasMany
    {
        return $this->hasMany(JournalEntry::class);
    }

    /** @return HasMany<FiscalPeriod> */
    public function fiscalPeriods(): HasMany
    {
        return $this->hasMany(FiscalPeriod::class);
    }

    /** @return HasMany<SavingsAccount> */
    public function savingsAccounts(): HasMany
    {
        return $this->hasMany(SavingsAccount::class);
    }

    /** @return HasMany<Share> */
    public function shares(): HasMany
    {
        return $this->hasMany(Share::class);
    }

    /** @return HasMany<CommitteeMember> */
    public function committeeMembers(): HasMany
    {
        return $this->hasMany(CommitteeMember::class);
    }

    /** @return HasMany<NotificationLog> */
    public function notificationLogs(): HasMany
    {
        return $this->hasMany(NotificationLog::class);
    }

    /** @return HasMany<ApprovalRequest> */
    public function approvalRequests(): HasMany
    {
        return $this->hasMany(ApprovalRequest::class);
    }

    /** @return HasOne<LineOaConfig> */
    public function lineOaConfig(): HasOne
    {
        return $this->hasOne(LineOaConfig::class);
    }
}
