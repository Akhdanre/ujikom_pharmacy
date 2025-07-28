<?php

namespace App\Application\DTOs;

class UserDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $role,
        public readonly ?string $phone,
        public readonly ?string $address,
        public readonly bool $is_active,
        public readonly ?string $email_verified_at,
        public readonly ?string $created_at,
        public readonly ?string $updated_at
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            name: $data['name'],
            email: $data['email'],
            role: $data['role'],
            phone: $data['phone'] ?? null,
            address: $data['address'] ?? null,
            is_active: (bool) ($data['is_active'] ?? true),
            email_verified_at: $data['email_verified_at'] ?? null,
            created_at: $data['created_at'] ?? null,
            updated_at: $data['updated_at'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'phone' => $this->phone,
            'address' => $this->address,
            'is_active' => $this->is_active,
            'email_verified_at' => $this->email_verified_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

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

    public function canAccessAdminPanel(): bool
    {
        return in_array($this->role, ['admin', 'apoteker']);
    }

    public function canManageMedicines(): bool
    {
        return in_array($this->role, ['admin', 'apoteker']);
    }

    public function canManageTransactions(): bool
    {
        return in_array($this->role, ['admin', 'apoteker']);
    }

    public function canViewReports(): bool
    {
        return in_array($this->role, ['admin', 'apoteker']);
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

    public function getDisplayName(): string
    {
        return $this->name ?: $this->email;
    }
} 