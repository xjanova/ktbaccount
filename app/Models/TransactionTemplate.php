<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\BelongsToTenant;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Transaction template (แม่แบบรายการ) for repeating transactions.
 *
 * @property int $id
 * @property int $tenant_id
 * @property int $account_set_id
 * @property string $name
 * @property string $type
 * @property string $payment_method
 * @property string $category
 * @property string|null $sub_category
 * @property float|null $default_amount
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class TransactionTemplate extends Model
{
    use Auditable, BelongsToTenant, HasFactory;

    protected $fillable = [
        'tenant_id',
        'account_set_id',
        'name',
        'type',
        'payment_method',
        'category',
        'sub_category',
        'default_amount',
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
            'default_amount' => 'decimal:2',
        ];
    }

    // ---------------------------------------------------------------
    // Relationships
    // ---------------------------------------------------------------

    public function accountSet(): BelongsTo
    {
        return $this->belongsTo(AccountSet::class);
    }
}
