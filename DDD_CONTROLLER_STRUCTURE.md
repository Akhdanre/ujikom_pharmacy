# DDD Controller Structure - Pharmacy Management System

## Overview

Struktur controller telah disesuaikan dengan Domain Driven Design (DDD) pattern yang benar untuk aplikasi monolitik dengan Blade dan Livewire. Controller dipisahkan berdasarkan layer dan responsibility yang jelas.

## Struktur Controller DDD

```
app/
├── Presentation/                    # Presentation Layer
│   ├── Controllers/
│   │   └── Web/                    # Web Controllers (HTML Views)
│   │       └── MedicineController.php
│   └── Livewire/                   # Livewire Components
├── Application/                    # Application Layer
│   ├── Services/                   # Application Services
│   │   └── MedicineApplicationService.php
│   └── DTOs/                      # Data Transfer Objects
├── Domain/                        # Domain Layer
│   └── Medicine/                  # Medicine Bounded Context
│       ├── Entities/
│       ├── Services/
│       ├── Repositories/
│       └── ValueObjects/
└── Infrastructure/                # Infrastructure Layer
    └── Persistence/
```

## Controller Structure

### Web Controllers (`app/Presentation/Controllers/Web/`)
- **Purpose**: Handle web requests and return HTML views
- **Response Type**: Views, Redirects
- **Use Case**: Admin dashboard, CRUD forms, reports, inventory management

**Example:**
```php
namespace App\Presentation\Controllers\Web;

class MedicineController extends Controller
{
    public function __construct(
        private MedicineApplicationService $medicineService
    ) {}

    public function index(): View
    {
        $medicines = $this->medicineService->getAllMedicines();
        $statistics = $this->medicineService->getMedicineStatistics();
        return view('medicines.index', compact('medicines', 'statistics'));
    }
}
```

## DDD Layer Responsibilities

### Presentation Layer
- **Controllers**: Handle HTTP requests/responses
- **Validation**: Input validation and sanitization
- **Error Handling**: User-friendly error messages
- **No Business Logic**: Only presentation logic

### Application Layer
- **Services**: Orchestrate domain objects
- **DTOs**: Data transfer between layers
- **Use Cases**: Application-specific business rules
- **Transaction Management**: Coordinate multiple domain operations

### Domain Layer
- **Entities**: Business objects with identity
- **Value Objects**: Immutable objects
- **Services**: Domain-specific business logic
- **Repositories**: Data access interfaces

### Infrastructure Layer
- **Persistence**: Database implementations
- **External Services**: Third-party integrations
- **Configuration**: Environment-specific settings

## Routes Structure

### Web Routes (`routes/web.php`)
```php
use App\Presentation\Controllers\Web\MedicineController;

Route::middleware(['auth', 'admin'])->group(function () {
    // Resource routes
    Route::resource('medicines', MedicineController::class);
    
    // Additional routes
    Route::get('medicines/search', [MedicineController::class, 'search'])->name('medicines.search');
    Route::get('medicines/low-stock', [MedicineController::class, 'lowStock'])->name('medicines.low-stock');
    Route::get('medicines/out-of-stock', [MedicineController::class, 'outOfStock'])->name('medicines.out-of-stock');
    Route::get('medicines/expired', [MedicineController::class, 'expired'])->name('medicines.expired');
    Route::get('medicines/expiring-soon', [MedicineController::class, 'expiringSoon'])->name('medicines.expiring-soon');
    Route::get('medicines/inventory/report', [MedicineController::class, 'inventoryReport'])->name('medicines.inventory-report');
});
```

## Benefits of This Structure

### 1. **Separation of Concerns**
- Controllers only handle HTTP requests/responses
- Clear boundaries between presentation and business logic
- Business logic delegated to Application Services
- Easy to maintain and test

### 2. **Scalability**
- Easy to add new features and routes
- Clear dependency direction (Presentation → Application → Domain)
- Modular structure for future enhancements

### 3. **Testability**
- Controllers can be tested in isolation
- Business logic is separated from presentation
- Mock dependencies easily

### 4. **Maintainability**
- Clear file organization
- Consistent patterns across controllers
- Easy to understand and modify

## Best Practices

### 1. **Controller Responsibilities**
- Keep controllers thin
- Delegate business logic to Application Services
- Handle only HTTP concerns (request/response)

### 2. **Error Handling**
- Use try-catch blocks appropriately
- Return consistent error responses
- Log errors for debugging

### 3. **Validation**
- Validate input at controller level
- Use Form Request classes for complex validation
- Return validation errors consistently

### 4. **Response Format**
- Views with flash messages for success/error
- Consistent error handling and validation
- Proper HTTP status codes

## Migration Guide

### From Old Structure
1. **Removed**: `app/Http/Controllers/MedicineController.php`
2. **Removed**: `app/Presentation/Controllers/MedicineController.php`
3. **Added**: `app/Presentation/Controllers/Web/MedicineController.php`
4. **Updated**: Routes to use new controller structure
5. **Added**: Additional routes for inventory management

### Next Steps
1. Update views to work with new controller responses
2. Test all medicine management endpoints
3. Add authentication middleware as needed
4. Implement additional features using DDD pattern
5. Create Livewire components for interactive features 