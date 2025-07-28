<?php

namespace App\Domain\User\ValueObjects;

class Role
{
    private string $value;

    public const ADMIN = 'admin';
    public const APOTEKER = 'apoteker';
    public const PELANGGAN = 'users_pelanggan';

    private const VALID_ROLES = [
        self::ADMIN,
        self::APOTEKER,
        self::PELANGGAN
    ];

    public function __construct(string $role)
    {
        $this->validate($role);
        $this->value = $role;
    }

    private function validate(string $role): void
    {
        if (!in_array($role, self::VALID_ROLES)) {
            throw new \InvalidArgumentException('Invalid role: ' . $role);
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function isAdmin(): bool
    {
        return $this->value === self::ADMIN;
    }

    public function isApoteker(): bool
    {
        return $this->value === self::APOTEKER;
    }

    public function isPelanggan(): bool
    {
        return $this->value === self::PELANGGAN;
    }

    public function canAccessAdminPanel(): bool
    {
        return in_array($this->value, [self::ADMIN, self::APOTEKER]);
    }

    public function canManageMedicines(): bool
    {
        return in_array($this->value, [self::ADMIN, self::APOTEKER]);
    }

    public function canManageTransactions(): bool
    {
        return in_array($this->value, [self::ADMIN, self::APOTEKER]);
    }

    public function canViewReports(): bool
    {
        return in_array($this->value, [self::ADMIN, self::APOTEKER]);
    }

    public function getDisplayName(): string
    {
        return match($this->value) {
            self::ADMIN => 'Administrator',
            self::APOTEKER => 'Apoteker',
            self::PELANGGAN => 'Pelanggan',
            default => 'Unknown'
        };
    }

    public function getColor(): string
    {
        return match($this->value) {
            self::ADMIN => 'red',
            self::APOTEKER => 'blue',
            self::PELANGGAN => 'green',
            default => 'gray'
        };
    }

    public function equals(Role $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public static function getValidRoles(): array
    {
        return self::VALID_ROLES;
    }
} 