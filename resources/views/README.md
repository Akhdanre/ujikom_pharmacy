# Struktur Views - Pharmacy Management System

## Overview
Struktur views telah direorganisir untuk meningkatkan maintainability dan reusability berdasarkan prinsip Domain Driven Design (DDD).

## Struktur Folder

### 1. `features/` - Views berdasarkan Fitur
Berisi views yang dikelompokkan berdasarkan fitur bisnis:

#### `features/dashboard/`
- `dashboard.blade.php` - Halaman dashboard utama

#### `features/medicines/`
- `index.blade.php` - Daftar obat
- `create.blade.php` - Form tambah obat
- `edit.blade.php` - Form edit obat
- `show.blade.php` - Detail obat

#### `features/transactions/`
- `index.blade.php` - Daftar transaksi penjualan
- `create.blade.php` - Form transaksi penjualan baru
- `edit.blade.php` - Form edit transaksi penjualan
- `show.blade.php` - Detail transaksi penjualan

#### `features/buy-transactions/`
- `index.blade.php` - Daftar transaksi pembelian
- `create.blade.php` - Form transaksi pembelian baru
- `edit.blade.php` - Form edit transaksi pembelian
- `show.blade.php` - Detail transaksi pembelian

#### `features/reports/`
- Views untuk laporan dan analisis

### 2. `shared/` - Komponen yang Dapat Digunakan Bersama

#### `shared/components/` - Komponen Blade
- `ui/` - Komponen UI dasar
  - `status-badge.blade.php` - Badge untuk status
  - `price-display.blade.php` - Tampilan harga
  - `date-display.blade.php` - Tampilan tanggal
  - `empty-state.blade.php` - State kosong
  - `loading-spinner.blade.php` - Loading spinner

- `features/` - Komponen khusus fitur
  - `medicine-card.blade.php` - Kartu obat
  - `transaction-row.blade.php` - Baris transaksi

- `layout/` - Komponen layout
  - `page-header.blade.php` - Header halaman
  - `sidebar.blade.php` - Sidebar navigasi

- `cards/` - Komponen kartu
  - `stat-card.blade.php` - Kartu statistik
  - `content-card.blade.php` - Kartu konten

- `tables/` - Komponen tabel
  - `data-table.blade.php` - Tabel data
  - `action-buttons.blade.php` - Tombol aksi

- `forms/` - Komponen form
  - `input-field.blade.php` - Field input
  - `select-field.blade.php` - Field select

- `filters/` - Komponen filter
  - `filter-panel.blade.php` - Panel filter
  - `search-filter.blade.php` - Filter pencarian

- `modals/` - Komponen modal
  - `delete-modal.blade.php` - Modal konfirmasi hapus

- `charts/` - Komponen chart
  - `chart-container.blade.php` - Container chart

### 3. `layouts/` - Layout Utama
- `app.blade.php` - Layout utama aplikasi
- `auth.blade.php` - Layout untuk halaman auth

### 4. `auth/` - Halaman Autentikasi
- `login.blade.php` - Halaman login
- `register.blade.php` - Halaman register
- `verify-email.blade.php` - Halaman verifikasi email

## Komponen Global

### Status Badge
```blade
<x-ui.status-badge status="completed" />
```

### Price Display
```blade
<x-ui.price-display :amount="15000" size="large" />
```

### Date Display
```blade
<x-ui.date-display :date="2024-01-15" format="short" />
```

### Empty State
```blade
<x-ui.empty-state 
    title="No Data Found"
    description="There are no items to display"
    :action="route('items.create')"
    actionText="Add New Item" />
```

### Medicine Card
```blade
<x-features.medicine-card :medicine="$medicine" />
```

### Transaction Row
```blade
<x-features.transaction-row :transaction="$transaction" type="sale" />
```

## Best Practices

1. **Gunakan komponen yang sudah ada** sebelum membuat yang baru
2. **Konsisten dalam penamaan** file dan komponen
3. **Pisahkan logika bisnis** dari tampilan
4. **Gunakan props** untuk data yang dinamis
5. **Dokumentasikan** komponen yang kompleks

## Konvensi Penamaan

- **File**: kebab-case (contoh: `medicine-card.blade.php`)
- **Komponen**: kebab-case (contoh: `<x-ui.status-badge>`)
- **Folder**: kebab-case (contoh: `buy-transactions/`)
- **Props**: camelCase (contoh: `:medicineName="$name"`)

## Migrasi dari Struktur Lama

Jika ada file yang masih menggunakan struktur lama, pindahkan ke struktur baru:

1. Views fitur → `features/[nama-fitur]/`
2. Komponen global → `shared/components/`
3. Update semua referensi di controller dan route 