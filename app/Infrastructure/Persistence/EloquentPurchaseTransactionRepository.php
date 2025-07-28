<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Purchase\Entities\PurchaseTransaction;
use App\Domain\Purchase\Repositories\PurchaseTransactionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

class EloquentPurchaseTransactionRepository implements PurchaseTransactionRepositoryInterface
{
    public function findById(int $id): ?PurchaseTransaction
    {
        return PurchaseTransaction::find($id);
    }
    
    public function findByUser(int $userId): Collection
    {
        return PurchaseTransaction::where('user_id', $userId)->get();
    }
    
    public function findByStatus(string $status): Collection
    {
        return PurchaseTransaction::where('status', $status)->get();
    }
    
    public function findByDateRange(string $startDate, string $endDate): Collection
    {
        return PurchaseTransaction::whereBetween('created_at', [$startDate, $endDate])->get();
    }
    
    public function findPending(): Collection
    {
        return PurchaseTransaction::where('status', 'pending')->get();
    }
    
    public function findProcessing(): Collection
    {
        return PurchaseTransaction::where('status', 'processing')->get();
    }
    
    public function findCompleted(): Collection
    {
        return PurchaseTransaction::where('status', 'completed')->get();
    }
    
    public function findCanceled(): Collection
    {
        return PurchaseTransaction::where('status', 'canceled')->get();
    }
    
    public function save(PurchaseTransaction $transaction): PurchaseTransaction
    {
        $transaction->save();
        return $transaction;
    }
    
    public function delete(PurchaseTransaction $transaction): bool
    {
        return $transaction->delete();
    }
    
    public function getAll(): Collection
    {
        return PurchaseTransaction::all();
    }
    
    public function getByTotalPriceRange(float $minPrice, float $maxPrice): Collection
    {
        return PurchaseTransaction::whereBetween('total_price', [$minPrice, $maxPrice])->get();
    }
    
    public function getTotalPurchaseAmount(string $startDate = null, string $endDate = null): float
    {
        $query = PurchaseTransaction::where('status', 'completed');
        
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        
        return $query->sum('total_price');
    }
    
    public function getPurchaseCount(string $startDate = null, string $endDate = null): int
    {
        $query = PurchaseTransaction::query();
        
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        
        return $query->count();
    }
    
    public function getAveragePurchaseAmount(string $startDate = null, string $endDate = null): float
    {
        $query = PurchaseTransaction::where('status', 'completed');
        
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        
        return $query->avg('total_price') ?? 0;
    }
    
    public function getTopPurchasers(int $limit = 10): Collection
    {
        return PurchaseTransaction::select('user_id')
            ->selectRaw('SUM(total_price) as total_amount')
            ->selectRaw('COUNT(*) as purchase_count')
            ->groupBy('user_id')
            ->orderBy('total_amount', 'desc')
            ->limit($limit)
            ->get();
    }
    
    public function getRecentPurchases(int $limit = 10): Collection
    {
        return PurchaseTransaction::orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
    
    public function getPurchasesWithDetails(int $transactionId): ?PurchaseTransaction
    {
        return PurchaseTransaction::with(['details.medicine', 'user', 'shipping', 'payment'])
            ->find($transactionId);
    }
    
    public function getPurchasesByMonth(int $year, int $month): Collection
    {
        return PurchaseTransaction::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();
    }
    
    public function getPurchasesByYear(int $year): Collection
    {
        return PurchaseTransaction::whereYear('created_at', $year)->get();
    }
} 