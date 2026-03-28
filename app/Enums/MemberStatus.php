<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Membership statuses within a village fund.
 */
enum MemberStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case SUSPENDED = 'suspended';
    case RESIGNED = 'resigned';

    /**
     * Get the Thai label for this member status.
     */
    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'ปกติ',
            self::INACTIVE => 'ไม่ใช้งาน',
            self::SUSPENDED => 'ระงับชั่วคราว',
            self::RESIGNED => 'ลาออก',
        };
    }
}
