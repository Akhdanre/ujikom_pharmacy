<?php

namespace App\Domain\Medicine\Services;

use App\Domain\Medicine\Entities\Medicine;
use App\Domain\Medicine\Repositories\MedicineRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use PhpParser\Node\Expr\List_;

class MedicineService {
    public function __construct(
        private MedicineRepositoryInterface $medicineRepository
    ) {
    }


    public function getAllMedicinesPaginated(int $perPage = 15, int $page = 1): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->medicineRepository->getAllPaginated($perPage, $page);
    }

    public function createMedicine(array $data): Medicine {
        // Validate business rules
        $this->validateMedicineData($data);

        // Check if medicine name already exists
        if ($this->medicineRepository->findByName($data['medicine_name'])->isNotEmpty()) {
            throw new \InvalidArgumentException('Medicine name already exists');
        }

        $medicine = new Medicine($data);
        return $this->medicineRepository->save($medicine);
    }

    public function updateMedicine(int $id, array $data): Medicine {
        $medicine = $this->medicineRepository->findById($id);

        if (!$medicine) {
            throw new \InvalidArgumentException('Medicine not found');
        }

        // Validate business rules
        $this->validateMedicineData($data);

        // Check if name is being changed and if it already exists
        if (isset($data['medicine_name']) && $data['medicine_name'] !== $medicine->medicine_name) {
            $existingMedicines = $this->medicineRepository->findByName($data['medicine_name']);
            if ($existingMedicines->where('id', '!=', $id)->isNotEmpty()) {
                throw new \InvalidArgumentException('Medicine name already exists');
            }
        }

        $medicine->fill($data);
        return $this->medicineRepository->save($medicine);
    }

    public function deleteMedicine(int $id): bool {
        $medicine = $this->medicineRepository->findById($id);

        if (!$medicine) {
            throw new \InvalidArgumentException('Medicine not found');
        }

        // Check if medicine is used in any transactions
        if ($medicine->purchaseTransactionDetails()->count() > 0 || $medicine->salesTransactionDetails()->count() > 0) {
            throw new \InvalidArgumentException('Cannot delete medicine that has been used in transactions');
        }

        return $this->medicineRepository->delete($medicine);
    }

    public function adjustStock(int $medicineId, int $quantity, string $type = 'add'): Medicine {
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

    public function updatePrice(int $medicineId, float $newPrice): Medicine {
        $medicine = $this->medicineRepository->findById($medicineId);

        if (!$medicine) {
            throw new \InvalidArgumentException('Medicine not found');
        }

        $medicine->updatePrice($newPrice);
        return $this->medicineRepository->save($medicine);
    }

    public function getLowStockMedicines(int $threshold = 10): Collection {
        return $this->medicineRepository->findLowStock($threshold);
    }

    public function getOutOfStockMedicines(): Collection {
        return $this->medicineRepository->findOutOfStock();
    }

    public function getExpiredMedicines(): Collection {
        return $this->medicineRepository->findExpired();
    }

    public function getExpiringSoonMedicines(int $days = 30): Collection {
        return $this->medicineRepository->findExpiringSoon($days);
    }

    public function searchMedicines(string $query): Collection {
        return $this->medicineRepository->search($query);
    }

    public function getMedicinesByCategory(int $categoryId): Collection {
        return $this->medicineRepository->findByCategory($categoryId);
    }

    public function getActiveMedicines(): Collection {
        return $this->medicineRepository->findActive();
    }

    public function getInactiveMedicines(): Collection {
        return $this->medicineRepository->findInactive();
    }

    public function calculateTotalInventoryValue(): float {
        $medicines = $this->medicineRepository->findActive();

        return $medicines->sum(function ($medicine) {
            return $medicine->price * $medicine->stock;
        });
    }

    public function getInventoryReport(): array {
        $activeMedicines = $this->medicineRepository->findActive();
        $lowStockMedicines = $this->medicineRepository->findLowStock();
        $outOfStockMedicines = $this->medicineRepository->findOutOfStock();
        $expiredMedicines = $this->medicineRepository->findExpired();

        return [
            'total_medicines' => $activeMedicines->count(),
            'low_stock_count' => $lowStockMedicines->count(),
            'out_of_stock_count' => $outOfStockMedicines->count(),
            'expired_count' => $expiredMedicines->count(),
            'total_value' => $this->calculateTotalInventoryValue(),
            'low_stock_medicines' => $lowStockMedicines,
            'out_of_stock_medicines' => $outOfStockMedicines,
            'expired_medicines' => $expiredMedicines,
        ];
    }

    public function getPublicMedicines(string $search = '', ?int $categoryId = null): Collection {
        $query = $this->medicineRepository->findActive();

        if ($search) {
            $query = $this->medicineRepository->search($search);
        }

        if ($categoryId) {
            $query = $this->medicineRepository->findByCategory($categoryId);
        }

        return $query;
    }

    public function getTopSellingMedicines(int $limit = 10): Collection {
        return $this->medicineRepository->getTopSelling($limit);
    }

    public function getLowestStockMedicines(int $limit = 10): Collection {
        return $this->medicineRepository->getLowestStock($limit);
    }

    public function getMedicinesByPriceRange(float $minPrice, float $maxPrice): Collection {
        return $this->medicineRepository->getByPriceRange($minPrice, $maxPrice);
    }

    public function getMedicinesByStockRange(int $minStock, int $maxStock): Collection {
        return $this->medicineRepository->getByStockRange($minStock, $maxStock);
    }

    public function getRelatedMedicines(int $medicineId): Collection {
        $medicine = $this->medicineRepository->findById($medicineId);
        if (!$medicine) {
            return collect();
        }

        return $this->medicineRepository->findByCategory($medicine->category_id)
            ->where('id', '!=', $medicineId)
            ->take(4);
    }

    public function updateStock(int $medicineId, int $quantity): bool {
        return $this->medicineRepository->updateStock($medicineId, $quantity);
    }

    public function getTotalStock(): int {
        return $this->medicineRepository->getTotalStock();
    }

    public function getAveragePrice(): float {
        return $this->medicineRepository->getAveragePrice();
    }

    public function getMostExpensiveMedicine(): ?Medicine {
        return $this->medicineRepository->getMostExpensive();
    }

    public function getLeastExpensiveMedicine(): ?Medicine {
        return $this->medicineRepository->getLeastExpensive();
    }

    public function findById(int $id): ?Medicine {
        return $this->medicineRepository->findById($id);
    }

    private function validateMedicineData(array $data): void {
        $requiredFields = ['medicine_name', 'price', 'stock', 'category_id'];

        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                throw new \InvalidArgumentException("Field {$field} is required");
            }
        }

        if ($data['price'] < 0) {
            throw new \InvalidArgumentException('Price cannot be negative');
        }

        if ($data['stock'] < 0) {
            throw new \InvalidArgumentException('Stock cannot be negative');
        }

        if (strlen($data['medicine_name']) < 2) {
            throw new \InvalidArgumentException('Medicine name must be at least 2 characters');
        }

        if (isset($data['expired_at']) && $data['expired_at']) {
            if (strtotime($data['expired_at']) < time()) {
                throw new \InvalidArgumentException('Expired date cannot be in the past');
            }
        }
    }
}
