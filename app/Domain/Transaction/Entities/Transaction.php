<?php

namespace App\Domain\Transaction\Entities;

use App\Domain\Transaction\ValueObjects\TransactionStatus;
use App\Domain\Transaction\ValueObjects\TransactionType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'transaction_number',
        'customer_id',
        'user_id',
        'transaction_date',
        'total_amount',
        'discount_amount',
        'tax_amount',
        'grand_total',
        'payment_method',
        'status',
        'notes'
    ];

    protected $casts = [
        'transaction_date' => 'datetime',
        'total_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'grand_total' => 'decimal:2',
    ];

    // Business Logic Methods
    public function calculateTotal(): float
    {
        return $this->details->sum(function ($detail) {
            return $detail->quantity * $detail->unit_price;
        });
    }

    public function calculateGrandTotal(): float
    {
        $total = $this->calculateTotal();
        $discount = $this->discount_amount ?? 0;
        $tax = $this->tax_amount ?? 0;
        
        return $total - $discount + $tax;
    }

    public function addDiscount(float $discountAmount): void
    {
        if ($discountAmount < 0) {
            throw new \InvalidArgumentException('Discount cannot be negative');
        }

        $total = $this->calculateTotal();
        if ($discountAmount > $total) {
            throw new \InvalidArgumentException('Discount cannot exceed total amount');
        }

        $this->discount_amount = $discountAmount;
        $this->grand_total = $this->calculateGrandTotal();
        $this->save();
    }

    public function addTax(float $taxAmount): void
    {
        if ($taxAmount < 0) {
            throw new \InvalidArgumentException('Tax cannot be negative');
        }

        $this->tax_amount = $taxAmount;
        $this->grand_total = $this->calculateGrandTotal();
        $this->save();
    }

    public function canBeCancelled(): bool
    {
        return in_array($this->status, ['pending', 'processing']);
    }

    public function cancel(): void
    {
        if (!$this->canBeCancelled()) {
            throw new \InvalidArgumentException('Transaction cannot be cancelled');
        }

        $this->status = 'cancelled';
        $this->save();

        // Restore stock for each item
        foreach ($this->details as $detail) {
            $detail->medicine->addStock($detail->quantity);
        }
    }

    public function complete(): void
    {
        if ($this->status !== 'processing') {
            throw new \InvalidArgumentException('Transaction must be in processing status to complete');
        }

        $this->status = 'completed';
        $this->save();
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    public function getStatusColor(): string
    {
        return match($this->status) {
            'pending' => 'warning',
            'processing' => 'info',
            'completed' => 'success',
            'cancelled' => 'danger',
            default => 'secondary'
        };
    }

    // Relationships
    public function details(): HasMany
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Customer\Entities\Customer::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }
} 