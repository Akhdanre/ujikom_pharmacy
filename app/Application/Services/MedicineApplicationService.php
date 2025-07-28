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

    public function getMedicinesByCategory(string $category): array
    {
        $medicines = $this->medicineService->getMedicinesByCategory($category);
        return $medicines->map(fn($medicine) => $this->entityToDTO($medicine))->toArray();
    }

    public function getLowStockMedicines(): array
    {
        $medicines = $this->medicineService->getLowStockMedicines();
        return $medicines->map(fn($medicine) => $this->entityToDTO($medicine))->toArray();
    }

    public function getOutOfStockMedicines(): array
    {
        $medicines = $this->medicineService->getOutOfStockMedicines();
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

        return $report;
    }

    public function getMedicineStatistics(): array
    {
        $activeMedicines = $this->medicineService->getActiveMedicines();
        $lowStockMedicines = $this->medicineService->getLowStockMedicines();
        $outOfStockMedicines = $this->medicineService->getOutOfStockMedicines();
        $totalValue = $this->medicineService->calculateTotalInventoryValue();

        return [
            'total_medicines' => $activeMedicines->count(),
            'low_stock_count' => $lowStockMedicines->count(),
            'out_of_stock_count' => $outOfStockMedicines->count(),
            'total_inventory_value' => $totalValue,
            'formatted_total_value' => 'Rp ' . number_format($totalValue, 0, ',', '.'),
            'average_price' => $activeMedicines->count() > 0 ? $activeMedicines->avg('price') : 0,
        ];
    }

    public function getPublicMedicines(string $search = '', string $category = ''): array
    {
        $medicines = $this->medicineService->getPublicMedicines($search, $category);
        return $medicines->map(fn($medicine) => $this->entityToDTO($medicine))->toArray();
    }

    public function getMedicineCategories(): array
    {
        return $this->medicineService->getMedicineCategories();
    }

    public function getFeaturedMedicines(): array
    {
        $medicines = $this->medicineService->getFeaturedMedicines();
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

    private function entityToDTO($medicine): MedicineDTO
    {
        return MedicineDTO::fromArray($medicine->toArray());
    }
} 