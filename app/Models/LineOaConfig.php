<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * LINE OA configuration for a tenant.
 *
 * @property int $id
 * @property int $tenant_id
 * @property string|null $channel_id
 * @property string|null $channel_secret
 * @property string|null $access_token
 * @property bool $webhook_verified
 * @property string|null $rich_menu_id
 * @property string|null $greeting_message
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class LineOaConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'channel_id',
        'channel_secret',
        'access_token',
        'webhook_verified',
        'rich_menu_id',
        'greeting_message',
    ];

    protected $hidden = [
        'channel_secret',
        'access_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'webhook_verified' => 'boolean',
        ];
    }

    // ---------------------------------------------------------------
    // Relationships
    // ---------------------------------------------------------------

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
