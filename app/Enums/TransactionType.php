<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Transaction types for fund financial operations.
 */
enum TransactionType: string
{
    case INCOME = 'income';
    case EXPENSE = 'expense';

    /**
     * Get the Thai label for this transaction type.
     */
    public function label(): string
    {
        return match ($this) {
            self::INCOME => 'รายรับ',
            self::EXPENSE => 'รายจ่าย',
        };
    }
}
