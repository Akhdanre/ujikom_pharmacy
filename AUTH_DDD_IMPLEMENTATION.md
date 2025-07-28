# Authentication dengan Domain Driven Design (DDD)

## Overview

Sistem autentikasi telah diimplementasikan menggunakan Domain Driven Design (DDD) dengan 3 role: `admin`, `apoteker`, dan `users_pelanggan`. Fokus implementasi saat ini adalah untuk admin.

## Struktur DDD untuk Auth

```
app/
├── Domain/
│   ├── Auth/
│   │   └── Services/
│   │       └── AuthService.php
│   └── User/
│       ├── Entities/
│       │   └── User.php
│       ├── ValueObjects/
│       │   └── Role.php
│       ├── Repositories/
│       │   └── UserRepositoryInterface.php
│       └── Services/
├── Application/
│   ├── Services/
│   │   └── AuthApplicationService.php
│   └── DTOs/
│       └── UserDTO.php
├── Infrastructure/
│   └── Persistence/
│       └── EloquentUserRepository.php
└── Presentation/
    └── Livewire/
        └── Auth/
            ├── Login.php
            └── Register.php
```

## Role System

### 1. Admin
- **Akses**: Full access ke semua fitur
- **Permissions**: Manage medicines, transactions, reports, users
- **Email**: admin@apotek.com
- **Password**: admin123

### 2. Apoteker
- **Akses**: Admin panel untuk operasional
- **Permissions**: Manage medicines, transactions, reports
- **Email**: apoteker@apotek.com
- **Password**: apoteker123

### 3. Pelanggan
- **Akses**: Customer interface (belum diimplementasi)
- **Permissions**: View medicines, make purchases
- **Email**: pelanggan@apotek.com
- **Password**: pelanggan123

## Domain Entities

### User Entity
```php
class User extends Authenticatable
{
    // Business Logic Methods
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function canAccessAdminPanel(): bool
    {
        return $this->hasAnyRole(['admin', 'apoteker']);
    }

    public function canManageMedicines(): bool
    {
        return $this->hasAnyRole(['admin', 'apoteker']);
    }

    public function updateRole(string $newRole): void
    {
        $validRoles = ['admin', 'apoteker', 'users_pelanggan'];
        
        if (!in_array($newRole, $validRoles)) {
            throw new \InvalidArgumentException('Invalid role');
        }

        $this->role = $newRole;
        $this->save();
    }
}
```

### Role Value Object
```php
class Role
{
    public const ADMIN = 'admin';
    public const APOTEKER = 'apoteker';
    public const PELANGGAN = 'users_pelanggan';

    public function canAccessAdminPanel(): bool
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
}
```

## Domain Services

### AuthService
```php
class AuthService
{
    public function login(string $email, string $password): ?User
    {
        $user = $this->userRepository->findByEmail($email);
        
        if (!$user || !$user->isActive()) {
            return null;
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
        
        if ($this->userRepository->findByEmail($data['email'])) {
            throw new \InvalidArgumentException('Email already exists');
        }

        $data['password'] = Hash::make($data['password']);
        $data['is_active'] = true;

        $user = new User($data);
        return $this->userRepository->save($user);
    }

    public function canAccessAdminPanel(User $user): bool
    {
        return $user->canAccessAdminPanel();
    }
}
```

## Application Services

### AuthApplicationService
```php
class AuthApplicationService
{
    public function login(string $email, string $password): ?UserDTO
    {
        $user = $this->authService->login($email, $password);
        return $user ? $this->entityToDTO($user) : null;
    }

    public function register(array $data): UserDTO
    {
        $user = $this->authService->register($data);
        return $this->entityToDTO($user);
    }

    public function canAccessAdminPanel(User $user): bool
    {
        return $this->authService->canAccessAdminPanel($user);
    }
}
```

## Livewire Components

