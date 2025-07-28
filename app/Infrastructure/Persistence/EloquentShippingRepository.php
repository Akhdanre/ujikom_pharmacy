<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Shipping\Entities\Shipping;
use App\Domain\Shipping\Repositories\ShippingRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

class EloquentShippingRepository implements ShippingRepositoryInterface
{
    public function findById(int $id): ?Shipping
    {
        return Shipping::find($id);
    }
    
    public function findByTransaction(int $transactionId, string $transactionType): ?Shipping
    {
        return Shipping::where('transaction_id', $transactionId)
            ->where('transaction_type', $transactionType)
            ->first();
    }
    
    public function findByStatus(string $status): Collection
    {
        return Shipping::where('status', $status)->get();
    }
    
    public function findByDateRange(string $startDate, string $endDate): Collection
    {
        return Shipping::whereBetween('shipping_date', [$startDate, $endDate])->get();
    }
    
    public function findShipped(): Collection
    {
        return Shipping::where('status', 'shipped')->get();
    }
    
    public function findInTransit(): Collection
    {
        return Shipping::where('status', 'in transit')->get();
    }
    
    public function findDelivered(): Collection
    {
        return Shipping::where('status', 'delivered')->get();
    }
    
    public function save(Shipping $shipping): Shipping
    {
        $shipping->save();
        return $shipping;
    }
    
    public function delete(Shipping $shipping): bool
    {
        return $shipping->delete();
    }
    
    public function getAll(): Collection
    {
        return Shipping::all();
    }
    
    public function getByTransactionType(string $transactionType): Collection
    {
        return Shipping::where('transaction_type', $transactionType)->get();
    }
    
    public function getDeliveriesByMonth(int $year, int $month): Collection
    {
        return Shipping::whereYear('shipping_date', $year)
            ->whereMonth('shipping_date', $month)
            ->get();
    }
    
    public function getDeliveriesByYear(int $year): Collection
    {
        return Shipping::whereYear('shipping_date', $year)->get();
    }
    
    public function getAverageDeliveryTime(): float
    {
        $deliveries = Shipping::where('status', 'delivered')
            ->whereNotNull('shipping_date')
            ->get();
        
        if ($deliveries->isEmpty()) {
            return 0;
        }
        
        $totalDays = 0;
        foreach ($deliveries as $delivery) {
            $shippingDate = Carbon::parse($delivery->shipping_date);
            $deliveryDate = Carbon::parse($delivery->updated_at);
            $totalDays += $shippingDate->diffInDays($deliveryDate);
        }
        
        return $totalDays / $deliveries->count();
    }
    
    public function getDeliveriesBySender(string $sender): Collection
    {
        return Shipping::where('sender', 'like', "%{$sender}%")->get();
    }
    
    public function getDeliveriesByAddress(string $address): Collection
    {
        return Shipping::where('shipping_address', 'like', "%{$address}%")->get();
    }
    
    public function getRecentDeliveries(int $limit = 10): Collection
    {
        return Shipping::orderBy('shipping_date', 'desc')
            ->limit($limit)
            ->get();
    }
    
    public function getOverdueDeliveries(): Collection
    {
        return Shipping::where('status', 'in transit')
            ->where('shipping_date', '<', now()->subDays(7))
            ->get();
    }
} 