<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Medicine\Entities\Medicine;
use App\Domain\Medicine\Repositories\MedicineRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class EloquentMedicineRepository implements MedicineRepositoryInterface
{
    public function findById(int $id): ?Medicine
    {
        return Medicine::find($id);
    }
    
    public function findByCategory(int $categoryId): Collection
    {
        return Medicine::where('category_id', $categoryId)->get();
    }
    
    public function findByName(string $name): Collection
    {
        return Medicine::where('medicine_name', 'like', "%{$name}%")->get();
    }
    
    public function findActive(): Collection
    {
        return Medicine::where('expired_at', '>', now())
            ->orWhereNull('expired_at')
            ->get();
    }
    
    public function findInactive(): Collection
    {
        return Medicine::where('expired_at', '<=', now())->get();
    }
    
    public function findLowStock(int $threshold = 10): Collection
    {
        return Medicine::where('stock', '<=', $threshold)->get();
    }
    
    public function findOutOfStock(): Collection
    {
        return Medicine::where('stock', '<=', 0)->get();
    }
    
    public function findExpired(): Collection
    {
        return Medicine::where('expired_at', '<', now())->get();
    }
    
    public function findExpiringSoon(int $days = 30): Collection
    {
        return Medicine::where('expired_at', '>=', now())
            ->where('expired_at', '<=', now()->addDays($days))
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
        return Medicine::where('medicine_name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->get();
    }
    
    public function getByPriceRange(float $minPrice, float $maxPrice): Collection
    {
        return Medicine::whereBetween('price', [$minPrice, $maxPrice])->get();
    }
    
    public function getByStockRange(int $minStock, int $maxStock): Collection
    {
        return Medicine::whereBetween('stock', [$minStock, $maxStock])->get();
    }
    
    public function updateStock(int $medicineId, int $quantity): bool
    {
        $medicine = $this->findById($medicineId);
        if (!$medicine) {
            return false;
        }
        
        $medicine->updateStock($quantity);
        return true;
    }
    
    public function getTotalStock(): int
    {
        return Medicine::sum('stock');
    }
    
    public function getAveragePrice(): float
    {
        return Medicine::avg('price') ?? 0;
    }
    
    public function getMostExpensive(): ?Medicine
    {
        return Medicine::orderBy('price', 'desc')->first();
    }
    
    public function getLeastExpensive(): ?Medicine
    {
        return Medicine::orderBy('price', 'asc')->first();
    }
    
    public function getTopSelling(int $limit = 10): Collection
    {
        return Medicine::select('medicines.*')
            ->leftJoin('sales_transaction_details', 'medicines.id', '=', 'sales_transaction_details.product_id')
            ->groupBy('medicines.id')
            ->orderByRaw('SUM(sales_transaction_details.quantity) DESC')
            ->limit($limit)
            ->get();
    }
    
    public function getLowestStock(int $limit = 10): Collection
    {
        return Medicine::orderBy('stock', 'asc')->limit($limit)->get();
    }
} 