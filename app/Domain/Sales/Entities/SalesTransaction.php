<?php

namespace App\Domain\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SalesTransaction extends Model
{
    protected $primaryKey = 'transaction_id';

    protected $fillable = [
        'user_id',
        'total_price',
        'status'
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Business Logic Methods
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isProcessing(): bool
    {
        return $this->status === 'processing';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isCanceled(): bool
    {
        return $this->status === 'canceled';
    }

    public function canBeProcessed(): bool
    {
        return $this->isPending();
    }

    public function canBeCompleted(): bool
    {
        return $this->isProcessing();
    }

    public function canBeCanceled(): bool
    {
        return in_array($this->status, ['pending', 'processing']);
    }

    public function updateStatus(string $newStatus): void
    {
        $validStatuses = ['pending', 'processing', 'completed', 'canceled'];
        
        if (!in_array($newStatus, $validStatuses)) {
            throw new \InvalidArgumentException('Invalid status');
        }

        $this->status = $newStatus;
        $this->save();
    }

    public function process(): void
    {
        if (!$this->canBeProcessed()) {
            throw new \InvalidArgumentException('Transaction cannot be processed');
        }

        // Check if all items are available in stock
        foreach ($this->details as $detail) {
            $medicine = $detail->medicine;
            if (!$medicine->canSell($detail->quantity)) {
                throw new \InvalidArgumentException("Insufficient stock for {$medicine->medicine_name}");
            }
        }

        $this->updateStatus('processing');
    }

    public function complete(): void
    {
        if (!$this->canBeCompleted()) {
            throw new \InvalidArgumentException('Transaction cannot be completed');
        }

        // Reduce stock for all items
        foreach ($this->details as $detail) {
            $detail->medicine->reduceStock($detail->quantity);
        }

        $this->updateStatus('completed');
    }

    public function cancel(): void
    {
        if (!$this->canBeCanceled()) {
            throw new \InvalidArgumentException('Transaction cannot be canceled');
        }

        $this->updateStatus('canceled');
    }

    public function calculateTotalPrice(): float
    {
        return $this->details()->sum(\DB::raw('quantity * price'));
    }

    public function recalculateTotalPrice(): void
    {
        $this->total_price = $this->calculateTotalPrice();
        $this->save();
    }

    public function getItemCount(): int
    {
        return $this->details()->sum('quantity');
    }

    public function getUniqueItemCount(): int
    {
        return $this->details()->count();
    }

    public function getFormattedTotalPrice(): string
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }

    public function getStatusDisplayName(): string
    {
        return match($this->status) {
            'pending' => 'Pending',
            'processing' => 'Processing',
            'completed' => 'Completed',
            'canceled' => 'Canceled',
            default => 'Unknown'
        };
    }

    public function getStatusColor(): string
    {
        return match($this->status) {
            'pending' => 'yellow',
            'processing' => 'blue',
            'completed' => 'green',
            'canceled' => 'red',
            default => 'gray'
        };
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\User\Entities\User::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(\App\Domain\Sales\Entities\SalesTransactionDetail::class, 'transaction_id');
    }

    public function shipping(): HasOne
    {
        return $this->hasOne(\App\Domain\Shipping\Entities\Shipping::class, 'transaction_id')
            ->where('transaction_type', 'sales');
    }

    public function payment(): HasOne
    {
        return $this->hasOne(\App\Domain\Payment\Entities\Payment::class, 'transaction_id')
            ->where('transaction_type', 'sales');
    }
} 