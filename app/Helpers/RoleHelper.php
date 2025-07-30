<?php

namespace App\Helpers;

use App\Domain\User\Entities\User;

class RoleHelper
{
    /**
     * Check if user has specific role
     */
    public static function hasRole(User $user, string $role): bool
    {
        return $user->hasRole($role);
    }

    /**
     * Check if user has any of the specified roles
     */
    public static function hasAnyRole(User $user, array $roles): bool
    {
        return $user->hasAnyRole($roles);
    }

    /**
     * Get user's role display name
     */
    public static function getRoleDisplayName(User $user): string
    {
        return $user->getRoleDisplayName();
    }

    /**
     * Get user's role color for UI
     */
    public static function getRoleColor(User $user): string
    {
        return $user->getRoleColor();
    }

    /**
     * Check if user can access admin panel
     */
    public static function canAccessAdminPanel(User $user): bool
    {
        return $user->canAccessAdminPanel();
    }

    /**
     * Check if user can manage medicines
     */
    public static function canManageMedicines(User $user): bool
    {
        return $user->canManageMedicines();
    }

    /**
     * Check if user can manage transactions
     */
    public static function canManageTransactions(User $user): bool
    {
        return $user->canManageTransactions();
    }

    /**
     * Check if user can view reports
     */
    public static function canViewReports(User $user): bool
    {
        return $user->canViewReports();
    }

    /**
     * Check if user can purchase
     */
    public static function canPurchase(User $user): bool
    {
        return $user->canPurchase();
    }

    /**
     * Check if user can sell
     */
    public static function canSell(User $user): bool
    {
        return $user->canSell();
    }

    /**
     * Get dashboard route based on user role
     */
    public static function getDashboardRoute(User $user): string
    {
        return match($user->role) {
            'admin' => 'admin.dashboard',
            'pharmacist' => 'pharmacist.dashboard',
            'buyer' => 'user.dashboard',
            default => 'home'
        };
    }

    /**
     * Get all available roles
     */
    public static function getAvailableRoles(): array
    {
        return [
            'admin' => 'Administrator',
            'pharmacist' => 'Apoteker',
            'buyer' => 'Pembeli',
            'supplier' => 'Supplier'
        ];
    }
} 