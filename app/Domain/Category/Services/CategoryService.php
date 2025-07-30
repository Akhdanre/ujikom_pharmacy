<?php

namespace App\Domain\Category\Services;

use App\Domain\Category\Entities\Category;
use App\Domain\Category\Repositories\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ) {}

    public function createCategory(array $data): Category
    {
        $this->validateCategoryData($data);

        // Check if category name already exists
        if ($this->categoryRepository->findByName($data['category_name'])) {
            throw new \InvalidArgumentException('Category name already exists');
        }

        $category = new Category($data);
        return $this->categoryRepository->save($category);
    }

    public function updateCategory(int $id, array $data): Category
    {
        $category = $this->categoryRepository->findById($id);

        if (!$category) {
            throw new \InvalidArgumentException('Category not found');
        }

        $this->validateCategoryData($data);

        // Check if name is being changed and if it already exists
        if (isset($data['category_name']) && $data['category_name'] !== $category->category_name) {
            if ($this->categoryRepository->findByName($data['category_name'])) {
                throw new \InvalidArgumentException('Category name already exists');
            }
        }

        $category->fill($data);
        return $this->categoryRepository->save($category);
    }

    public function deleteCategory(int $id): bool
    {
        $category = $this->categoryRepository->findById($id);

        if (!$category) {
            throw new \InvalidArgumentException('Category not found');
        }

        // Check if category has medicines
        if ($category->hasMedicines()) {
            throw new \InvalidArgumentException('Cannot delete category that has medicines');
        }

        return $this->categoryRepository->delete($category);
    }

    public function findById(int $id): ?Category
    {
        return $this->categoryRepository->findById($id);
    }

    public function getAllCategories(): Collection
    {
        return $this->categoryRepository->getAll();
    }

    public function searchCategories(string $query): Collection
    {
        return $this->categoryRepository->search($query);
    }

    public function getCategoriesWithMedicineCount(): Collection
    {
        return $this->categoryRepository->getWithMedicineCount();
    }

    public function getCategoriesWithTotalStock(): Collection
    {
        return $this->categoryRepository->getWithTotalStock();
    }

    public function getCategoriesWithAveragePrice(): Collection
    {
        return $this->categoryRepository->getWithAveragePrice();
    }

    public function getEmptyCategories(): Collection
    {
        return $this->categoryRepository->getEmptyCategories();
    }

    public function getCategoriesWithLowStock(int $threshold = 10): Collection
    {
        return $this->categoryRepository->getCategoriesWithLowStock($threshold);
    }

    public function getCategoriesWithExpiredMedicines(): Collection
    {
        return $this->categoryRepository->getCategoriesWithExpiredMedicines();
    }

    public function getTopCategories(int $limit = 10): Collection
    {
        return $this->categoryRepository->getTopCategories($limit);
    }

    public function getCategoryStatistics(): array
    {
        $allCategories = $this->categoryRepository->getAll();
        $categoriesWithMedicines = $this->categoryRepository->getWithMedicineCount();
        $emptyCategories = $this->categoryRepository->getEmptyCategories();
        $topCategories = $this->categoryRepository->getTopCategories(5);

        return [
            'total_categories' => $allCategories->count(),
            'categories_with_medicines' => $categoriesWithMedicines->count(),
            'empty_categories' => $emptyCategories->count(),
            'top_categories' => $topCategories,
            'average_medicines_per_category' => $allCategories->count() > 0
                ? $categoriesWithMedicines->avg('medicines_count') ?? 0
                : 0,
        ];
    }

    private function validateCategoryData(array $data): void
    {
        $requiredFields = ['category_name'];

        foreach ($requiredFields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                throw new \InvalidArgumentException("Field {$field} is required");
            }
        }

        if (strlen($data['category_name']) < 2) {
            throw new \InvalidArgumentException('Category name must be at least 2 characters');
        }

        if (strlen($data['category_name']) > 255) {
            throw new \InvalidArgumentException('Category name cannot exceed 255 characters');
        }
    }
}
