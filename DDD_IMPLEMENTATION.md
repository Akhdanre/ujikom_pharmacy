# Domain Driven Design (DDD) Implementation

## Overview

Proyek apotek ini telah diimplementasikan menggunakan Domain Driven Design (DDD) dengan Laravel dan Livewire. Implementasi ini memisahkan business logic dari infrastruktur dan presentation layer.

## Struktur DDD

```
app/
├── Domain/                    # Domain Layer (Business Logic)
│   ├── Medicine/             # Medicine Bounded Context
│   │   ├── Entities/         # Domain Entities
│   │   ├── ValueObjects/     # Value Objects
│   │   ├── Repositories/     # Repository Interfaces
│   │   └── Services/         # Domain Services
│   ├── Transaction/          # Transaction Bounded Context
│   ├── Customer/             # Customer Bounded Context
│   └── Inventory/            # Inventory Bounded Context
├── Application/              # Application Layer
│   ├── Services/             # Application Services
│   └── DTOs/                # Data Transfer Objects
├── Infrastructure/           # Infrastructure Layer
│   └── Persistence/         # Repository Implementations
└── Presentation/            # Presentation Layer
    └── Controllers/         # Controllers
```

## Domain Bounded Contexts

### 1. Medicine Domain
- **Entities**: `Medicine` - Obat dengan business logic
- **Value Objects**: `MedicineCode`, `Price` - Immutable objects
- **Services**: `MedicineService` - Business logic kompleks
- **Repositories**: `MedicineRepositoryInterface` - Data access abstraction

### 2. Transaction Domain
- **Entities**: `Transaction`, `TransactionDetail` - Transaksi penjualan
- **Business Logic**: Perhitungan total, diskon, pajak, status transaksi

### 3. Customer Domain
- **Entities**: `Customer` - Data pelanggan
- **Business Logic**: Membership levels, points system

### 4. Inventory Domain
- **Entities**: `Supplier` - Data supplier
- **Business Logic**: Supplier management

## Key Features Implemented

### 1. Domain Entities dengan Business Logic
```php
// Medicine Entity
class Medicine extends Model
{
    public function isLowStock(): bool
    {
        return $this->stock_quantity <= $this->min_stock_level;
    }

    public function canSell(int $quantity): bool
    {
        return $this->is_active && $this->stock_quantity >= $quantity;
    }

    public function reduceStock(int $quantity): void
    {
        if ($this->stock_quantity < $quantity) {
            throw new \InvalidArgumentException('Insufficient stock');
        }
        $this->stock_quantity -= $quantity;
        $this->save();
    }
}
```

### 2. Value Objects
```php
// Price Value Object
class Price
{
    public function multiply(int $quantity): Price
    {
        return new Price($this->value * $quantity);
    }

    public function format(): string
    {
        return 'Rp ' . number_format($this->value, 0, ',', '.');
    }
}
```

### 3. Repository Pattern
```php
// Repository Interface
interface MedicineRepositoryInterface
{
    public function findById(int $id): ?Medicine;
    public function findByCode(string $code): ?Medicine;
    public function findLowStock(): Collection;
    public function save(Medicine $medicine): Medicine;
}

// Eloquent Implementation
class EloquentMedicineRepository implements MedicineRepositoryInterface
{
    public function findLowStock(): Collection
    {
        return Medicine::whereRaw('stock_quantity <= min_stock_level')
            ->where('is_active', true)
            ->get();
    }
}
```

### 4. Domain Services
```php
class MedicineService
{
    public function createMedicine(array $data): Medicine
    {
        // Validate business rules
        $this->validateMedicineData($data);
        
        // Check if medicine code already exists
        if ($this->medicineRepository->findByCode($data['code'])) {
            throw new \InvalidArgumentException('Medicine code already exists');
        }

        $medicine = new Medicine($data);
        return $this->medicineRepository->save($medicine);
    }

    public function getInventoryReport(): array
    {
        $activeMedicines = $this->medicineRepository->findActive();
        $lowStockMedicines = $this->medicineRepository->findLowStock();
        $outOfStockMedicines = $this->medicineRepository->findOutOfStock();

        return [
            'total_medicines' => $activeMedicines->count(),
            'low_stock_count' => $lowStockMedicines->count(),
            'out_of_stock_count' => $outOfStockMedicines->count(),
            'total_value' => $this->calculateTotalInventoryValue(),
        ];
    }
}
```

