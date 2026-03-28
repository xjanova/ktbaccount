<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Savings account transaction (รายการฝาก-ถอน).
 *
 * @property int $id
 * @property int $savings_account_id
 * @property string $type
 * @property float $amount
 * @property float $balance_after
 * @property Carbon $transaction_date
 * @property string|null $description
 * @property int|null $journal_entry_id
 * @property int $processed_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class SavingsTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'savings_account_id',
        'type',
        'amount',
        'balance_after',
        'transaction_date',
        'description',
        'journal_entry_id',
        'processed_by',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'balance_after' => 'decimal:2',
            'transaction_date' => 'date',
        ];
    }

    // ---------------------------------------------------------------
    // Relationships
    // ---------------------------------------------------------------

    public function savingsAccount(): BelongsTo
    {
        return $this->belongsTo(SavingsAccount::class);
    }

    public function journalEntry(): BelongsTo
    {
        return $this->belongsTo(JournalEntry::class);
    }

    public function processedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}
