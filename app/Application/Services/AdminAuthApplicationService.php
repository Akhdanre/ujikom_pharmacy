<?php

namespace App\Application\Services;

use App\Domain\Auth\Services\AuthService;
use App\Domain\User\Entities\User;
use App\Domain\User\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthApplicationService
{
    public function __construct(
        private AuthService $authService,
        private UserRepositoryInterface $userRepository
    ) {}

    /**
     * Handle admin login process
     */
    public function loginAdmin(string $email, string $password, bool $remember = false): array
    {
        try {
            // Use domain service for authentication
            $user = $this->authService->login($email, $password);

            if (!$user) {
                return [
                    'success' => false,
                    'message' => 'Email atau password salah.',
                    'user' => null
                ];
            }

            // Check if user is admin
            if (!$user->isAdmin()) {
                $this->authService->logout();
                return [
                    'success' => false,
                    'message' => 'Akun ini tidak memiliki akses admin.',
                    'user' => null
                ];
            }

            // Set remember me if requested
            if ($remember) {
                Auth::login($user, true);
            }

            return [
                'success' => true,
                'message' => 'Login berhasil.',
                'user' => $user
            ];

        } catch (\InvalidArgumentException $e) {
            $this->authService->logout();
            
            if ($e->getMessage() === 'Account is deactivated') {
                return [
                    'success' => false,
                    'message' => 'Akun Anda telah dinonaktifkan.',
                    'user' => null
                ];
            }

            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat login.',
                'user' => null
            ];
        }
    }

    /**
     * Handle admin logout process
     */
    public function logoutAdmin(): array
    {
        try {
            $this->authService->logout();
            
            return [
                'success' => true,
                'message' => 'Logout berhasil.'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat logout.'
            ];
        }
    }

    /**
     * Check if current user can access admin panel
     */
    public function canAccessAdminPanel(): bool
    {
        if (!Auth::check()) {
            return false;
        }

        $user = Auth::user();
        return $this->authService->canAccessAdminPanel($user);
    }

    /**
     * Get current admin user
     */
    public function getCurrentAdmin(): ?User
    {
        if (!Auth::check()) {
            return null;
        }

        $user = Auth::user();
        
        if (!$user->isAdmin()) {
            return null;
        }

        return $user;
    }

    /**
     * Validate admin credentials without logging in
     */
    public function validateAdminCredentials(string $email, string $password): bool
    {
        $user = $this->userRepository->findByEmail($email);
        
        if (!$user) {
            return false;
        }

        if (!$user->isAdmin()) {
            return false;
        }

        if (!$user->isActive()) {
            return false;
        }

        return password_verify($password, $user->password);
    }

    /**
     * Get admin statistics
     */
    public function getAdminStats(): array
    {
        $adminUsers = $this->userRepository->findByRole('admin');
        $activeAdmins = $adminUsers->filter(fn($user) => $user->isActive());
        $inactiveAdmins = $adminUsers->filter(fn($user) => !$user->isActive());

        return [
            'total_admins' => $adminUsers->count(),
            'active_admins' => $activeAdmins->count(),
            'inactive_admins' => $inactiveAdmins->count(),
            'current_admin' => $this->getCurrentAdmin()
        ];
    }

    /**
     * Check if user is currently logged in as admin
     */
    public function isLoggedInAsAdmin(): bool
    {
        return Auth::check() && Auth::user()->isAdmin();
    }

    /**
     * Get admin session info
     */
    public function getAdminSessionInfo(): ?array
    {
        if (!$this->isLoggedInAsAdmin()) {
            return null;
        }

        $user = Auth::user();
        
        return [
            'id' => $user->id,
            'name' => $user->getDisplayName(),
            'email' => $user->email,
            'role' => $user->role,
            'role_display' => $user->getRoleDisplayName(),
            'is_active' => $user->isActive(),
            'last_login' => $user->updated_at
        ];
    }
} 