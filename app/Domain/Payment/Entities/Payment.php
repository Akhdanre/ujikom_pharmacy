<?php

namespace App\Domain\Payment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'transaction_id',
        'transaction_type',
        'payment_method',
        'amount',
        'status',
        'payment_date'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Business Logic Methods
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }

    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }

    public function canBePaid(): bool
    {
        return $this->isPending();
    }

    public function canBeFailed(): bool
    {
        return $this->isPending();
    }

    public function updateStatus(string $newStatus): void
    {
        $validStatuses = ['pending', 'paid', 'failed'];
        
        if (!in_array($newStatus, $validStatuses)) {
            throw new \InvalidArgumentException('Invalid status');
        }

        $this->status = $newStatus;
        $this->save();
    }

    public function markAsPaid(): void
    {
        if (!$this->canBePaid()) {
            throw new \InvalidArgumentException('Payment cannot be marked as paid');
        }

        $this->status = 'paid';
        $this->payment_date = now();
        $this->save();
    }

    public function markAsFailed(): void
    {
        if (!$this->canBeFailed()) {
            throw new \InvalidArgumentException('Payment cannot be marked as failed');
        }

        $this->updateStatus('failed');
    }

    public function updateAmount(float $newAmount): void
    {
        if ($newAmount < 0) {
            throw new \InvalidArgumentException('Amount cannot be negative');
        }

        $this->amount = $newAmount;
        $this->save();
    }

    public function updatePaymentMethod(string $newMethod): void
    {
        $validMethods = ['transfer', 'credit card', 'e-wallet'];
        
        if (!in_array($newMethod, $validMethods)) {
            throw new \InvalidArgumentException('Invalid payment method');
        }

        $this->payment_method = $newMethod;
        $this->save();
    }

    public function updatePaymentDate(\DateTime $paymentDate): void
    {
        $this->payment_date = $paymentDate;
        $this->save();
    }

    public function getFormattedAmount(): string
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    public function getStatusDisplayName(): string
    {
        return match($this->status) {
            'pending' => 'Pending',
            'paid' => 'Paid',
            'failed' => 'Failed',
            default => 'Unknown'
        };
    }

    public function getStatusColor(): string
    {
        return match($this->status) {
            'pending' => 'yellow',
            'paid' => 'green',
            'failed' => 'red',
            default => 'gray'
        };
    }

    public function getPaymentMethodDisplayName(): string
    {
        return match($this->payment_method) {
            'transfer' => 'Bank Transfer',
            'credit card' => 'Credit Card',
            'e-wallet' => 'E-Wallet',
            default => 'Unknown'
        };
    }

    public function getFormattedPaymentDate(): string
    {
        return $this->payment_date ? $this->payment_date->format('d M Y H:i') : 'Not paid yet';
    }

    public function isOverdue(): bool
    {
        if ($this->isPaid()) {
            return false;
        }

        // Consider payment overdue if pending for more than 7 days
        return $this->created_at->diffInDays(now()) > 7;
    }

    public function getDaysOverdue(): int
    {
        if ($this->isPaid()) {
            return 0;
        }

        return max(0, $this->created_at->diffInDays(now()) - 7);
    }

    // Relationships
    public function purchaseTransaction(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Purchase\Entities\PurchaseTransaction::class, 'transaction_id')
            ->where('transaction_type', 'purchase');
    }

    public function salesTransaction(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Sales\Entities\SalesTransaction::class, 'transaction_id')
            ->where('transaction_type', 'sales');
    }

    public function transaction(): BelongsTo
    {
        if ($this->transaction_type === 'purchase') {
            return $this->purchaseTransaction();
        } else {
            return $this->salesTransaction();
        }
    }
} 