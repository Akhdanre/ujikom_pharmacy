<?php

namespace App\Domain\Medicine\Repositories;

use App\Domain\Medicine\Entities\Medicine;
use Illuminate\Database\Eloquent\Collection;

interface MedicineRepositoryInterface
{
    public function findById(int $id): ?Medicine;
    
    public function findByCode(string $code): ?Medicine;
    
    public function findByName(string $name): Collection;
    
    public function findByCategory(string $category): Collection;
    
    public function findActive(): Collection;
    
    public function findLowStock(): Collection;
    
    public function findOutOfStock(): Collection;
    
    public function save(Medicine $medicine): Medicine;
    
    public function delete(Medicine $medicine): bool;
    
    public function getAll(): Collection;
    
    public function search(string $query): Collection;
    
    public function getBySupplier(int $supplierId): Collection;
    
    public function findPublicMedicines(string $search = '', string $category = ''): Collection;
    
    public function getCategories(): array;
    
    public function findFeatured(): Collection;
} 