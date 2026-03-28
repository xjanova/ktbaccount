<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Roles within a village fund (กองทุนหมู่บ้าน).
 *
 * Hierarchy levels: 1 = highest (admin), 7 = lowest (member).
 */
enum FundRole: string
{
    case ADMIN = 'fund_admin';
    case MANAGER = 'fund_manager';
    case ACCOUNTANT = 'accountant';
    case COMMITTEE = 'committee';
    case BANK_OFFICER = 'bank_officer';
    case GOV_OFFICER = 'gov_officer';
    case MEMBER = 'member';

    /**
     * Get the Thai label for this role.
     */
    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'ผู้ดูแลกองทุน',
            self::MANAGER => 'ผู้จัดการกองทุน',
            self::ACCOUNTANT => 'เหรัญญิก',
            self::COMMITTEE => 'กรรมการ',
            self::BANK_OFFICER => 'เจ้าหน้าที่ธนาคาร',
            self::GOV_OFFICER => 'เจ้าหน้าที่รัฐ',
            self::MEMBER => 'สมาชิก',
        };
    }

    /**
     * Get the hierarchy level (1 = highest privilege, 7 = lowest).
     */
    public function level(): int
    {
        return match ($this) {
            self::ADMIN => 1,
            self::MANAGER => 2,
            self::ACCOUNTANT => 3,
            self::COMMITTEE => 4,
            self::BANK_OFFICER => 5,
            self::GOV_OFFICER => 6,
            self::MEMBER => 7,
        };
    }
}
