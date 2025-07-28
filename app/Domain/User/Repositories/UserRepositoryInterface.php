<?php

namespace App\Domain\User\Repositories;

use App\Domain\User\Entities\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function findById(int $id): ?User;
    
    public function findByEmail(string $email): ?User;
    
    public function findByRole(string $role): Collection;
    
    public function findActive(): Collection;
    
    public function findInactive(): Collection;
    
    public function save(User $user): User;
    
    public function delete(User $user): bool;
    
    public function getAll(): Collection;
    
    public function search(string $query): Collection;
    
    public function getAdmins(): Collection;
    
    public function getApotekers(): Collection;
    
    public function getPelanggans(): Collection;
} 