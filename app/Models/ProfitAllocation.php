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
 * Profit allocation (การจัดสรรกำไร) for a village fund.
 *
 * @property int $id
 * @property int $tenant_id
 * @property int $account_set_id
 * @property int $fiscal_year
 * @property float $total_amount
 * @property Carbon|null $meeting_date
 * @property string|null $meeting_resolution
 * @property string $status
 * @property int $created_by
 * @property int|null $journal_entry_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class ProfitAllocation extends Model
{
    use Auditable, BelongsToTenant, HasFactory;

    protected $fillable = [
        'tenant_id',
        'account_set_id',
        'fiscal_year',
        'total_amount',
        'meeting_date',
        'meeting_resolution',
        'status',
        'created_by',
        'journal_entry_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'total_amount' => 'decimal:2',
            'meeting_date' => 'date',
        ];
    }

    // ---------------------------------------------------------------
    // Relationships
    // ---------------------------------------------------------------

    public function accountSet(): BelongsTo
    {
        return $this->belongsTo(AccountSet::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function journalEntry(): BelongsTo
    {
        return $this->belongsTo(JournalEntry::class);
    }

    /** @return HasMany<ProfitAllocationItem> */
    public function items(): HasMany
    {
        return $this->hasMany(ProfitAllocationItem::class);
    }
}
