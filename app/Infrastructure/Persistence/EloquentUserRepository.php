<?php

namespace App\Infrastructure\Persistence;

use App\Domain\User\Entities\User;
use App\Domain\User\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function findById(int $id): ?User
    {
        return User::find($id);
    }
    
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
    
    public function findByRole(string $role): Collection
    {
        return User::where('role', $role)->get();
    }
    
    public function findActive(): Collection
    {
        return User::where('is_active', true)->get();
    }
    
    public function findInactive(): Collection
    {
        return User::where('is_active', false)->get();
    }
    
    public function save(User $user): User
    {
        $user->save();
        return $user;
    }
    
    public function delete(User $user): bool
    {
        return $user->delete();
    }
    
    public function getAll(): Collection
    {
        return User::all();
    }
    
    public function search(string $query): Collection
    {
        return User::where(function ($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
              ->orWhere('email', 'like', "%{$query}%")
              ->orWhere('phone', 'like', "%{$query}%");
        })->get();
    }
    
    public function getAdmins(): Collection
    {
        return User::where('role', 'admin')->get();
    }
    
    public function getApotekers(): Collection
    {
        return User::where('role', 'apoteker')->get();
    }
    
    public function getPelanggans(): Collection
    {
        return User::where('role', 'users_pelanggan')->get();
    }
} 