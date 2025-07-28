<?php

namespace App\Domain\Medicine\Services;

use App\Domain\Medicine\Entities\Medicine;
use App\Domain\Medicine\Repositories\MedicineRepositoryInterface;
use App\Domain\Medicine\ValueObjects\Price;
use Illuminate\Database\Eloquent\Collection;

class MedicineService
{
    public function __construct(
        private MedicineRepositoryInterface $medicineRepository
    ) {}

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

    public function updateMedicine(int $id, array $data): Medicine
    {
        $medicine = $this->medicineRepository->findById($id);
        
        if (!$medicine) {
            throw new \InvalidArgumentException('Medicine not found');
        }

        // Validate business rules
        $this->validateMedicineData($data);

        // Check if code is being changed and if it already exists
        if (isset($data['code']) && $data['code'] !== $medicine->code) {
            if ($this->medicineRepository->findByCode($data['code'])) {
                throw new \InvalidArgumentException('Medicine code already exists');
            }
        }

        $medicine->fill($data);
        return $this->medicineRepository->save($medicine);
    }

    public function deleteMedicine(int $id): bool
    {
        $medicine = $this->medicineRepository->findById($id);
        
        if (!$medicine) {
            throw new \InvalidArgumentException('Medicine not found');
        }

        // Check if medicine is used in any transactions
        if ($medicine->transactionDetails()->count() > 0) {
            throw new \InvalidArgumentException('Cannot delete medicine that has been used in transactions');
        }

        return $this->medicineRepository->delete($medicine);
    }

    public function adjustStock(int $medicineId, int $quantity, string $type = 'add'): Medicine
    {
        $medicine = $this->medicineRepository->findById($medicineId);
        
        if (!$medicine) {
            throw new \InvalidArgumentException('Medicine not found');
        }

        if ($type === 'add') {
            $medicine->addStock($quantity);
        } elseif ($type === 'reduce') {
            $medicine->reduceStock($quantity);
        } else {
            throw new \InvalidArgumentException('Invalid stock adjustment type');
        }

        return $this->medicineRepository->save($medicine);
    }

    public function updatePrice(int $medicineId, float $newPrice): Medicine
    {
        $medicine = $this->medicineRepository->findById($medicineId);
        
        if (!$medicine) {
            throw new \InvalidArgumentException('Medicine not found');
        }

        $medicine->updatePrice($newPrice);
        return $this->medicineRepository->save($medicine);
    }

    public function getLowStockMedicines(): Collection
    {
        return $this->medicineRepository->findLowStock();
    }

    public function getOutOfStockMedicines(): Collection
    {
        return $this->medicineRepository->findOutOfStock();
    }

    public function searchMedicines(string $query): Collection
    {
        return $this->medicineRepository->search($query);
    }

    public function getMedicinesByCategory(string $category): Collection
    {
        return $this->medicineRepository->findByCategory($category);
    }

    public function getActiveMedicines(): Collection
    {
        return $this->medicineRepository->findActive();
    }

    public function calculateTotalInventoryValue(): float
    {
        $medicines = $this->medicineRepository->findActive();
        
        return $medicines->sum(function ($medicine) {
            return $medicine->price * $medicine->stock_quantity;
        });
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
            'low_stock_medicines' => $lowStockMedicines,
            'out_of_stock_medicines' => $outOfStockMedicines,
        ];
    }

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

    private function validateMedicineData(array $data): void
    {
        $requiredFields = ['code', 'name', 'price', 'stock_quantity', 'min_stock_level'];
        
        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                throw new \InvalidArgumentException("Field {$field} is required");
            }
        }

        if ($data['price'] < 0) {
            throw new \InvalidArgumentException('Price cannot be negative');
        }

        if ($data['stock_quantity'] < 0) {
            throw new \InvalidArgumentException('Stock quantity cannot be negative');
        }

        if ($data['min_stock_level'] < 0) {
            throw new \InvalidArgumentException('Minimum stock level cannot be negative');
        }

        if (strlen($data['code']) < 3) {
            throw new \InvalidArgumentException('Medicine code must be at least 3 characters');
        }

        if (strlen($data['name']) < 2) {
            throw new \InvalidArgumentException('Medicine name must be at least 2 characters');
        }
    }
} 