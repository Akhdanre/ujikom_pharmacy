<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Payment\Entities\Payment;
use App\Domain\Payment\Repositories\PaymentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

class EloquentPaymentRepository implements PaymentRepositoryInterface
{
    public function findById(int $id): ?Payment
    {
        return Payment::find($id);
    }
    
    public function findByTransaction(int $transactionId, string $transactionType): ?Payment
    {
        return Payment::where('transaction_id', $transactionId)
            ->where('transaction_type', $transactionType)
            ->first();
    }
    
    public function findByStatus(string $status): Collection
    {
        return Payment::where('status', $status)->get();
    }
    
    public function findByPaymentMethod(string $paymentMethod): Collection
    {
        return Payment::where('payment_method', $paymentMethod)->get();
    }
    
    public function findByDateRange(string $startDate, string $endDate): Collection
    {
        return Payment::whereBetween('payment_date', [$startDate, $endDate])->get();
    }
    
    public function findPending(): Collection
    {
        return Payment::where('status', 'pending')->get();
    }
    
    public function findPaid(): Collection
    {
        return Payment::where('status', 'paid')->get();
    }
    
    public function findFailed(): Collection
    {
        return Payment::where('status', 'failed')->get();
    }
    
    public function save(Payment $payment): Payment
    {
        $payment->save();
        return $payment;
    }
    
    public function delete(Payment $payment): bool
    {
        return $payment->delete();
    }
    
    public function getAll(): Collection
    {
        return Payment::all();
    }
    
    public function getByTransactionType(string $transactionType): Collection
    {
        return Payment::where('transaction_type', $transactionType)->get();
    }
    
    public function getPaymentsByMonth(int $year, int $month): Collection
    {
        return Payment::whereYear('payment_date', $year)
            ->whereMonth('payment_date', $month)
            ->get();
    }
    
    public function getPaymentsByYear(int $year): Collection
    {
        return Payment::whereYear('payment_date', $year)->get();
    }
    
    public function getTotalPaymentAmount(string $startDate = null, string $endDate = null): float
    {
        $query = Payment::where('status', 'paid');
        
        if ($startDate && $endDate) {
            $query->whereBetween('payment_date', [$startDate, $endDate]);
        }
        
        return $query->sum('amount');
    }
    
    public function getPaymentCount(string $startDate = null, string $endDate = null): int
    {
        $query = Payment::query();
        
        if ($startDate && $endDate) {
            $query->whereBetween('payment_date', [$startDate, $endDate]);
        }
        
        return $query->count();
    }
    
    public function getAveragePaymentAmount(string $startDate = null, string $endDate = null): float
    {
        $query = Payment::where('status', 'paid');
        
        if ($startDate && $endDate) {
            $query->whereBetween('payment_date', [$startDate, $endDate]);
        }
        
        return $query->avg('amount') ?? 0;
    }
    
    public function getPaymentsByMethod(string $paymentMethod): Collection
    {
        return Payment::where('payment_method', $paymentMethod)->get();
    }
    
    public function getOverduePayments(): Collection
    {
        return Payment::where('status', 'pending')
            ->where('created_at', '<', now()->subDays(7))
            ->get();
    }
    
    public function getRecentPayments(int $limit = 10): Collection
    {
        return Payment::orderBy('payment_date', 'desc')
            ->limit($limit)
            ->get();
    }
    
    public function getSuccessfulPayments(string $startDate = null, string $endDate = null): Collection
    {
        $query = Payment::where('status', 'paid');
        
        if ($startDate && $endDate) {
            $query->whereBetween('payment_date', [$startDate, $endDate]);
        }
        
        return $query->get();
    }
    
    public function getFailedPayments(string $startDate = null, string $endDate = null): Collection
    {
        $query = Payment::where('status', 'failed');
        
        if ($startDate && $endDate) {
            $query->whereBetween('payment_date', [$startDate, $endDate]);
        }
        
        return $query->get();
    }
} 