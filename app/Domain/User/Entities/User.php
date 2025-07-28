<?php

namespace App\Domain\User\Entities;

use App\Domain\User\ValueObjects\Email;
use App\Domain\User\ValueObjects\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'is_active',
        'email_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    // Business Logic Methods
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isApoteker(): bool
    {
        return $this->role === 'apoteker';
    }

    public function isPelanggan(): bool
    {
        return $this->role === 'users_pelanggan';
    }

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->role, $roles);
    }

    public function canAccessAdminPanel(): bool
    {
        return $this->hasAnyRole(['admin', 'apoteker']);
    }

    public function canManageMedicines(): bool
    {
        return $this->hasAnyRole(['admin', 'apoteker']);
    }

    public function canManageTransactions(): bool
    {
        return $this->hasAnyRole(['admin', 'apoteker']);
    }

    public function canViewReports(): bool
    {
        return $this->hasAnyRole(['admin', 'apoteker']);
    }

    public function activate(): void
    {
        $this->is_active = true;
        $this->save();
    }

    public function deactivate(): void
    {
        $this->is_active = false;
        $this->save();
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function updateRole(string $newRole): void
    {
        $validRoles = ['admin', 'apoteker', 'users_pelanggan'];
        
        if (!in_array($newRole, $validRoles)) {
            throw new \InvalidArgumentException('Invalid role');
        }

        $this->role = $newRole;
        $this->save();
    }

    public function updateProfile(array $data): void
    {
        $allowedFields = ['name', 'phone', 'address'];
        
        foreach ($allowedFields as $field) {
            if (isset($data[$field])) {
                $this->$field = $data[$field];
            }
        }
        
        $this->save();
    }

    public function changePassword(string $newPassword): void
    {
        if (strlen($newPassword) < 8) {
            throw new \InvalidArgumentException('Password must be at least 8 characters');
        }

        $this->password = bcrypt($newPassword);
        $this->save();
    }

    public function getDisplayName(): string
    {
        return $this->name ?? $this->email;
    }

    public function getRoleDisplayName(): string
    {
        return match($this->role) {
            'admin' => 'Administrator',
            'apoteker' => 'Apoteker',
            'users_pelanggan' => 'Pelanggan',
            default => 'Unknown'
        };
    }

    public function getRoleColor(): string
    {
        return match($this->role) {
            'admin' => 'red',
            'apoteker' => 'blue',
            'users_pelanggan' => 'green',
            default => 'gray'
        };
    }

    // Relationships
    public function transactions(): HasMany
    {
        return $this->hasMany(\App\Domain\Transaction\Entities\Transaction::class);
    }

    public function customers(): HasMany
    {
        return $this->hasMany(\App\Domain\Customer\Entities\Customer::class);
    }
} 