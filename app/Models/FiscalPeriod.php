<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\BelongsToTenant;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Fiscal period (งวดบัญชี) for a village fund.
 *
 * Tracks accounting periods, their open/closed status, and closing balances.
 *
 * @property int $id
 * @property int $tenant_id
 * @property string $name
 * @property int $year
 * @property int $period
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property bool $is_closed
 * @property int|null $closed_by
 * @property Carbon|null $closed_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class FiscalPeriod extends Model
{
    use Auditable, BelongsToTenant, HasFactory;

    protected $fillable = [
        'tenant_id',
        'name',
        'year',
        'period',
        'start_date',
        'end_date',
        'is_closed',
        'closed_by',
        'closed_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'period' => 'integer',
            'start_date' => 'date',
            'end_date' => 'date',
            'is_closed' => 'boolean',
            'closed_at' => 'datetime',
        ];
    }

    // ---------------------------------------------------------------
    // Scopes
    // ---------------------------------------------------------------

    /**
     * Scope to filter fiscal periods by year.
     */
    public function scopeForYear(Builder $query, int $year): Builder
    {
        return $query->where('year', $year);
    }

    /**
     * Scope to get only open (not closed) fiscal periods.
     */
    public function scopeOpen(Builder $query): Builder
    {
        return $query->where('is_closed', false);
    }

    // ---------------------------------------------------------------
    // Relationships
    // ---------------------------------------------------------------

    /**
     * The user who closed this fiscal period.
     */
    public function closedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'closed_by');
    }

    /**
     * Journal entries within this fiscal period.
     */
    public function journalEntries(): HasMany
    {
        return $this->hasMany(JournalEntry::class);
    }
}
