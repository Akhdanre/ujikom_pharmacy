<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Medicine\Entities\Medicine;
use App\Domain\Medicine\Repositories\MedicineRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentMedicineRepository implements MedicineRepositoryInterface
{
    public function findById(int $id): ?Medicine
    {
        return Medicine::find($id);
    }
    
    public function findByCode(string $code): ?Medicine
    {
        return Medicine::where('code', $code)->first();
    }
    
    public function findByName(string $name): Collection
    {
        return Medicine::where('name', 'like', "%{$name}%")->get();
    }
    
    public function findByCategory(string $category): Collection
    {
        return Medicine::where('category', $category)->get();
    }
    
    public function findActive(): Collection
    {
        return Medicine::where('is_active', true)->get();
    }
    
    public function findLowStock(): Collection
    {
        return Medicine::whereRaw('stock_quantity <= min_stock_level')
            ->where('is_active', true)
            ->get();
    }
    
    public function findOutOfStock(): Collection
    {
        return Medicine::where('stock_quantity', 0)
            ->where('is_active', true)
            ->get();
    }
    
    public function save(Medicine $medicine): Medicine
    {
        $medicine->save();
        return $medicine;
    }
    
    public function delete(Medicine $medicine): bool
    {
        return $medicine->delete();
    }
    
    public function getAll(): Collection
    {
        return Medicine::all();
    }
    
    public function search(string $query): Collection
    {
        return Medicine::where(function ($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
              ->orWhere('code', 'like', "%{$query}%")
              ->orWhere('description', 'like', "%{$query}%");
        })->get();
    }
    
    public function getBySupplier(int $supplierId): Collection
    {
        return Medicine::where('supplier_id', $supplierId)->get();
    }

    public function findPublicMedicines(string $search = '', string $category = ''): Collection
    {
        $query = Medicine::where('is_active', true)
            ->where('stock_quantity', '>', 0);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($category) {
            $query->where('category', $category);
        }

        return $query->orderBy('name')->get();
    }

    public function getCategories(): array
    {
        return Medicine::where('is_active', true)
            ->distinct()
            ->pluck('category')
            ->filter()
            ->toArray();
    }

    public function findFeatured(): Collection
    {
        return Medicine::where('is_active', true)
            ->where('stock_quantity', '>', 0)
            ->orderBy('stock_quantity', 'desc')
            ->take(8)
            ->get();
    }
} 