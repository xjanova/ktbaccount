<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Payment methods supported by village fund operations.
 */
enum PaymentMethod: string
{
    case CASH = 'cash';
    case BANK = 'bank';

    /**
     * Get the Thai label for this payment method.
     */
    public function label(): string
    {
        return match ($this) {
            self::CASH => 'เงินสด',
            self::BANK => 'โอนผ่านธนาคาร',
        };
    }
}
