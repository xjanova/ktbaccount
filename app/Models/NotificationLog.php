<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\BelongsToTenant;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Notification log entry (บันทึกการแจ้งเตือน).
 *
 * @property int $id
 * @property int $tenant_id
 * @property int|null $user_id
 * @property string $channel
 * @property string $type
 * @property string $title
 * @property string $body
 * @property array|null $data
 * @property Carbon|null $sent_at
 * @property Carbon|null $read_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class NotificationLog extends Model
{
    use BelongsToTenant, HasFactory;

    protected $table = 'notifications_log';

    protected $fillable = [
        'tenant_id',
        'user_id',
        'channel',
        'type',
        'title',
        'body',
        'data',
        'sent_at',
        'read_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'data' => 'array',
            'sent_at' => 'datetime',
            'read_at' => 'datetime',
        ];
    }

    // ---------------------------------------------------------------
    // Relationships
    // ---------------------------------------------------------------

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
