<?php

namespace App\Application\Services;

use App\Application\DTOs\MedicineDTO;
use App\Domain\Medicine\Services\MedicineService;
use Illuminate\Database\Eloquent\Collection;

class MedicineApplicationService
{
    public function __construct(
        private MedicineService $medicineService
    ) {}

    public function createMedicine(array $data): MedicineDTO
    {
        $medicine = $this->medicineService->createMedicine($data);
        return $this->entityToDTO($medicine);
    }

    public function updateMedicine(int $id, array $data): MedicineDTO
    {
        $medicine = $this->medicineService->updateMedicine($id, $data);
        return $this->entityToDTO($medicine);
    }

    public function deleteMedicine(int $id): bool
    {
        return $this->medicineService->deleteMedicine($id);
    }

    public function getMedicine(int $id): ?MedicineDTO
    {
        $medicine = $this->medicineService->findById($id);
        return $medicine ? $this->entityToDTO($medicine) : null;
    }

    public function getAllMedicines(): array
    {
        $medicines = $this->medicineService->getActiveMedicines();
        return $medicines->map(fn($medicine) => $this->entityToDTO($medicine))->toArray();
    }

    public function searchMedicines(string $query): array
    {
        $medicines = $this->medicineService->searchMedicines($query);
        return $medicines->map(fn($medicine) => $this->entityToDTO($medicine))->toArray();
    }

    public function getMedicinesByCategory(int $categoryId): array
    {
        $medicines = $this->medicineService->getMedicinesByCategory($categoryId);
        return $medicines->map(fn($medicine) => $this->entityToDTO($medicine))->toArray();
    }

    public function getLowStockMedicines(int $threshold = 10): array
    {
        $medicines = $this->medicineService->getLowStockMedicines($threshold);
        return $medicines->map(fn($medicine) => $this->entityToDTO($medicine))->toArray();
    }

    public function getOutOfStockMedicines(): array
    {
        $medicines = $this->medicineService->getOutOfStockMedicines();
        return $medicines->map(fn($medicine) => $this->entityToDTO($medicine))->toArray();
    }

    public function getExpiredMedicines(): array
    {
        $medicines = $this->medicineService->getExpiredMedicines();
        return $medicines->map(fn($medicine) => $this->entityToDTO($medicine))->toArray();
    }

    public function getExpiringSoonMedicines(int $days = 30): array
    {
        $medicines = $this->medicineService->getExpiringSoonMedicines($days);
        return $medicines->map(fn($medicine) => $this->entityToDTO($medicine))->toArray();
    }

    public function adjustStock(int $medicineId, int $quantity, string $type = 'add'): MedicineDTO
    {
        $medicine = $this->medicineService->adjustStock($medicineId, $quantity, $type);
        return $this->entityToDTO($medicine);
    }

    public function updatePrice(int $medicineId, float $newPrice): MedicineDTO
    {
        $medicine = $this->medicineService->updatePrice($medicineId, $newPrice);
        return $this->entityToDTO($medicine);
    }

    public function getInventoryReport(): array
    {
        $report = $this->medicineService->getInventoryReport();
        
        // Convert entities to DTOs in the report
        $report['low_stock_medicines'] = collect($report['low_stock_medicines'])
            ->map(fn($medicine) => $this->entityToDTO($medicine))
            ->toArray();
            
        $report['out_of_stock_medicines'] = collect($report['out_of_stock_medicines'])
            ->map(fn($medicine) => $this->entityToDTO($medicine))
            ->toArray();

        $report['expired_medicines'] = collect($report['expired_medicines'])
            ->map(fn($medicine) => $this->entityToDTO($medicine))
            ->toArray();

        return $report;
    }

