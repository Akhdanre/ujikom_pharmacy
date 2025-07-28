<?php

namespace App\Domain\Category\Repositories;

use App\Domain\Category\Entities\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    public function findById(int $id): ?Category;
    
    public function findByName(string $name): ?Category;
    
    public function save(Category $category): Category;
    
    public function delete(Category $category): bool;
    
    public function getAll(): Collection;
    
    public function search(string $query): Collection;
    
    public function getWithMedicineCount(): Collection;
    
    public function getWithTotalStock(): Collection;
    
    public function getWithAveragePrice(): Collection;
    
    public function getEmptyCategories(): Collection;
    
    public function getCategoriesWithLowStock(int $threshold = 10): Collection;
    
    public function getCategoriesWithExpiredMedicines(): Collection;
    
    public function getTopCategories(int $limit = 10): Collection;
} 