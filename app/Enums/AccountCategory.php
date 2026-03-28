<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Chart of accounts categories following Thai accounting standards.
 */
enum AccountCategory: string
{
    case ASSET = 'asset';
    case LIABILITY = 'liability';
    case EQUITY = 'equity';
    case REVENUE = 'revenue';
    case EXPENSE = 'expense';

    /**
     * Get the Thai label for this category.
     */
    public function label(): string
    {
        return match ($this) {
            self::ASSET => 'สินทรัพย์',
            self::LIABILITY => 'หนี้สิน',
            self::EQUITY => 'ทุน',
            self::REVENUE => 'รายได้',
            self::EXPENSE => 'ค่าใช้จ่าย',
        };
    }

    /**
     * Get the numeric code prefix for this category (1-5).
     */
    public function code(): int
    {
        return match ($this) {
            self::ASSET => 1,
            self::LIABILITY => 2,
            self::EQUITY => 3,
            self::REVENUE => 4,
            self::EXPENSE => 5,
        };
    }
}
