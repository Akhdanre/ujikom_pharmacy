<?php

namespace App\Domain\Medicine\Repositories;

use App\Domain\Medicine\Entities\Medicine;
use Illuminate\Database\Eloquent\Collection;

interface MedicineRepositoryInterface
{
    public function findById(int $id): ?Medicine;
    
    public function findByCategory(int $categoryId): Collection;
    
    public function findByName(string $name): Collection;
    
    public function findActive(): Collection;
    
    public function findInactive(): Collection;
    
    public function findLowStock(int $threshold = 10): Collection;
    
    public function findOutOfStock(): Collection;
    
    public function findExpired(): Collection;
    
    public function findExpiringSoon(int $days = 30): Collection;
    
    public function save(Medicine $medicine): Medicine;
    
    public function delete(Medicine $medicine): bool;
    
    public function getAll(): Collection;
    
    public function getAllPaginated(int $perPage = 15, int $page = 1): \Illuminate\Pagination\LengthAwarePaginator;
    
    public function search(string $query): Collection;
    
    public function getByPriceRange(float $minPrice, float $maxPrice): Collection;
    
    public function getByStockRange(int $minStock, int $maxStock): Collection;
    
    public function updateStock(int $medicineId, int $quantity): bool;
    
    public function getTotalStock(): int;
    
    public function getAveragePrice(): float;
    
    public function getMostExpensive(): ?Medicine;
    
    public function getLeastExpensive(): ?Medicine;
    
    public function getTopSelling(int $limit = 10): Collection;
    
    public function getLowestStock(int $limit = 10): Collection;
} 