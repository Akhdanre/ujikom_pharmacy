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
        $categories = $this->categoryService->getActiveCategories();
        return $categories->map(fn($category) => $this->entityToDTO($category))->toArray();
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
        $categories = $this->categoryService->getPopularCategories($limit);
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

    public function getCategoryHierarchy(): array
    {
        $categories = $this->categoryService->getAllCategories();
        return $this->buildHierarchy($categories);
    }

    public function getCategoryTree(): array
    {
        $categories = $this->categoryService->getAllCategories();
        return $this->buildTree($categories);
    }

    public function getCategoryPath(int $categoryId): array
    {
        $category = $this->categoryService->findById($categoryId);
        if (!$category) {
            return [];
        }

        $path = [];
        $currentCategory = $category;

        while ($currentCategory) {
            array_unshift($path, $this->entityToDTO($currentCategory));
            $currentCategory = $currentCategory->parent;
        }

        return $path;
    }

    public function getSubcategories(int $parentId): array
    {
        $subcategories = $this->categoryService->getSubcategories($parentId);
        return $subcategories->map(fn($category) => $this->entityToDTO($category))->toArray();
    }

    public function getParentCategories(): array
    {
        $parentCategories = $this->categoryService->getParentCategories();
        return $parentCategories->map(fn($category) => $this->entityToDTO($category))->toArray();
    }

    public function getCategoryByName(string $name): ?CategoryDTO
    {
        $category = $this->categoryService->findByName($name);
        return $category ? $this->entityToDTO($category) : null;
    }

    public function getCategoryBySlug(string $slug): ?CategoryDTO
    {
        $category = $this->categoryService->findBySlug($slug);
        return $category ? $this->entityToDTO($category) : null;
    }

    public function getCategoriesForNavigation(): array
    {
        $categories = $this->categoryService->getActiveCategories();
        return $categories->map(fn($category) => $this->entityToDTO($category))->toArray();
    }

    public function getFeaturedCategories(int $limit = 4): array
    {
        $categories = $this->categoryService->getActiveCategories()->take($limit);
        return $categories->map(fn($category) => $this->entityToDTO($category))->toArray();
    }

    public function getCategoriesWithFilters(array $filters): array
    {
        $categories = $this->categoryService->getAllCategories();
        
        // Apply search filter
        if (!empty($filters['search'])) {
            $categories = $categories->filter(function($category) use ($filters) {
                return stripos($category->name, $filters['search']) !== false ||
                       stripos($category->description, $filters['search']) !== false;
            });
        }
        
        // Apply status filter
        if (!empty($filters['status'])) {
            $categories = $categories->where('is_active', $filters['status'] === 'active');
        }
        
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

    private function buildHierarchy(Collection $categories, ?int $parentId = null): array
    {
        $hierarchy = [];
        
        foreach ($categories as $category) {
            if ($category->parent_id === $parentId) {
                $categoryData = $this->entityToDTO($category);
                $categoryData['children'] = $this->buildHierarchy($categories, $category->id);
                $hierarchy[] = $categoryData;
            }
        }
        
        return $hierarchy;
    }

    private function buildTree(Collection $categories): array
    {
        $tree = [];
        $lookup = [];
        
        // Create lookup table
        foreach ($categories as $category) {
            $lookup[$category->id] = $this->entityToDTO($category);
            $lookup[$category->id]['children'] = [];
        }
        
        // Build tree
        foreach ($categories as $category) {
            if ($category->parent_id === null) {
                $tree[] = &$lookup[$category->id];
            } else {
                $lookup[$category->parent_id]['children'][] = &$lookup[$category->id];
            }
        }
        
        return $tree;
    }
} 