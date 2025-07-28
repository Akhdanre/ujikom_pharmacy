<?php

namespace App\Domain\Auth\Services;

use App\Domain\User\Entities\User;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Domain\User\ValueObjects\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function login(string $email, string $password): ?User
    {
        $user = $this->userRepository->findByEmail($email);
        
        if (!$user) {
            return null;
        }

        if (!$user->isActive()) {
            throw new \InvalidArgumentException('Account is deactivated');
        }

        if (!Hash::check($password, $user->password)) {
            return null;
        }

        Auth::login($user);
        return $user;
    }

    public function register(array $data): User
    {
        $this->validateRegistrationData($data);

        // Check if email already exists
        if ($this->userRepository->findByEmail($data['email'])) {
            throw new \InvalidArgumentException('Email already exists');
        }

        // Set default role if not provided
        if (!isset($data['role'])) {
            $data['role'] = Role::PELANGGAN;
        }

        // Hash password
        $data['password'] = Hash::make($data['password']);
        $data['is_active'] = true;

        $user = new User($data);
        return $this->userRepository->save($user);
    }

    public function logout(): void
    {
        Auth::logout();
    }

    public function changePassword(User $user, string $currentPassword, string $newPassword): bool
    {
        if (!Hash::check($currentPassword, $user->password)) {
            throw new \InvalidArgumentException('Current password is incorrect');
        }

        if (strlen($newPassword) < 8) {
            throw new \InvalidArgumentException('Password must be at least 8 characters');
        }

        $user->changePassword($newPassword);
        return true;
    }

    public function resetPassword(string $email): bool
    {
        $user = $this->userRepository->findByEmail($email);
        
        if (!$user) {
            return false;
        }

        // Generate reset token and send email
        // Implementation depends on your email service
        return true;
    }

    public function updateProfile(User $user, array $data): User
    {
        $allowedFields = ['name', 'phone', 'address'];
        
        foreach ($allowedFields as $field) {
            if (isset($data[$field])) {
                $user->$field = $data[$field];
            }
        }
        
        return $this->userRepository->save($user);
    }

    public function updateRole(User $user, string $newRole): User
    {
        $role = new Role($newRole);
        $user->updateRole($role->getValue());
        
        return $this->userRepository->save($user);
    }

    public function activateUser(int $userId): User
    {
        $user = $this->userRepository->findById($userId);
        
        if (!$user) {
            throw new \InvalidArgumentException('User not found');
        }

        $user->activate();
        return $this->userRepository->save($user);
    }

    public function deactivateUser(int $userId): User
    {
        $user = $this->userRepository->findById($userId);
        
        if (!$user) {
            throw new \InvalidArgumentException('User not found');
        }

        $user->deactivate();
        return $this->userRepository->save($user);
    }

    public function getUsersByRole(string $role): array
    {
        return $this->userRepository->findByRole($role)->toArray();
    }

    public function getActiveUsers(): array
    {
        return $this->userRepository->findActive()->toArray();
    }

    public function searchUsers(string $query): array
    {
        return $this->userRepository->search($query)->toArray();
    }

    public function canAccessAdminPanel(User $user): bool
    {
        return $user->canAccessAdminPanel();
    }

    public function canManageMedicines(User $user): bool
    {
        return $user->canManageMedicines();
    }

    public function canManageTransactions(User $user): bool
    {
        return $user->canManageTransactions();
    }

    public function canViewReports(User $user): bool
    {
        return $user->canViewReports();
    }

    private function validateRegistrationData(array $data): void
    {
        $requiredFields = ['name', 'email', 'password'];
        
        foreach ($requiredFields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                throw new \InvalidArgumentException("Field {$field} is required");
            }
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email format');
        }

        if (strlen($data['password']) < 8) {
            throw new \InvalidArgumentException('Password must be at least 8 characters');
        }

        if (isset($data['role'])) {
            $validRoles = Role::getValidRoles();
            if (!in_array($data['role'], $validRoles)) {
                throw new \InvalidArgumentException('Invalid role');
            }
        }
    }
} 