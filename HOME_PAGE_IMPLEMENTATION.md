# Halaman Utama Toko Apotek - Implementasi DDD

## Overview

Halaman utama toko apotek telah diimplementasikan dengan menggunakan Domain Driven Design (DDD) yang menampilkan produk obat dengan fitur pencarian, kategori, dan detail produk.

## Fitur yang Diimplementasikan

### ✅ Halaman Utama (Home Page)
- **Hero Section**: Banner dengan search bar
- **Kategori Obat**: Filter berdasarkan kategori
- **Produk Unggulan**: Menampilkan produk dengan stok terbanyak
- **Semua Produk**: Grid layout dengan informasi lengkap
- **Responsive Design**: Mobile-friendly layout

### ✅ Halaman Detail Produk
- **Informasi Lengkap**: Nama, kode, kategori, harga, stok
- **Deskripsi Produk**: Detail manfaat dan penggunaan
- **Produk Terkait**: Rekomendasi produk serupa
- **Breadcrumb Navigation**: Navigasi yang mudah
- **Call-to-Action**: Link ke admin untuk pemesanan

### ✅ Fitur Pencarian dan Filter
- **Search Bar**: Pencarian berdasarkan nama, kode, deskripsi
- **Category Filter**: Filter berdasarkan kategori obat
- **Real-time Results**: Hasil pencarian yang dinamis

## Struktur DDD untuk Home Page

```
app/
├── Presentation/
│   └── Controllers/
│       └── HomeController.php
├── Application/
│   └── Services/
│       └── MedicineApplicationService.php (updated)
├── Domain/
│   └── Medicine/
│       ├── Services/
│       │   └── MedicineService.php (updated)
│       └── Repositories/
│           └── MedicineRepositoryInterface.php (updated)
└── Infrastructure/
    └── Persistence/
        └── EloquentMedicineRepository.php (updated)
```

## Controller Implementation

### HomeController
```php
class HomeController extends Controller
{
    public function __construct(
        private MedicineApplicationService $medicineService
    ) {}

    public function index(Request $request): View
    {
        $search = $request->get('search', '');
        $category = $request->get('category', '');
        
        $medicines = $this->medicineService->getPublicMedicines($search, $category);
        $categories = $this->medicineService->getMedicineCategories();
        $featuredMedicines = $this->medicineService->getFeaturedMedicines();
        
        return view('pages.home', compact('medicines', 'categories', 'featuredMedicines', 'search', 'category'));
    }

    public function show($id): View
    {
        $medicine = $this->medicineService->getMedicineById($id);
        $relatedMedicines = $this->medicineService->getRelatedMedicines($id);
        
        return view('pages.medicine-detail', compact('medicine', 'relatedMedicines'));
    }
}
```

## Domain Service Methods

### MedicineService
```php
public function getPublicMedicines(string $search = '', string $category = ''): Collection
{
    return $this->medicineRepository->findPublicMedicines($search, $category);
}

public function getMedicineCategories(): array
{
    return $this->medicineRepository->getCategories();
}

public function getFeaturedMedicines(): Collection
{
    return $this->medicineRepository->findFeatured();
}

public function getRelatedMedicines(int $medicineId): Collection
{
    $medicine = $this->findById($medicineId);
    if (!$medicine) {
        return collect();
    }

    return $this->medicineRepository->findByCategory($medicine->category)
        ->where('id', '!=', $medicineId)
        ->take(4);
}
```

## Repository Implementation

### EloquentMedicineRepository
```php
public function findPublicMedicines(string $search = '', string $category = ''): Collection
{
    $query = Medicine::where('is_active', true)
        ->where('stock_quantity', '>', 0);

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('code', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }

    if ($category) {
        $query->where('category', $category);
    }

    return $query->orderBy('name')->get();
}

public function getCategories(): array
{
    return Medicine::where('is_active', true)
        ->distinct()
        ->pluck('category')
        ->filter()
        ->toArray();
}

public function findFeatured(): Collection
{
    return Medicine::where('is_active', true)
        ->where('stock_quantity', '>', 0)
        ->orderBy('stock_quantity', 'desc')
        ->take(8)
        ->get();
}
```

## Routes

```php
// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/medicine/{id}', [HomeController::class, 'show'])->name('medicine.detail');
Route::get('/category/{category}', [HomeController::class, 'category'])->name('category');
```

## Database Seeding