### 5. Application Services
```php
class MedicineApplicationService
{
    public function createMedicine(array $data): MedicineDTO
    {
        $medicine = $this->medicineService->createMedicine($data);
        return $this->entityToDTO($medicine);
    }

    public function getMedicineStatistics(): array
    {
        $activeMedicines = $this->medicineService->getActiveMedicines();
        $lowStockMedicines = $this->medicineService->getLowStockMedicines();
        $totalValue = $this->medicineService->calculateTotalInventoryValue();

        return [
            'total_medicines' => $activeMedicines->count(),
            'low_stock_count' => $lowStockMedicines->count(),
            'total_inventory_value' => $totalValue,
            'formatted_total_value' => 'Rp ' . number_format($totalValue, 0, ',', '.'),
        ];
    }
}
```

### 6. Livewire Integration
```php
class MedicineIndex extends Component
{
    public function render()
    {
        $medicineService = app(MedicineApplicationService::class);
        
        $medicines = $this->showLowStock 
            ? $medicineService->getLowStockMedicines()
            : $medicineService->getAllMedicines();
            
        $statistics = $medicineService->getMedicineStatistics();

        return view('livewire.medicine.medicine-index', [
            'medicines' => $medicines,
            'statistics' => $statistics
        ]);
    }
}
```

## Dependency Injection

Service Provider untuk mengatur dependency injection:

```php
class DomainServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Repository Bindings
        $this->app->bind(MedicineRepositoryInterface::class, EloquentMedicineRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, EloquentTransactionRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, EloquentCustomerRepository::class);
    }
}
```

## Database Schema

### Medicines Table
```sql
CREATE TABLE medicines (
    id BIGINT PRIMARY KEY,
    code VARCHAR(20) UNIQUE,
    name VARCHAR(255),
    description TEXT,
    category VARCHAR(255),
    price DECIMAL(10,2),
    stock_quantity INT DEFAULT 0,
    min_stock_level INT DEFAULT 10,
    supplier_id BIGINT,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Transactions Table
```sql
CREATE TABLE transaksis (
    id BIGINT PRIMARY KEY,
    transaction_number VARCHAR(255) UNIQUE,
    customer_id BIGINT,
    user_id BIGINT,
    transaction_date DATETIME,
    total_amount DECIMAL(12,2) DEFAULT 0,
    discount_amount DECIMAL(12,2) DEFAULT 0,
    tax_amount DECIMAL(12,2) DEFAULT 0,
    grand_total DECIMAL(12,2) DEFAULT 0,
    payment_method VARCHAR(255) DEFAULT 'cash',
    status ENUM('pending', 'processing', 'completed', 'cancelled') DEFAULT 'pending',
    notes TEXT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

## Testing Data

Seeder telah dibuat dengan data testing:

- Paracetamol 500mg (Analgesik)
- Ibuprofen 400mg (Analgesik)
- Amoxicillin 500mg (Antibiotik)
- Vitamin C 1000mg (Vitamin)
- Aspirin 100mg (Analgesik) - Low Stock
- Metformin 500mg (Lainnya) - Out of Stock
- Omeprazole 20mg (Lainnya) - Low Stock
- Calcium Carbonate 500mg (Suplemen)

## Routes

```php
// DDD Medicine Routes
Route::get('/medicines', MedicineIndex::class)->name('medicines.index');
```

## Benefits of DDD Implementation

1. **Separation of Concerns**: Business logic terpisah dari infrastruktur
2. **Testability**: Mudah untuk unit testing
3. **Maintainability**: Kode lebih terorganisir
4. **Scalability**: Mudah untuk menambah fitur baru
5. **Domain Expertise**: Kode mencerminkan domain knowledge
6. **Flexibility**: Mudah untuk mengganti implementasi

## Next Steps

1. Implementasi Transaction Domain Services
2. Implementasi Customer Domain Services
3. Implementasi Inventory Domain Services
4. Unit Testing untuk semua Domain Services
5. Integration Testing
6. API Endpoints untuk mobile app
7. Advanced reporting features

## Running the Application

1. Setup database dan jalankan migrasi:
```bash
php artisan migrate:fresh --seed
```

2. Akses medicine management:
```
http://localhost:8000/medicines
```

3. Test fitur-fitur DDD:
- Create new medicine
- Update medicine
- Search medicines
- View low stock medicines
- View inventory statistics 