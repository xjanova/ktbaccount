<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\AccountCategory;
use App\Traits\Auditable;
use App\Traits\BelongsToTenant;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Chart of account entry (ผังบัญชี) for double-entry bookkeeping.
 *
 * @property int $id
 * @property int $tenant_id
 * @property int $account_set_id
 * @property string $account_code
 * @property string $name
 * @property string|null $name_en
 * @property AccountCategory $category
 * @property int|null $parent_id
 * @property bool $is_control_account
 * @property bool $is_active
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class ChartOfAccount extends Model
{
    use Auditable, BelongsToTenant, HasFactory;

    protected $fillable = [
        'tenant_id',
        'account_set_id',
        'account_code',
        'name',
        'name_en',
        'category',
        'parent_id',
        'is_control_account',
        'is_active',
        'description',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'category' => AccountCategory::class,
            'is_control_account' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    // ---------------------------------------------------------------
    // Relationships
    // ---------------------------------------------------------------

    /**
     * The account set this chart entry belongs to.
     */
    public function accountSet(): BelongsTo
    {
        return $this->belongsTo(AccountSet::class);
    }

    /**
     * Parent account (for hierarchical chart of accounts).
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * Child accounts under this account.
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * Journal entry lines referencing this account.
     */
    public function journalEntryLines(): HasMany
    {
        return $this->hasMany(JournalEntryLine::class);
    }
}