### Login Component
```php
class Login extends Component
{
    public function login()
    {
        $this->validate();

        try {
            $authService = app(AuthApplicationService::class);
            $user = $authService->login($this->email, $this->password);

            if ($user && $user->canAccessAdminPanel()) {
                session()->flash('message', 'Login berhasil!');
                return redirect()->intended('/dashboard');
            } else {
                session()->flash('error', 'Email atau password salah');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat login');
        }
    }
}
```

## Database Schema

### Users Table
```sql
ALTER TABLE users ADD COLUMN role ENUM('admin', 'apoteker', 'users_pelanggan') DEFAULT 'users_pelanggan';
ALTER TABLE users ADD COLUMN phone VARCHAR(255) NULL;
ALTER TABLE users ADD COLUMN address TEXT NULL;
ALTER TABLE users ADD COLUMN is_active BOOLEAN DEFAULT TRUE;
```

## Middleware

### AdminMiddleware
```php
class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        
        if (!$this->authService->canAccessAdminPanel($user)) {
            session()->flash('error', 'Anda tidak memiliki akses ke halaman ini');
            return redirect()->route('login');
        }

        return $next($request);
    }
}
```

## Routes

```php
// Auth Routes
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');

// Protected Routes
Route::middleware(['auth:sanctum', 'verified', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/medicines', MedicineIndex::class)->name('medicines.index');
});
```

## Testing Data

Seeder telah dibuat dengan data testing:

### Admin User
- **Email**: admin@apotek.com
- **Password**: admin123
- **Role**: admin
- **Permissions**: Full access

### Apoteker User
- **Email**: apoteker@apotek.com
- **Password**: apoteker123
- **Role**: apoteker
- **Permissions**: Admin panel access

### Pelanggan User
- **Email**: pelanggan@apotek.com
- **Password**: pelanggan123
- **Role**: users_pelanggan
- **Permissions**: Customer access (belum diimplementasi)

## Features Implemented

### ✅ Login System
- Email dan password validation
- Role-based access control
- Session management
- Error handling

### ✅ Register System
- User registration dengan role selection
- Email uniqueness validation
- Password confirmation
- Profile data (name, phone, address)

### ✅ Role Management
- Admin, Apoteker, Pelanggan roles
- Permission-based access control
- Role validation
- Role display names

### ✅ Middleware Protection
- Admin middleware untuk protected routes
- Automatic redirect untuk unauthorized access
- Session-based authentication

### ✅ Business Logic
- User activation/deactivation
- Password change functionality
- Profile update
- Role update

## Security Features

1. **Password Hashing**: Menggunakan bcrypt
2. **Email Validation**: Format dan uniqueness check
3. **Role Validation**: Hanya role yang valid
4. **Session Security**: CSRF protection
5. **Access Control**: Middleware-based protection

## Usage

### Login sebagai Admin
1. Akses: `http://localhost:8000/login`
2. Email: `admin@apotek.com`
3. Password: `admin123`
4. Redirect ke dashboard

### Register User Baru
1. Akses: `http://localhost:8000/register`
2. Isi form dengan data yang valid
3. Pilih role yang sesuai
4. Login dengan akun baru

### Access Control
- Hanya admin dan apoteker yang bisa akses `/medicines`
- Pelanggan akan di-redirect ke login
- Session management otomatis

## Next Steps

1. **Customer Interface**: Implementasi interface untuk pelanggan
2. **Password Reset**: Fitur lupa password
3. **Email Verification**: Verifikasi email
4. **Profile Management**: Edit profile user
5. **User Management**: Admin dapat manage users
6. **Activity Logging**: Log aktivitas user
7. **API Authentication**: JWT/Sanctum untuk mobile app

## Running the Application

1. **Setup Database**:
```bash
php artisan migrate:fresh --seed
```

2. **Access Login**:
```
http://localhost:8000/login
```

3. **Test Admin Access**:
- Login dengan admin@apotek.com
- Akses /medicines
- Test role-based permissions

4. **Test Register**:
```
http://localhost:8000/register
```

Implementasi Auth DDD ini memberikan fondasi yang kuat untuk sistem autentikasi yang scalable dan maintainable dengan role-based access control yang proper. 