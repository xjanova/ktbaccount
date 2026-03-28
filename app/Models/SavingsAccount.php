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
 * Savings account (บัญชีออมทรัพย์) for a village fund member.
 *
 * @property int $id
 * @property int $tenant_id
 * @property int|null $account_set_id
 * @property int $member_id
 * @property string $account_number
 * @property string $account_type
 * @property float $balance
 * @property float $interest_rate
 * @property Carbon $opened_date
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class SavingsAccount extends Model
{
    use Auditable, BelongsToTenant, HasFactory;

    protected $fillable = [
        'tenant_id',
        'account_set_id',
        'member_id',
        'account_number',
        'account_type',
        'balance',
        'interest_rate',
        'opened_date',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'balance' => 'decimal:2',
            'interest_rate' => 'decimal:2',
            'opened_date' => 'date',
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

    /** @return HasMany<SavingsTransaction> */
    public function transactions(): HasMany
    {
        return $this->hasMany(SavingsTransaction::class);
    }
}