    public function getMedicineStatistics(): array
    {
        $activeMedicines = $this->medicineService->getActiveMedicines();
        $lowStockMedicines = $this->medicineService->getLowStockMedicines();
        $outOfStockMedicines = $this->medicineService->getOutOfStockMedicines();
        $expiredMedicines = $this->medicineService->getExpiredMedicines();
        $totalValue = $this->medicineService->calculateTotalInventoryValue();
        $totalStock = $this->medicineService->getTotalStock();
        $averagePrice = $this->medicineService->getAveragePrice();

        return [
            'total_medicines' => $activeMedicines->count(),
            'low_stock_count' => $lowStockMedicines->count(),
            'out_of_stock_count' => $outOfStockMedicines->count(),
            'expired_count' => $expiredMedicines->count(),
            'total_inventory_value' => $totalValue,
            'formatted_total_value' => 'Rp ' . number_format($totalValue, 0, ',', '.'),
            'total_stock' => $totalStock,
            'average_price' => $averagePrice,
            'formatted_average_price' => 'Rp ' . number_format($averagePrice, 0, ',', '.'),
        ];
    }

    public function getPublicMedicines(string $search = '', ?int $categoryId = null): array
    {
        $medicines = $this->medicineService->getPublicMedicines($search, $categoryId);
        return $medicines->map(fn($medicine) => $this->entityToDTO($medicine))->toArray();
    }

    public function getTopSellingMedicines(int $limit = 10): array
    {
        $medicines = $this->medicineService->getTopSellingMedicines($limit);
        return $medicines->map(fn($medicine) => $this->entityToDTO($medicine))->toArray();
    }

    public function getLowestStockMedicines(int $limit = 10): array
    {
        $medicines = $this->medicineService->getLowestStockMedicines($limit);
        return $medicines->map(fn($medicine) => $this->entityToDTO($medicine))->toArray();
    }

    public function getMedicinesByPriceRange(float $minPrice, float $maxPrice): array
    {
        $medicines = $this->medicineService->getMedicinesByPriceRange($minPrice, $maxPrice);
        return $medicines->map(fn($medicine) => $this->entityToDTO($medicine))->toArray();
    }

    public function getMedicinesByStockRange(int $minStock, int $maxStock): array
    {
        $medicines = $this->medicineService->getMedicinesByStockRange($minStock, $maxStock);
        return $medicines->map(fn($medicine) => $this->entityToDTO($medicine))->toArray();
    }

    public function getMedicineById(int $id): ?MedicineDTO
    {
        $medicine = $this->medicineService->findById($id);
        return $medicine ? $this->entityToDTO($medicine) : null;
    }

    public function getRelatedMedicines(int $medicineId): array
    {
        $medicines = $this->medicineService->getRelatedMedicines($medicineId);
        return $medicines->map(fn($medicine) => $this->entityToDTO($medicine))->toArray();
    }

    public function updateStock(int $medicineId, int $quantity): bool
    {
        return $this->medicineService->updateStock($medicineId, $quantity);
    }

    public function getMostExpensiveMedicine(): ?MedicineDTO
    {
        $medicine = $this->medicineService->getMostExpensiveMedicine();
        return $medicine ? $this->entityToDTO($medicine) : null;
    }

    public function getLeastExpensiveMedicine(): ?MedicineDTO
    {
        $medicine = $this->medicineService->getLeastExpensiveMedicine();
        return $medicine ? $this->entityToDTO($medicine) : null;
    }

    // New E-commerce Methods
    public function getFeaturedMedicines(int $limit = 8): array
    {
        // Get medicines with high stock and good ratings (simulated)
        $medicines = $this->medicineService->getActiveMedicines()->take($limit);
        return $medicines->map(fn($medicine) => $this->entityToDTO($medicine))->toArray();
    }

    public function getPopularMedicines(int $limit = 8): array
    {
        // Get medicines with high sales (simulated)
        $medicines = $this->medicineService->getActiveMedicines()->take($limit);
        return $medicines->map(fn($medicine) => $this->entityToDTO($medicine))->toArray();
    }

