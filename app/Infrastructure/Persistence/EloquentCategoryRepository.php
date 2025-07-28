<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Category\Entities\Category;
use App\Domain\Category\Repositories\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentCategoryRepository implements CategoryRepositoryInterface
{
    public function findById(int $id): ?Category
    {
        return Category::find($id);
    }
    
    public function findByName(string $name): ?Category
    {
        return Category::where('category_name', $name)->first();
    }
    
    public function save(Category $category): Category
    {
        $category->save();
        return $category;
    }
    
    public function delete(Category $category): bool
    {
        return $category->delete();
    }
    
    public function getAll(): Collection
    {
        return Category::all();
    }
    
    public function search(string $query): Collection
    {
        return Category::where('category_name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->get();
    }
    
    public function getWithMedicineCount(): Collection
    {
        return Category::withCount('medicines')->get();
    }
    
    public function getWithTotalStock(): Collection
    {
        return Category::withSum('medicines', 'stock')->get();
    }
    
    public function getWithAveragePrice(): Collection
    {
        return Category::withAvg('medicines', 'price')->get();
    }
    
    public function getEmptyCategories(): Collection
    {
        return Category::doesntHave('medicines')->get();
    }
    
    public function getCategoriesWithLowStock(int $threshold = 10): Collection
    {
        return Category::whereHas('medicines', function ($query) use ($threshold) {
            $query->where('stock', '<=', $threshold);
        })->get();
    }
    
    public function getCategoriesWithExpiredMedicines(): Collection
    {
        return Category::whereHas('medicines', function ($query) {
            $query->where('expired_at', '<', now());
        })->get();
    }
    
    public function getTopCategories(int $limit = 10): Collection
    {
        return Category::withCount('medicines')
            ->orderBy('medicines_count', 'desc')
            ->limit($limit)
            ->get();
    }
} 