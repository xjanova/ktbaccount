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
 * Committee member of a village fund.
 *
 * Represents a member who serves on the fund's committee with specific
 * positions and approval authority.
 *
 * @property int $id
 * @property int $tenant_id
 * @property int $member_id
 * @property string $position
 * @property Carbon|null $start_date
 * @property Carbon|null $end_date
 * @property bool $can_approve_loans
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class CommitteeMember extends Model
{
    use Auditable, BelongsToTenant, HasFactory;

    protected $fillable = [
        'tenant_id',
        'member_id',
        'position',
        'start_date',
        'end_date',
        'can_approve_loans',
        'is_active',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'can_approve_loans' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    // ---------------------------------------------------------------
    // Relationships
    // ---------------------------------------------------------------

    /**
     * The fund member who serves on the committee.
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Approval signatures made by this committee member.
     */
    public function approvalSignatures(): HasMany
    {
        return $this->hasMany(ApprovalSignature::class);
    }
}
