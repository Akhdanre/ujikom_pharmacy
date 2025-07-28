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
    
    public function findByUsername(string $username): ?User
    {
        return User::where('username', $username)->first();
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
        return User::where('name', 'like', "%{$query}%")
            ->orWhere('username', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->get();
    }
    
    public function getAdmins(): Collection
    {
        return User::where('role', 'admin')->get();
    }
    
    public function getPharmacists(): Collection
    {
        return User::where('role', 'pharmacist')->get();
    }
    
    public function getBuyers(): Collection
    {
        return User::where('role', 'buyer')->get();
    }
    
    public function getSuppliers(): Collection
    {
        return User::where('role', 'supplier')->get();
    }
    
    public function getUsersByRole(array $roles): Collection
    {
        return User::whereIn('role', $roles)->get();
    }
    
    public function getUsersWithTransactions(): Collection
    {
        return User::with(['purchaseTransactions', 'salesTransactions'])->get();
    }
    
    public function getTopBuyers(int $limit = 10): Collection
    {
        return User::select('users.*')
            ->join('purchase_transactions', 'users.id', '=', 'purchase_transactions.user_id')
            ->selectRaw('SUM(purchase_transactions.total_price) as total_purchase_amount')
            ->selectRaw('COUNT(purchase_transactions.transaction_id) as purchase_count')
            ->groupBy('users.id')
            ->orderBy('total_purchase_amount', 'desc')
            ->limit($limit)
            ->get();
    }
    
    public function getTopSellers(int $limit = 10): Collection
    {
        return User::select('users.*')
            ->join('sales_transactions', 'users.id', '=', 'sales_transactions.user_id')
            ->selectRaw('SUM(sales_transactions.total_price) as total_sales_amount')
            ->selectRaw('COUNT(sales_transactions.transaction_id) as sales_count')
            ->groupBy('users.id')
            ->orderBy('total_sales_amount', 'desc')
            ->limit($limit)
            ->get();
    }
    
    public function getUsersByDateRange(string $startDate, string $endDate): Collection
    {
        return User::whereBetween('created_at', [$startDate, $endDate])->get();
    }
    
    public function getActiveUsersCount(): int
    {
        return User::where('is_active', true)->count();
    }
    
    public function getInactiveUsersCount(): int
    {
        return User::where('is_active', false)->count();
    }
    
    public function getUsersCountByRole(string $role): int
    {
        return User::where('role', $role)->count();
    }
} 