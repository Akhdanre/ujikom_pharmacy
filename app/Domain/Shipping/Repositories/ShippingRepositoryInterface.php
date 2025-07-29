<?php

namespace App\Domain\Shipping\Repositories;

use App\Domain\Shipping\Entities\Shipping;
use Illuminate\Database\Eloquent\Collection;

interface ShippingRepositoryInterface
{
    public function findById(int $id): ?Shipping;
    
    public function findByTransaction(int $transactionId, string $transactionType): ?Shipping;
    
    public function findByStatus(string $status): Collection;
    
    public function findByDateRange(string $startDate, string $endDate): Collection;
    
    public function findShipped(): Collection;
    
    public function findInTransit(): Collection;
    
    public function findDelivered(): Collection;
    
    public function save(Shipping $shipping): Shipping;
    
    public function delete(Shipping $shipping): bool;
    
    public function getAll(): Collection;
    
    public function getByTransactionType(string $transactionType): Collection;
    
    public function getDeliveriesByMonth(int $year, int $month): Collection;
    
    public function getDeliveriesByYear(int $year): Collection;
    
    public function getAverageDeliveryTime(): float;
    
    public function getDeliveriesBySender(string $sender): Collection;
    
    public function getDeliveriesByAddress(string $address): Collection;
    
    public function getRecentDeliveries(int $limit = 10): Collection;
    
    public function getOverdueDeliveries(): Collection;
} 