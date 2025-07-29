<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Sales\Entities\SalesTransaction;
use App\Domain\Sales\Repositories\SalesTransactionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EloquentSalesTransactionRepository implements SalesTransactionRepositoryInterface
{
    public function findById(int $id): ?SalesTransaction
    {
        return SalesTransaction::find($id);
    }
    
    public function findByUser(int $userId): Collection
    {
        return SalesTransaction::where('user_id', $userId)->get();
    }
    
    public function findByStatus(string $status): Collection
    {
        return SalesTransaction::where('status', $status)->get();
    }
    
    public function findByDateRange(string $startDate, string $endDate): Collection
    {
        return SalesTransaction::whereBetween('created_at', [$startDate, $endDate])->get();
    }
    
    public function findPending(): Collection
    {
        return SalesTransaction::where('status', 'pending')->get();
    }
    
    public function findProcessing(): Collection
    {
        return SalesTransaction::where('status', 'processing')->get();
    }
    
    public function findCompleted(): Collection
    {
        return SalesTransaction::where('status', 'completed')->get();
    }
    
    public function findCanceled(): Collection
    {
        return SalesTransaction::where('status', 'canceled')->get();
    }
    
    public function save(SalesTransaction $transaction): SalesTransaction
    {
        $transaction->save();
        return $transaction;
    }
    
    public function delete(SalesTransaction $transaction): bool
    {
        return $transaction->delete();
    }
    
    public function getAll(): Collection
    {
        return SalesTransaction::all();
    }
    
    public function getByTotalPriceRange(float $minPrice, float $maxPrice): Collection
    {
        return SalesTransaction::whereBetween('total_price', [$minPrice, $maxPrice])->get();
    }
    
    public function getTotalSalesAmount(?string $startDate = null, ?string $endDate = null): float
    {
        $query = SalesTransaction::where('status', 'completed');
        
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        
        return $query->sum('total_price');
    }
    
    public function getSalesCount(?string $startDate = null, ?string $endDate = null): int
    {
        $query = SalesTransaction::query();
        
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        
        return $query->count();
    }
    
    public function getAverageSalesAmount(?string $startDate = null, ?string $endDate = null): float
    {
        $query = SalesTransaction::where('status', 'completed');
        
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        
        return $query->avg('total_price') ?? 0;
    }
    
    public function getTopSellers(int $limit = 10): Collection
    {
        return SalesTransaction::select('user_id')
            ->selectRaw('SUM(total_price) as total_amount')
            ->selectRaw('COUNT(*) as sales_count')
            ->groupBy('user_id')
            ->orderBy('total_amount', 'desc')
            ->limit($limit)
            ->get();
    }
    
    public function getRecentSales(int $limit = 10): Collection
    {
        return SalesTransaction::orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
    
    public function getSalesWithDetails(int $transactionId): ?SalesTransaction
    {
        return SalesTransaction::with(['details.medicine', 'user', 'shipping', 'payment'])
            ->find($transactionId);
    }
    
    public function getSalesByMonth(int $year, int $month): Collection
    {
        return SalesTransaction::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();
    }
    
    public function getSalesByYear(int $year): Collection
    {
        return SalesTransaction::whereYear('created_at', $year)->get();
    }
    
    public function getTopSellingProducts(int $limit = 10): Collection
    {
        $results = DB::table('sales_transaction_details')
            ->select([
                'sales_transaction_details.product_id',
                DB::raw('SUM(sales_transaction_details.quantity) as total_quantity'),
                DB::raw('SUM(sales_transaction_details.quantity * sales_transaction_details.price) as total_revenue')
            ])
            ->groupBy('sales_transaction_details.product_id')
            ->orderBy('total_quantity', 'desc')
            ->limit($limit)
            ->get();

        // Convert to Eloquent Collection
        return new Collection($results);
    }
    
    public function getSalesByProduct(int $productId): Collection
    {
        return SalesTransaction::join('sales_transaction_details', 'sales_transactions.transaction_id', '=', 'sales_transaction_details.transaction_id')
            ->where('sales_transaction_details.product_id', $productId)
            ->get();
    }
} 