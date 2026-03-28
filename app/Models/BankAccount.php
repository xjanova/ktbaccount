<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\BelongsToTenant;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Bank account (บัญชีธนาคาร) for a village fund.
 *
 * @property int $id
 * @property int $tenant_id
 * @property string $bank_name
 * @property string $account_number
 * @property string $account_name
 * @property string|null $branch
 * @property string $account_type
 * @property float $balance
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class BankAccount extends Model
{
    use Auditable, BelongsToTenant, HasFactory;

    protected $fillable = [
        'tenant_id',
        'bank_name',
        'account_number',
        'account_name',
        'branch',
        'account_type',
        'balance',
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
            'balance' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }
}
