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

    public function getCategoryById(int $id): ?CategoryDTO
    {
        $category = $this->categoryService->findById($id);
        return $category ? $this->entityToDTO($category) : null;
    }

    public function getAllCategories(): array
    {
        $categories = $this->categoryService->getAllCategories();
        return $categories->map(fn($category) => $this->entityToDTO($category))->toArray();
    }

    public function searchCategories(string $query): array
    {
        $categories = $this->categoryService->searchCategories($query);
        return $categories->map(fn($category) => $this->entityToDTO($category))->toArray();
    }

    public function getCategoriesWithMedicineCount(): array
    {
        $categories = $this->categoryService->getCategoriesWithMedicineCount();
        return $categories->map(fn($category) => $this->entityToDTO($category))->toArray();
    }

    public function getCategoriesWithTotalStock(): array
    {
        $categories = $this->categoryService->getCategoriesWithTotalStock();
        return $categories->map(fn($category) => $this->entityToDTO($category))->toArray();
    }

    public function getCategoriesWithAveragePrice(): array
    {
        $categories = $this->categoryService->getCategoriesWithAveragePrice();
        return $categories->map(fn($category) => $this->entityToDTO($category))->toArray();
    }

    public function getEmptyCategories(): array
    {
        $categories = $this->categoryService->getEmptyCategories();
        return $categories->map(fn($category) => $this->entityToDTO($category))->toArray();
    }

    public function getCategoriesWithLowStock(int $threshold = 10): array
    {
        $categories = $this->categoryService->getCategoriesWithLowStock($threshold);
        return $categories->map(fn($category) => $this->entityToDTO($category))->toArray();
    }

    public function getCategoriesWithExpiredMedicines(): array
    {
        $categories = $this->categoryService->getCategoriesWithExpiredMedicines();
        return $categories->map(fn($category) => $this->entityToDTO($category))->toArray();
    }

    public function getTopCategories(int $limit = 10): array
    {
        $categories = $this->categoryService->getTopCategories($limit);
        return $categories->map(fn($category) => $this->entityToDTO($category))->toArray();
    }

    private function entityToDTO($category): CategoryDTO
    {
        return CategoryDTO::fromArray($category->toArray());
    }
} 