<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Lifecycle statuses for village fund loans.
 */
enum LoanStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case DISBURSED = 'disbursed';
    case ACTIVE = 'active';
    case COMPLETED = 'completed';
    case DEFAULTED = 'defaulted';
    case REJECTED = 'rejected';

    /**
     * Get the Thai label for this loan status.
     */
    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'รอดำเนินการ',
            self::APPROVED => 'อนุมัติแล้ว',
            self::DISBURSED => 'เบิกจ่ายแล้ว',
            self::ACTIVE => 'กำลังผ่อนชำระ',
            self::COMPLETED => 'ชำระครบแล้ว',
            self::DEFAULTED => 'ค้างชำระ',
            self::REJECTED => 'ไม่อนุมัติ',
        };
    }

    /**
     * Get the Tailwind CSS color class for this status.
     */
    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'text-yellow-600 bg-yellow-50',
            self::APPROVED => 'text-blue-600 bg-blue-50',
            self::DISBURSED => 'text-indigo-600 bg-indigo-50',
            self::ACTIVE => 'text-green-600 bg-green-50',
            self::COMPLETED => 'text-gray-600 bg-gray-50',
            self::DEFAULTED => 'text-red-600 bg-red-50',
            self::REJECTED => 'text-red-800 bg-red-100',
        };
    }
}
