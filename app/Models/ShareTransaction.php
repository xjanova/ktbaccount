<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Share transaction (รายการซื้อ-ขายหุ้น).
 *
 * @property int $id
 * @property int $share_id
 * @property string $type
 * @property int $shares
 * @property float $amount
 * @property Carbon $transaction_date
 * @property int|null $journal_entry_id
 * @property int $processed_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class ShareTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'share_id',
        'type',
        'shares',
        'amount',
        'transaction_date',
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
            'transaction_date' => 'date',
        ];
    }

    // ---------------------------------------------------------------
    // Relationships
    // ---------------------------------------------------------------

    public function share(): BelongsTo
    {
        return $this->belongsTo(Share::class);
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