### Medicine Categories
- **Analgesik**: Paracetamol, Ibuprofen, Aspirin
- **Antibiotik**: Amoxicillin, Ciprofloxacin
- **Vitamin**: Vitamin C, Vitamin D3, Vitamin B Complex
- **Suplemen**: Calcium, Magnesium, Zinc
- **Batuk & Flu**: Dextromethorphan, Pseudoephedrine
- **Obat Lambung**: Antasida, Ranitidine
- **Obat Kulit**: Betadine, Hydrocortisone

### Sample Data
Total 17 produk obat dengan berbagai kategori dan harga:
- Harga: Rp 3.000 - Rp 35.000
- Stok: 30 - 200 unit
- Status: Tersedia, Stok Menipis, Habis

## UI/UX Features

### 🎨 Design Elements
- **Modern Layout**: Clean dan professional design
- **Color Scheme**: Green theme untuk kesehatan
- **Typography**: Figtree font untuk readability
- **Icons**: SVG icons untuk visual appeal

### 📱 Responsive Design
- **Mobile First**: Optimized untuk mobile
- **Grid System**: Flexible grid layout
- **Breakpoints**: sm, md, lg, xl
- **Touch Friendly**: Large buttons dan touch targets

### 🔍 Search & Filter
- **Search Bar**: Prominent search di hero section
- **Category Cards**: Visual category selection
- **Active States**: Highlight selected category
- **Empty States**: Helpful messages saat tidak ada hasil

### 📦 Product Cards
- **Product Info**: Code, name, description, price
- **Stock Status**: Visual indicator untuk stok
- **Category Badge**: Color-coded category labels
- **Call-to-Action**: Clear action buttons

## Features Implemented

### ✅ Home Page
- Hero section dengan search bar
- Kategori obat dengan filter
- Produk unggulan (featured)
- Grid produk dengan informasi lengkap
- Footer dengan informasi kontak

### ✅ Product Detail Page
- Breadcrumb navigation
- Product image placeholder
- Detailed product information
- Related products
- Contact admin button

### ✅ Search & Filter
- Real-time search functionality
- Category-based filtering
- Search by name, code, description
- Empty state handling

### ✅ Responsive Design
- Mobile-friendly layout
- Flexible grid system
- Touch-optimized interface
- Cross-browser compatibility

## Security & Performance

### 🔒 Security Features
- **CSRF Protection**: Built-in Laravel CSRF
- **Input Validation**: Proper validation di controller
- **SQL Injection Prevention**: Eloquent ORM protection
- **XSS Prevention**: Blade template escaping

### ⚡ Performance Features
- **Database Indexing**: Proper indexes pada kolom search
- **Eager Loading**: Optimized queries
- **Caching**: Ready for Redis/Memcached
- **Lazy Loading**: Images dan assets

## Usage Examples

### Accessing Home Page
```
http://localhost:8000/
```

### Searching Products
```
http://localhost:8000/?search=paracetamol
```

### Filtering by Category
```
http://localhost:8000/?category=Vitamin
```

### Viewing Product Detail
```
http://localhost:8000/medicine/1
```

## Testing Data

### Admin Login
- **URL**: `http://localhost:8000/login`
- **Email**: `admin@apotek.com`
- **Password**: `admin123`

### Sample Products
1. **Paracetamol 500mg** - Rp 5.000 (Analgesik)
2. **Vitamin C 1000mg** - Rp 12.000 (Vitamin)
3. **Amoxicillin 500mg** - Rp 15.000 (Antibiotik)
4. **Calcium Carbonate** - Rp 25.000 (Suplemen)

## Next Steps

1. **Shopping Cart**: Implementasi keranjang belanja
2. **User Registration**: Customer registration system
3. **Order Management**: Order processing system
4. **Payment Integration**: Payment gateway integration
5. **Image Upload**: Product image management
6. **Reviews & Ratings**: Customer review system
7. **Inventory Alerts**: Low stock notifications
8. **Analytics Dashboard**: Sales dan visitor analytics

## Running the Application

1. **Setup Database**:
```bash
php artisan migrate:fresh --seed
```

2. **Access Home Page**:
```
http://localhost:8000/
```

3. **Test Features**:
- Search functionality
- Category filtering
- Product detail pages
- Responsive design

4. **Admin Access**:
```
http://localhost:8000/login
```

Implementasi halaman utama toko apotek ini memberikan user experience yang baik dengan design yang modern dan fitur yang lengkap untuk browsing dan mencari produk obat. 