    public function getMedicinesWithFilters(array $filters): array
    {
        $medicines = $this->medicineService->getActiveMedicines();
        
        // Apply search filter
        if (!empty($filters['search'])) {
            $medicines = $medicines->filter(function($medicine) use ($filters) {
                return stripos($medicine->name, $filters['search']) !== false ||
                       stripos($medicine->description, $filters['search']) !== false;
            });
        }
        
        // Apply category filter
        if (!empty($filters['category'])) {
            $medicines = $medicines->where('category_id', $filters['category']);
        }
        
        // Apply price range filter
        if (!empty($filters['min_price'])) {
            $medicines = $medicines->where('price', '>=', $filters['min_price']);
        }
        
        if (!empty($filters['max_price'])) {
            $medicines = $medicines->where('price', '<=', $filters['max_price']);
        }
        
        // Apply sorting
        if (!empty($filters['sort'])) {
            $order = $filters['order'] ?? 'asc';
            $medicines = $medicines->sortBy($filters['sort']);
            if ($order === 'desc') {
                $medicines = $medicines->reverse();
            }
        }
        
        return $medicines->map(fn($medicine) => $this->entityToDTO($medicine))->toArray();
    }

    public function getNewArrivals(int $limit = 8): array
    {
        // Get recently added medicines
        $medicines = $this->medicineService->getActiveMedicines()
            ->sortByDesc('created_at')
            ->take($limit);
        return $medicines->map(fn($medicine) => $this->entityToDTO($medicine))->toArray();
    }

    public function getDiscountedMedicines(int $limit = 8): array
    {
        // Get medicines with discounts (simulated)
        $medicines = $this->medicineService->getActiveMedicines()->take($limit);
        return $medicines->map(fn($medicine) => $this->entityToDTO($medicine))->toArray();
    }

    public function getMedicinesByBrand(string $brand, int $limit = 12): array
    {
        $medicines = $this->medicineService->getActiveMedicines()
            ->filter(function($medicine) use ($brand) {
                return stripos($medicine->manufacturer, $brand) !== false;
            })
            ->take($limit);
        return $medicines->map(fn($medicine) => $this->entityToDTO($medicine))->toArray();
    }

    public function getMedicinesByUsage(string $usage, int $limit = 12): array
    {
        $medicines = $this->medicineService->getActiveMedicines()
            ->filter(function($medicine) use ($usage) {
                return stripos($medicine->description, $usage) !== false;
            })
            ->take($limit);
        return $medicines->map(fn($medicine) => $this->entityToDTO($medicine))->toArray();
    }

    public function getMedicinesInStock(int $limit = 12): array
    {
        $medicines = $this->medicineService->getActiveMedicines()
            ->where('stock', '>', 0)
            ->take($limit);
        return $medicines->map(fn($medicine) => $this->entityToDTO($medicine))->toArray();
    }

    public function getMedicinesByRating(float $minRating = 4.0, int $limit = 12): array
    {
        // Simulated rating filter
        $medicines = $this->medicineService->getActiveMedicines()->take($limit);
        return $medicines->map(fn($medicine) => $this->entityToDTO($medicine))->toArray();
    }

    public function getMedicinesByAvailability(string $availability = 'in_stock', int $limit = 12): array
    {
        switch ($availability) {
            case 'in_stock':
                $medicines = $this->medicineService->getActiveMedicines()->where('stock', '>', 0);
                break;
            case 'low_stock':
                $medicines = $this->medicineService->getLowStockMedicines();
                break;
            case 'out_of_stock':
                $medicines = $this->medicineService->getOutOfStockMedicines();
                break;
            default:
                $medicines = $this->medicineService->getActiveMedicines();
        }
        
        return $medicines->take($limit)->map(fn($medicine) => $this->entityToDTO($medicine))->toArray();
    }

    private function entityToDTO($medicine): MedicineDTO
    {
        return MedicineDTO::fromArray($medicine->toArray());
    }
} 