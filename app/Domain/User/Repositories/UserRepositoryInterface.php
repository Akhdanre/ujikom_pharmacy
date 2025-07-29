<?php

namespace App\Domain\User\Repositories;

use App\Domain\User\Entities\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function findById(int $id): ?User;
    
    public function findByEmail(string $email): ?User;
    
    public function findByUsername(string $username): ?User;
    
    public function findByRole(string $role): Collection;
    
    public function findActive(): Collection;
    
    public function findInactive(): Collection;
    
    public function save(User $user): User;
    
    public function delete(User $user): bool;
    
    public function getAll(): Collection;
    
    public function search(string $query): Collection;
    
    public function getAdmins(): Collection;
    
    public function getPharmacists(): Collection;
    
    public function getBuyers(): Collection;
    
    public function getSuppliers(): Collection;
    
    public function getUsersByRole(array $roles): Collection;
    
    public function getUsersWithTransactions(): Collection;
    
    public function getTopBuyers(int $limit = 10): Collection;
    
    public function getTopSellers(int $limit = 10): Collection;
    
    public function getUsersByDateRange(string $startDate, string $endDate): Collection;
    
    public function getActiveUsersCount(): int;
    
    public function getInactiveUsersCount(): int;
    
    public function getUsersCountByRole(string $role): int;
} 