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
 * Share holding (หุ้นสมาชิก) for a village fund member.
 *
 * @property int $id
 * @property int $tenant_id
 * @property int|null $account_set_id
 * @property int $member_id
 * @property int $total_shares
 * @property float $total_value
 * @property float $share_price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Share extends Model
{
    use Auditable, BelongsToTenant, HasFactory;

    protected $fillable = [
        'tenant_id',
        'account_set_id',
        'member_id',
        'total_shares',
        'total_value',
        'share_price',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'total_value' => 'decimal:2',
            'share_price' => 'decimal:2',
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

    /** @return HasMany<ShareTransaction> */
    public function transactions(): HasMany
    {
        return $this->hasMany(ShareTransaction::class);
    }
}
