<?php

namespace App\Domain\Sales\Repositories;

use App\Domain\Sales\Entities\SalesTransaction;
use Illuminate\Database\Eloquent\Collection;

interface SalesTransactionRepositoryInterface
{
    public function findById(int $id): ?SalesTransaction;
    
    public function findByUser(int $userId): Collection;
    
    public function findByStatus(string $status): Collection;
    
    public function findByDateRange(string $startDate, string $endDate): Collection;
    
    public function findPending(): Collection;
    
    public function findProcessing(): Collection;
    
    public function findCompleted(): Collection;
    
    public function findCanceled(): Collection;
    
    public function save(SalesTransaction $transaction): SalesTransaction;
    
    public function delete(SalesTransaction $transaction): bool;
    
    public function getAll(): Collection;
    
    public function getByTotalPriceRange(float $minPrice, float $maxPrice): Collection;
    
    public function getTotalSalesAmount(?string $startDate = null, ?string $endDate = null): float;
    
    public function getSalesCount(?string $startDate = null, ?string $endDate = null): int;
    
    public function getAverageSalesAmount(?string $startDate = null, ?string $endDate = null): float;
    
    public function getTopSellers(int $limit = 10): Collection;
    
    public function getRecentSales(int $limit = 10): Collection;
    
    public function getSalesWithDetails(int $transactionId): ?SalesTransaction;
    
    public function getSalesByMonth(int $year, int $month): Collection;
    
    public function getSalesByYear(int $year): Collection;
    
    public function getTopSellingProducts(int $limit = 10): Collection;
    
    public function getSalesByProduct(int $productId): Collection;
} 