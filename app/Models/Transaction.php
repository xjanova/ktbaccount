<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\BelongsToTenant;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Financial transaction (รายการรับ-จ่าย) for a village fund.
 *
 * @property int $id
 * @property int $tenant_id
 * @property int $account_set_id
 * @property string $type
 * @property string $payment_method
 * @property int|null $bank_account_id
 * @property string $category
 * @property string|null $sub_category
 * @property float $amount
 * @property Carbon $transaction_date
 * @property string|null $description
 * @property string|null $counterparty_type
 * @property string|null $counterparty_name
 * @property int|null $member_id
 * @property string|null $receipt_number
 * @property int|null $journal_entry_id
 * @property int|null $template_id
 * @property int $created_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
class Transaction extends Model
{
    use Auditable, BelongsToTenant, HasFactory, SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'account_set_id',
        'type',
        'payment_method',
        'bank_account_id',
        'category',
        'sub_category',
        'amount',
        'transaction_date',
        'description',
        'counterparty_type',
        'counterparty_name',
        'member_id',
        'receipt_number',
        'journal_entry_id',
        'template_id',
        'created_by',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'transaction_date' => 'date',
        ];
    }

    // ---------------------------------------------------------------
    // Relationships
    // ---------------------------------------------------------------

    public function accountSet(): BelongsTo
    {
        return $this->belongsTo(AccountSet::class);
    }

    public function bankAccount(): BelongsTo
    {
        return $this->belongsTo(BankAccount::class);
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function journalEntry(): BelongsTo
    {
        return $this->belongsTo(JournalEntry::class);
    }

    public function template(): BelongsTo
    {
        return $this->belongsTo(TransactionTemplate::class, 'template_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
