# Struktur Routing Berdasarkan Role

## Overview
Sistem routing telah dipisahkan berdasarkan role pengguna untuk meningkatkan keamanan dan organisasi kode. Setiap role memiliki akses ke fitur yang berbeda sesuai dengan tanggung jawabnya.

## Role yang Tersedia

### 1. User/Buyer (Pembeli)
- **Role**: `buyer`
- **Akses**: Halaman e-commerce publik dan fitur pembelian
- **Middleware**: `auth`, `user`

### 2. Pharmacist (Apoteker)
- **Role**: `pharmacist`
- **Akses**: Manajemen obat (read-only), transaksi penjualan, laporan dasar
- **Middleware**: `auth`, `pharmacist`

### 3. Admin (Administrator)
- **Role**: `admin`
- **Akses**: Semua fitur sistem, manajemen pengguna, laporan lengkap
- **Middleware**: `auth`, `admin`

## Struktur File Routing

```
routes/
├── web.php                    # Routing utama dan publik
├── auth.php                   # Routing autentikasi
└── roles/
    ├── user.php              # Routing untuk User/Buyer
    ├── pharmacist.php        # Routing untuk Pharmacist
    └── admin.php             # Routing untuk Admin
```

## Routing Berdasarkan Role

### User/Buyer Routes (`/user/*`)
- `/user/dashboard` - Dashboard pembeli
- `/user/profile` - Profil pengguna
- `/user/orders` - Pesanan aktif
- `/user/order-history` - Riwayat pesanan
- `/user/wishlist` - Daftar keinginan
- `/user/settings` - Pengaturan akun

### Pharmacist Routes (`/pharmacist/*`)
- `/pharmacist/dashboard` - Dashboard apoteker
- `/pharmacist/medicines/*` - Manajemen obat (read-only)
- `/pharmacist/sales-transactions/*` - Transaksi penjualan
- `/pharmacist/profile` - Profil apoteker
- `/pharmacist/settings` - Pengaturan apoteker
- `/pharmacist/reports/*` - Laporan dasar

### Admin Routes (`/admin/*`)
- `/admin/dashboard` - Dashboard administrator
- `/admin/medicines/*` - Manajemen obat (full access)
- `/admin/sales-transactions/*` - Transaksi penjualan
- `/admin/buy-transactions/*` - Transaksi pembelian
- `/admin/users/*` - Manajemen pengguna
- `/admin/categories/*` - Manajemen kategori
- `/admin/suppliers/*` - Manajemen supplier
- `/admin/reports/*` - Laporan lengkap
- `/admin/settings/*` - Pengaturan sistem

## Middleware

### UserMiddleware
- Memastikan user yang login memiliki role `buyer`
- Redirect ke home jika tidak memiliki akses

### PharmacistMiddleware
- Memastikan user yang login memiliki role `pharmacist`
- Redirect ke home jika tidak memiliki akses

### AdminMiddleware
- Memastikan user yang login memiliki role `admin`
- Redirect ke login jika tidak memiliki akses

## Helper Functions

### RoleHelper
File: `app/Helpers/RoleHelper.php`

Fungsi-fungsi yang tersedia:
- `hasRole(User $user, string $role)` - Cek role spesifik
- `hasAnyRole(User $user, array $roles)` - Cek multiple roles
- `getRoleDisplayName(User $user)` - Nama role untuk display
- `getRoleColor(User $user)` - Warna role untuk UI
- `canAccessAdminPanel(User $user)` - Cek akses admin panel
- `canManageMedicines(User $user)` - Cek akses manajemen obat
- `canManageTransactions(User $user)` - Cek akses transaksi
- `canViewReports(User $user)` - Cek akses laporan
- `canPurchase(User $user)` - Cek akses pembelian
- `canSell(User $user)` - Cek akses penjualan
- `getDashboardRoute(User $user)` - Route dashboard berdasarkan role
- `getAvailableRoles()` - Daftar semua role yang tersedia

## Redirect Berdasarkan Role

Setelah login, user akan diarahkan ke dashboard yang sesuai dengan rolenya:
- Admin → `/admin/dashboard`
- Pharmacist → `/pharmacist/dashboard`
- Buyer → `/user/dashboard`

## Penggunaan dalam Blade Templates

```blade
@if(RoleHelper::hasRole(auth()->user(), 'admin'))
    <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
@endif

@if(RoleHelper::canManageMedicines(auth()->user()))
    <a href="{{ route('admin.medicines.index') }}">Kelola Obat</a>
@endif

<span class="badge badge-{{ RoleHelper::getRoleColor(auth()->user()) }}">
    {{ RoleHelper::getRoleDisplayName(auth()->user()) }}
</span>
```

## Penggunaan dalam Controllers

```php
use App\Helpers\RoleHelper;

public function index()
{
    $user = auth()->user();
    
    if (RoleHelper::hasRole($user, 'admin')) {
        return redirect()->route('admin.dashboard');
    }
    
    if (RoleHelper::hasRole($user, 'pharmacist')) {
        return redirect()->route('pharmacist.dashboard');
    }
    
    return redirect()->route('user.dashboard');
}
```

## Keamanan

1. **Middleware Protection**: Setiap route dilindungi dengan middleware yang sesuai
2. **Role-based Access**: Akses dibatasi berdasarkan role pengguna
3. **Redirect Handling**: User yang tidak memiliki akses akan diredirect ke halaman yang sesuai
4. **Session Messages**: Pesan error ditampilkan jika akses ditolak

## Maintenance

Untuk menambah role baru:
1. Buat middleware baru di `app/Http/Middleware/`
2. Daftarkan di `bootstrap/app.php`
3. Buat file routing di `routes/roles/`
4. Update `RoleHelper.php` dengan method baru
5. Update entity User dengan method pengecekan role baru 