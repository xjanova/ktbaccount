<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Loan payment record (รายการชำระเงินกู้).
 *
 * @property int $id
 * @property int $loan_id
 * @property int|null $loan_schedule_id
 * @property Carbon $payment_date
 * @property float $amount
 * @property float $principal_paid
 * @property float $interest_paid
 * @property string $payment_method
 * @property string|null $receipt_number
 * @property int|null $journal_entry_id
 * @property int $received_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class LoanPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'loan_schedule_id',
        'payment_date',
        'amount',
        'principal_paid',
        'interest_paid',
        'payment_method',
        'receipt_number',
        'journal_entry_id',
        'received_by',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'payment_date' => 'date',
            'amount' => 'decimal:2',
            'principal_paid' => 'decimal:2',
            'interest_paid' => 'decimal:2',
        ];
    }

    // ---------------------------------------------------------------
    // Relationships
    // ---------------------------------------------------------------

    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }

    public function loanSchedule(): BelongsTo
    {
        return $this->belongsTo(LoanSchedule::class);
    }

    public function journalEntry(): BelongsTo
    {
        return $this->belongsTo(JournalEntry::class);
    }

    public function receivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by');
    }
}
