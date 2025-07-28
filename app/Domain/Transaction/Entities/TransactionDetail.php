<?php

namespace App\Domain\Transaction\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionDetail extends Model
{
    protected $fillable = [
        'transaction_id',
        'medicine_id',
        'quantity',
        'unit_price',
        'subtotal',
        'discount_amount'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'discount_amount' => 'decimal:2',
    ];

    // Business Logic Methods
    public function calculateSubtotal(): float
    {
        $subtotal = $this->quantity * $this->unit_price;
        $discount = $this->discount_amount ?? 0;
        
        return $subtotal - $discount;
    }

    public function updateQuantity(int $newQuantity): void
    {
        if ($newQuantity <= 0) {
            throw new \InvalidArgumentException('Quantity must be greater than 0');
        }

        // Check if medicine has enough stock
        if (!$this->medicine->canSell($newQuantity)) {
            throw new \InvalidArgumentException('Insufficient stock for this quantity');
        }

        $this->quantity = $newQuantity;
        $this->subtotal = $this->calculateSubtotal();
        $this->save();
    }

    public function updateUnitPrice(float $newPrice): void
    {
        if ($newPrice < 0) {
            throw new \InvalidArgumentException('Unit price cannot be negative');
        }

        $this->unit_price = $newPrice;
        $this->subtotal = $this->calculateSubtotal();
        $this->save();
    }

    public function addDiscount(float $discountAmount): void
    {
        if ($discountAmount < 0) {
            throw new \InvalidArgumentException('Discount cannot be negative');
        }

        $subtotal = $this->quantity * $this->unit_price;
        if ($discountAmount > $subtotal) {
            throw new \InvalidArgumentException('Discount cannot exceed subtotal');
        }

        $this->discount_amount = $discountAmount;
        $this->subtotal = $this->calculateSubtotal();
        $this->save();
    }

    public function getDiscountPercentage(): float
    {
        $subtotal = $this->quantity * $this->unit_price;
        if ($subtotal == 0) return 0;
        
        return ($this->discount_amount / $subtotal) * 100;
    }

    // Relationships
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function medicine(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Medicine\Entities\Medicine::class);
    }
} 