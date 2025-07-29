<?php

namespace App\Domain\Purchase\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseTransactionDetail extends Model
{
    protected $primaryKey = 'detail_id';

    protected $fillable = [
        'transaction_id',
        'product_id',
        'quantity',
        'price'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2',
    ];

    // Business Logic Methods
    public function getSubtotal(): float
    {
        return $this->quantity * $this->price;
    }

    public function getFormattedSubtotal(): string
    {
        return 'Rp ' . number_format($this->getSubtotal(), 0, ',', '.');
    }

    public function getFormattedPrice(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function updateQuantity(int $newQuantity): void
    {
        if ($newQuantity <= 0) {
            throw new \InvalidArgumentException('Quantity must be greater than 0');
        }

        $this->quantity = $newQuantity;
        $this->save();

        // Recalculate transaction total
        $this->transaction->recalculateTotalPrice();
    }

    public function updatePrice(float $newPrice): void
    {
        if ($newPrice < 0) {
            throw new \InvalidArgumentException('Price cannot be negative');
        }

        $this->price = $newPrice;
        $this->save();

        // Recalculate transaction total
        $this->transaction->recalculateTotalPrice();
    }

    public function updateDetails(int $quantity, float $price): void
    {
        if ($quantity <= 0) {
            throw new \InvalidArgumentException('Quantity must be greater than 0');
        }

        if ($price < 0) {
            throw new \InvalidArgumentException('Price cannot be negative');
        }

        $this->quantity = $quantity;
        $this->price = $price;
        $this->save();

        // Recalculate transaction total
        $this->transaction->recalculateTotalPrice();
    }

    // Relationships
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Purchase\Entities\PurchaseTransaction::class, 'transaction_id');
    }

    public function medicine(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Medicine\Entities\Medicine::class, 'product_id');
    }
} 