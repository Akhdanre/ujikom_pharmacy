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
        'username',
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

    public function isPharmacist(): bool
    {
        return $this->role === 'pharmacist';
    }

    public function isBuyer(): bool
    {
        return $this->role === 'buyer';
    }

    public function isSupplier(): bool
    {
        return $this->role === 'supplier';
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
        return $this->hasAnyRole(['admin', 'pharmacist']);
    }

    public function canManageMedicines(): bool
    {
        return $this->hasAnyRole(['admin', 'pharmacist']);
    }

    public function canManageTransactions(): bool
    {
        return $this->hasAnyRole(['admin', 'pharmacist']);
    }

    public function canViewReports(): bool
    {
        return $this->hasAnyRole(['admin', 'pharmacist']);
    }

    public function canPurchase(): bool
    {
        return $this->hasAnyRole(['admin', 'pharmacist', 'buyer']);
    }

    public function canSell(): bool
    {
        return $this->hasAnyRole(['admin', 'pharmacist']);
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
        $validRoles = ['admin', 'pharmacist', 'buyer', 'supplier'];
        
        if (!in_array($newRole, $validRoles)) {
            throw new \InvalidArgumentException('Invalid role');
        }

        $this->role = $newRole;
        $this->save();
    }

    public function updateProfile(array $data): void
    {
        $allowedFields = ['username', 'name', 'phone', 'address'];
        
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
        return $this->name ?? $this->username ?? $this->email;
    }

    public function getRoleDisplayName(): string
    {
        return match($this->role) {
            'admin' => 'Administrator',
            'pharmacist' => 'Pharmacist',
            'buyer' => 'Buyer',
            'supplier' => 'Supplier',
            default => 'Unknown'
        };
    }

    public function getRoleColor(): string
    {
        return match($this->role) {
            'admin' => 'red',
            'pharmacist' => 'blue',
            'buyer' => 'green',
            'supplier' => 'orange',
            default => 'gray'
        };
    }

    // Relationships
    public function purchaseTransactions(): HasMany
    {
        return $this->hasMany(\App\Domain\Purchase\Entities\PurchaseTransaction::class);
    }

    public function salesTransactions(): HasMany
    {
        return $this->hasMany(\App\Domain\Sales\Entities\SalesTransaction::class);
    }
} 