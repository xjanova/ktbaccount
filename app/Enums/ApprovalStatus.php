<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Approval workflow statuses for committee decisions.
 */
enum ApprovalStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';

    /**
     * Get the Thai label for this approval status.
     */
    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'รอพิจารณา',
            self::APPROVED => 'อนุมัติ',
            self::REJECTED => 'ไม่อนุมัติ',
        };
    }
}
