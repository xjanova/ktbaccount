<?php

declare(strict_types=1);

namespace App\Models;

use App\Helpers\TenantContext;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * User model with multi-tenant role support.
 *
 * A user can belong to multiple tenants with different roles in each.
 * Super admins have unrestricted access across all tenants.
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string|null $national_id
 * @property string $password
 * @property bool $is_super_admin
 * @property bool $is_active
 * @property Carbon|null $pdpa_consented_at
 * @property Carbon|null $email_verified_at
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
class User extends Authenticatable
{
    use Auditable, HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'national_id',
        'password',
        'is_super_admin',
        'is_active',
        'pdpa_consented_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'national_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'pdpa_consented_at' => 'datetime',
            'password' => 'hashed',
            'is_super_admin' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    // ---------------------------------------------------------------
    // Relationships
    // ---------------------------------------------------------------

    /**
     * Tenants this user belongs to (with role info in pivot).
     */
    public function tenants(): BelongsToMany
    {
        return $this->belongsToMany(Tenant::class, 'tenant_user')
            ->withPivot(['role', 'is_primary', 'permissions', 'joined_at'])
            ->withTimestamps();
    }

    /**
     * Member profiles linked to this user across tenants.
     */
    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }

    /**
     * PDPA consent records for this user.
     */
    public function pdpaConsents(): HasMany
    {
        return $this->hasMany(PdpaConsent::class);
    }

    /**
     * Audit log entries created by this user.
     */
    public function auditLogs(): HasMany
    {
        return $this->hasMany(AuditLog::class);
    }

    // ---------------------------------------------------------------
    // Role & Permission Helpers
    // ---------------------------------------------------------------

    /**
     * Check if the user is a super admin.
     */
    public function isSuperAdmin(): bool
    {
        return $this->is_super_admin === true;
    }

    /**
     * Get all tenants where this user has a specific role.
     *
     * @param  string  $role  The role value (e.g., 'fund_admin').
     * @return Collection<Tenant>
     */
    public function tenantsWithRole(string $role)
    {
        return $this->tenants()->wherePivot('role', $role)->get();
    }

    /**
     * Get the user's role in the current tenant context.
     *
     * @return string|null The role value or null if not in a tenant.
     */
    public function currentTenantRole(): ?string
    {
        $tenantId = TenantContext::id();

        if ($tenantId === null) {
            return null;
        }

        $pivot = $this->tenants()->where('tenants.id', $tenantId)->first();

        return $pivot?->pivot?->role;
    }

    /**
     * Check if the user has a given role in a specific tenant.
     *
     * @param  string  $role  The role to check.
     * @param  int|null  $tenantId  The tenant ID (defaults to current context).
     */
    public function hasRole(string $role, ?int $tenantId = null): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        $tenantId = $tenantId ?? TenantContext::id();

        if ($tenantId === null) {
            return false;
        }

        return $this->tenants()
            ->where('tenants.id', $tenantId)
            ->wherePivot('role', $role)
            ->exists();
    }
}
