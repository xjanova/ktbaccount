<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Loan repayment schedule (ตารางผ่อนชำระ).
 *
 * @property int $id
 * @property int $loan_id
 * @property int $installment_no
 * @property Carbon $due_date
 * @property float $principal_amount
 * @property float $interest_amount
 * @property float $total_amount
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class LoanSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'installment_no',
        'due_date',
        'principal_amount',
        'interest_amount',
        'total_amount',
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
            'due_date' => 'date',
            'principal_amount' => 'decimal:2',
            'interest_amount' => 'decimal:2',
            'total_amount' => 'decimal:2',
        ];
    }

    // ---------------------------------------------------------------
    // Relationships
    // ---------------------------------------------------------------

    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }

    /** @return HasMany<LoanPayment> */
    public function payments(): HasMany
    {
        return $this->hasMany(LoanPayment::class);
    }
}
