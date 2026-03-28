<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Types of journal books used in Thai village fund accounting.
 */
enum JournalType: string
{
    case GENERAL = 'general';
    case CASH_RECEIPT = 'cash_receipt';
    case CASH_PAYMENT = 'cash_payment';
    case SALES = 'sales';
    case PURCHASE = 'purchase';

    /**
     * Get the Thai label for this journal type.
     */
    public function label(): string
    {
        return match ($this) {
            self::GENERAL => 'สมุดรายวันทั่วไป',
            self::CASH_RECEIPT => 'สมุดเงินสดรับ',
            self::CASH_PAYMENT => 'สมุดเงินสดจ่าย',
            self::SALES => 'สมุดรายวันขาย',
            self::PURCHASE => 'สมุดรายวันซื้อ',
        };
    }
}
