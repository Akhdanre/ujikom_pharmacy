<?php

namespace App\Application\Services;

use App\Application\DTOs\CategoryDTO;
use App\Domain\Category\Services\CategoryService;
use Illuminate\Database\Eloquent\Collection;

class CategoryApplicationService
{
    public function __construct(
        private CategoryService $categoryService
    ) {}

    public function createCategory(array $data): CategoryDTO
    {
        $category = $this->categoryService->createCategory($data);
        return $this->entityToDTO($category);
    }

    public function updateCategory(int $id, array $data): CategoryDTO
    {
        $category = $this->categoryService->updateCategory($id, $data);
        return $this->entityToDTO($category);
    }

    public function deleteCategory(int $id): bool
    {
        return $this->categoryService->deleteCategory($id);
    }

    public function getCategory(int $id): ?CategoryDTO
    {
        $category = $this->categoryService->findById($id);
        return $category ? $this->entityToDTO($category) : null;
    }

    public function getAllCategories(): array
    {
        $categories = $this->categoryService->getAllCategories();
        return $categories->map(fn($category) => $this->entityToDTO($category))->toArray();
    }

    public function getActiveCategories(): array
    {
        // Since we don't have active/inactive status, return all categories
        return $this->getAllCategories();
    }

    public function getCategoryById(int $id): ?CategoryDTO
    {
        $category = $this->categoryService->findById($id);
        return $category ? $this->entityToDTO($category) : null;
    }

    public function getCategoriesWithMedicineCount(): array
    {
        $categories = $this->categoryService->getCategoriesWithMedicineCount();
        return $categories->map(fn($category) => $this->entityToDTO($category))->toArray();
    }

    public function getPopularCategories(int $limit = 6): array
    {
        // Use top categories instead since getPopularCategories doesn't exist
        $categories = $this->categoryService->getTopCategories($limit);
        return $categories->map(fn($category) => $this->entityToDTO($category))->toArray();
    }

    public function searchCategories(string $query): array
    {
        $categories = $this->categoryService->searchCategories($query);
        return $categories->map(fn($category) => $this->entityToDTO($category))->toArray();
    }

    public function getCategoryStatistics(): array
    {
        $totalCategories = $this->categoryService->getAllCategories()->count();
        $activeCategories = $this->categoryService->getActiveCategories()->count();
        $categoriesWithMedicines = $this->categoryService->getCategoriesWithMedicineCount()->count();

        return [
            'total_categories' => $totalCategories,
            'active_categories' => $activeCategories,
            'categories_with_medicines' => $categoriesWithMedicines,
            'inactive_categories' => $totalCategories - $activeCategories,
        ];
    }

    public function getCategoryByName(string $name): ?CategoryDTO
    {
        $category = $this->categoryService->findByName($name);
        return $category ? $this->entityToDTO($category) : null;
    }

    public function getCategoriesForNavigation(): array
    {
        // Since we don't have active/inactive status, return all categories
        return $this->getAllCategories();
    }

    public function getFeaturedCategories(int $limit = 4): array
    {
        // Since we don't have active/inactive status, return top categories
        return $this->getPopularCategories($limit);
    }

    public function getCategoriesWithFilters(array $filters): array
    {
        $categories = $this->categoryService->getAllCategories();
        
        // Apply search filter
        if (!empty($filters['search'])) {
            $categories = $categories->filter(function($category) use ($filters) {
                return stripos($category->category_name, $filters['search']) !== false ||
                       stripos($category->description, $filters['search']) !== false;
            });
        }
        
        // Apply status filter - Since we don't have is_active field, we'll skip this for now
        // if (!empty($filters['status'])) {
        //     $categories = $categories->where('is_active', $filters['status'] === 'active');
        // }
        
        // Apply sorting
        if (!empty($filters['sort'])) {
            $order = $filters['order'] ?? 'asc';
            $categories = $categories->sortBy($filters['sort']);
            if ($order === 'desc') {
                $categories = $categories->reverse();
            }
        }
        
        return $categories->map(fn($category) => $this->entityToDTO($category))->toArray();
    }

    private function entityToDTO($category): CategoryDTO
    {
        return CategoryDTO::fromArray($category->toArray());
    }


} 