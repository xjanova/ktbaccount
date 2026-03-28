<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * PDPA consent record (บันทึกความยินยอม PDPA).
 *
 * @property int $id
 * @property int $user_id
 * @property string $consent_type
 * @property Carbon $consented_at
 * @property string|null $ip_address
 * @property Carbon|null $revoked_at
 * @property string $version
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class PdpaConsent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'consent_type',
        'consented_at',
        'ip_address',
        'revoked_at',
        'version',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'consented_at' => 'datetime',
            'revoked_at' => 'datetime',
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
