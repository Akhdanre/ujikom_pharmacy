<?php

namespace App\Domain\Payment\Repositories;

use App\Domain\Payment\Entities\Payment;
use Illuminate\Database\Eloquent\Collection;

interface PaymentRepositoryInterface
{
    public function findById(int $id): ?Payment;
    
    public function findByTransaction(int $transactionId, string $transactionType): ?Payment;
    
    public function findByStatus(string $status): Collection;
    
    public function findByPaymentMethod(string $paymentMethod): Collection;
    
    public function findByDateRange(string $startDate, string $endDate): Collection;
    
    public function findPending(): Collection;
    
    public function findPaid(): Collection;
    
    public function findFailed(): Collection;
    
    public function save(Payment $payment): Payment;
    
    public function delete(Payment $payment): bool;
    
    public function getAll(): Collection;
    
    public function getByTransactionType(string $transactionType): Collection;
    
    public function getPaymentsByMonth(int $year, int $month): Collection;
    
    public function getPaymentsByYear(int $year): Collection;
    
    public function getTotalPaymentAmount(string $startDate = null, string $endDate = null): float;
    
    public function getPaymentCount(string $startDate = null, string $endDate = null): int;
    
    public function getAveragePaymentAmount(string $startDate = null, string $endDate = null): float;
    
    public function getPaymentsByMethod(string $paymentMethod): Collection;
    
    public function getOverduePayments(): Collection;
    
    public function getRecentPayments(int $limit = 10): Collection;
    
    public function getSuccessfulPayments(string $startDate = null, string $endDate = null): Collection;
    
    public function getFailedPayments(string $startDate = null, string $endDate = null): Collection;
} 