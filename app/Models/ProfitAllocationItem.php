<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Individual item within a profit allocation.
 *
 * @property int $id
 * @property int $profit_allocation_id
 * @property string $category
 * @property float $percentage
 * @property float $amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class ProfitAllocationItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'profit_allocation_id',
        'category',
        'percentage',
        'amount',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'percentage' => 'decimal:2',
            'amount' => 'decimal:2',
        ];
    }

    // ---------------------------------------------------------------
    // Relationships
    // ---------------------------------------------------------------

    public function profitAllocation(): BelongsTo
    {
        return $this->belongsTo(ProfitAllocation::class);
    }
}
