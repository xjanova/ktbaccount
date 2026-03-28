<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\BelongsToTenant;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Journal entry (รายการบันทึกบัญชี).
 *
 * @property int $id
 * @property int $tenant_id
 * @property int $account_set_id
 * @property string $entry_number
 * @property Carbon $entry_date
 * @property int|null $fiscal_period_id
 * @property string $journal_type
 * @property string $description
 * @property string|null $reference_number
 * @property string $entry_type
 * @property string|null $source_type
 * @property int|null $source_id
 * @property bool $is_posted
 * @property int $created_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class JournalEntry extends Model
{
    use Auditable, BelongsToTenant, HasFactory;

    protected $fillable = [
        'tenant_id',
        'account_set_id',
        'entry_number',
        'entry_date',
        'fiscal_period_id',
        'journal_type',
        'description',
        'reference_number',
        'entry_type',
        'source_type',
        'source_id',
        'is_posted',
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
            'entry_date' => 'date',
            'is_posted' => 'boolean',
        ];
    }

    // ---------------------------------------------------------------
    // Relationships
    // ---------------------------------------------------------------

    /**
     * The account set this entry belongs to.
     */
    public function accountSet(): BelongsTo
    {
        return $this->belongsTo(AccountSet::class);
    }

    /**
     * The fiscal period this entry belongs to.
     */
    public function fiscalPeriod(): BelongsTo
    {
        return $this->belongsTo(FiscalPeriod::class);
    }

    /**
     * The user who created this entry.
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * The line items of this journal entry.
     */
    public function lines(): HasMany
    {
        return $this->hasMany(JournalEntryLine::class);
    }

    // ---------------------------------------------------------------
    // Methods
    // ---------------------------------------------------------------

    /**
     * Check if total debits equal total credits.
     */
    public function isBalanced(): bool
    {
        $totals = $this->lines()
            ->selectRaw('COALESCE(SUM(debit), 0) as total_debit, COALESCE(SUM(credit), 0) as total_credit')
            ->first();

        return bccomp((string) $totals->total_debit, (string) $totals->total_credit, 2) === 0;
    }
}
