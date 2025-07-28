<?php

namespace App\Domain\Purchase\Repositories;

use App\Domain\Purchase\Entities\PurchaseTransaction;
use Illuminate\Database\Eloquent\Collection;

interface PurchaseTransactionRepositoryInterface
{
    public function findById(int $id): ?PurchaseTransaction;
    
    public function findByUser(int $userId): Collection;
    
    public function findByStatus(string $status): Collection;
    
    public function findByDateRange(string $startDate, string $endDate): Collection;
    
    public function findPending(): Collection;
    
    public function findProcessing(): Collection;
    
    public function findCompleted(): Collection;
    
    public function findCanceled(): Collection;
    
    public function save(PurchaseTransaction $transaction): PurchaseTransaction;
    
    public function delete(PurchaseTransaction $transaction): bool;
    
    public function getAll(): Collection;
    
    public function getByTotalPriceRange(float $minPrice, float $maxPrice): Collection;
    
    public function getTotalPurchaseAmount(string $startDate = null, string $endDate = null): float;
    
    public function getPurchaseCount(string $startDate = null, string $endDate = null): int;
    
    public function getAveragePurchaseAmount(string $startDate = null, string $endDate = null): float;
    
    public function getTopPurchasers(int $limit = 10): Collection;
    
    public function getRecentPurchases(int $limit = 10): Collection;
    
    public function getPurchasesWithDetails(int $transactionId): ?PurchaseTransaction;
    
    public function getPurchasesByMonth(int $year, int $month): Collection;
    
    public function getPurchasesByYear(int $year): Collection;
} 