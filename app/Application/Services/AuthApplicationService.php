<?php

namespace App\Application\Services;

use App\Application\DTOs\UserDTO;
use App\Domain\Auth\Services\AuthService;
use App\Domain\User\Entities\User;

class AuthApplicationService
{
    public function __construct(
        private AuthService $authService
    ) {}

    public function login(string $email, string $password): ?UserDTO
    {
        $user = $this->authService->login($email, $password);
        return $user ? $this->entityToDTO($user) : null;
    }

    public function loginWithUsername(string $username, string $password): ?UserDTO
    {
        $user = $this->authService->loginWithUsername($username, $password);
        return $user ? $this->entityToDTO($user) : null;
    }

    public function loginAndGetUser(string $email, string $password): ?User
    {
        $user = $this->authService->login($email, $password);
        if (!$user) {
            $user = $this->authService->loginWithUsername($email, $password);
        }
        return $user;
    }

    public function register(array $data): UserDTO
    {
        $user = $this->authService->register($data);
        return $this->entityToDTO($user);
    }

    public function logout(): void
    {
        $this->authService->logout();
    }

    public function changePassword(User $user, string $currentPassword, string $newPassword): bool
    {
        return $this->authService->changePassword($user, $currentPassword, $newPassword);
    }

    public function updateProfile(User $user, array $data): UserDTO
    {
        $updatedUser = $this->authService->updateProfile($user, $data);
        return $this->entityToDTO($updatedUser);
    }

    public function updateRole(User $user, string $newRole): UserDTO
    {
        $updatedUser = $this->authService->updateRole($user, $newRole);
        return $this->entityToDTO($updatedUser);
    }

    public function activateUser(int $userId): UserDTO
    {
        $user = $this->authService->activateUser($userId);
        return $this->entityToDTO($user);
    }

    public function deactivateUser(int $userId): UserDTO
    {
        $user = $this->authService->deactivateUser($userId);
        return $this->entityToDTO($user);
    }

    public function getUsersByRole(string $role): array
    {
        $users = $this->authService->getUsersByRole($role);
        return array_map(fn($user) => $this->entityToDTO($user), $users);
    }

    public function getActiveUsers(): array
    {
        $users = $this->authService->getActiveUsers();
        return array_map(fn($user) => $this->entityToDTO($user), $users);
    }

    public function searchUsers(string $query): array
    {
        $users = $this->authService->searchUsers($query);
        return array_map(fn($user) => $this->entityToDTO($user), $users);
    }

    public function canAccessAdminPanel(User $user): bool
    {
        return $this->authService->canAccessAdminPanel($user);
    }

    public function canManageMedicines(User $user): bool
    {
        return $this->authService->canManageMedicines($user);
    }

    public function canManageTransactions(User $user): bool
    {
        return $this->authService->canManageTransactions($user);
    }

    public function canViewReports(User $user): bool
    {
        return $this->authService->canViewReports($user);
    }

    private function entityToDTO(User $user): UserDTO
    {
        return UserDTO::fromArray($user->toArray());
    }
} 