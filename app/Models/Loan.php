<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\LoanStatus;
use App\Traits\Auditable;
use App\Traits\BelongsToTenant;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Loan (สัญญาเงินกู้) for a village fund member.
 *
 * @property int $id
 * @property int $tenant_id
 * @property int $account_set_id
 * @property int $member_id
 * @property string $loan_code
 * @property string $loan_type
 * @property float $principal
 * @property float $interest_rate
 * @property int $term_months
 * @property Carbon|null $approved_date
 * @property Carbon|null $disbursed_date
 * @property Carbon|null $due_date
 * @property LoanStatus $status
 * @property int|null $guarantor_1_id
 * @property int|null $guarantor_2_id
 * @property int|null $approved_by
 * @property float $outstanding_balance
 * @property int|null $journal_entry_id
 * @property int $created_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
class Loan extends Model
{
    use Auditable, BelongsToTenant, HasFactory, SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'account_set_id',
        'member_id',
        'loan_code',
        'loan_type',
        'principal',
        'interest_rate',
        'term_months',
        'approved_date',
        'disbursed_date',
        'due_date',
        'status',
        'guarantor_1_id',
        'guarantor_2_id',
        'approved_by',
        'outstanding_balance',
        'journal_entry_id',
        'created_by',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'principal' => 'decimal:2',
            'interest_rate' => 'decimal:2',
            'outstanding_balance' => 'decimal:2',
            'approved_date' => 'date',
            'disbursed_date' => 'date',
            'due_date' => 'date',
            'status' => LoanStatus::class,
        ];
    }

    // ---------------------------------------------------------------
    // Relationships
    // ---------------------------------------------------------------

    public function accountSet(): BelongsTo
    {
        return $this->belongsTo(AccountSet::class);
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function guarantor1(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'guarantor_1_id');
    }

    public function guarantor2(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'guarantor_2_id');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function journalEntry(): BelongsTo
    {
        return $this->belongsTo(JournalEntry::class);
    }

    /** @return HasMany<LoanSchedule> */
    public function schedules(): HasMany
    {
        return $this->hasMany(LoanSchedule::class);
    }

    /** @return HasMany<LoanPayment> */
    public function payments(): HasMany
    {
        return $this->hasMany(LoanPayment::class);
    }
}
