<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\MemberStatus;
use App\Traits\Auditable;
use App\Traits\BelongsToTenant;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Member of a village fund.
 *
 * @property int $id
 * @property int $tenant_id
 * @property int|null $user_id
 * @property string $member_code
 * @property string|null $title
 * @property string $first_name
 * @property string $last_name
 * @property string|null $national_id_encrypted
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $occupation
 * @property Carbon|null $birth_date
 * @property Carbon|null $joined_date
 * @property float $membership_fee_paid
 * @property string $status
 * @property string|null $photo_path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
class Member extends Model
{
    use Auditable, BelongsToTenant, HasFactory, SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'user_id',
        'member_code',
        'title',
        'first_name',
        'last_name',
        'national_id_encrypted',
        'phone',
        'address',
        'birth_date',
        'joined_date',
        'membership_fee_paid',
        'status',
        'occupation',
        'photo_path',
    ];

    protected $hidden = [
        'national_id_encrypted',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'joined_date' => 'date',
            'membership_fee_paid' => 'decimal:2',
            'status' => MemberStatus::class,
        ];
    }

    // ---------------------------------------------------------------
    // Accessors
    // ---------------------------------------------------------------

    /**
     * Get the member's full name.
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => trim("{$this->first_name} {$this->last_name}"),
        );
    }

    // ---------------------------------------------------------------
    // Relationships
    // ---------------------------------------------------------------

    /**
     * The user account linked to this member (if registered).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** @return HasMany<Loan> */
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
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

    /** @return HasMany<LoanPayment> */
    public function loanPayments(): HasMany
    {
        return $this->hasMany(LoanPayment::class);
    }

    /** @return HasMany<Transaction> */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
