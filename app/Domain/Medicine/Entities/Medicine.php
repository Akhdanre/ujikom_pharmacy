<?php

namespace App\Domain\Medicine\Entities;

use App\Domain\Medicine\ValueObjects\MedicineName;
use App\Domain\Medicine\ValueObjects\Price;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Medicine extends Model
{
    protected $fillable = [
        'medicine_name',
        'description',
        'price',
        'stock',
        'category_id',
        'image_url',
        'expired_at'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'expired_at' => 'datetime',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    // Business Logic Methods
    public function isLowStock(): bool
    {
        return $this->stock <= 10; // Default minimum stock level
    }

    public function isOutOfStock(): bool
    {
        return $this->stock <= 0;
    }

    public function isExpired(): bool
    {
        return $this->expired_at && $this->expired_at->isPast();
    }

    public function isExpiringSoon(int $days = 30): bool
    {
        if (!$this->expired_at) {
            return false;
        }
        
        return $this->expired_at->diffInDays(now()) <= $days;
    }

    public function canSell(int $quantity): bool
    {
        return !$this->isExpired() && $this->stock >= $quantity;
    }

    public function reduceStock(int $quantity): void
    {
        if ($this->stock < $quantity) {
            throw new \InvalidArgumentException('Insufficient stock');
        }
        
        $this->stock -= $quantity;
        $this->save();
    }

    public function addStock(int $quantity): void
    {
        $this->stock += $quantity;
        $this->save();
    }

    public function updatePrice(float $newPrice): void
    {
        if ($newPrice < 0) {
            throw new \InvalidArgumentException('Price cannot be negative');
        }
        
        $this->price = $newPrice;
        $this->save();
    }

    public function updateStock(int $newStock): void
    {
        if ($newStock < 0) {
            throw new \InvalidArgumentException('Stock cannot be negative');
        }
        
        $this->stock = $newStock;
        $this->save();
    }

    public function updateExpiryDate(\DateTime $expiryDate): void
    {
        $this->expired_at = $expiryDate;
        $this->save();
    }

    public function updateImageUrl(string $imageUrl): void
    {
        $this->image_url = $imageUrl;
        $this->save();
    }

    public function getDisplayName(): string
    {
        return $this->medicine_name;
    }

    public function getFormattedPrice(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getStockStatus(): string
    {
        if ($this->isOutOfStock()) {
            return 'Out of Stock';
        }
        
        if ($this->isLowStock()) {
            return 'Low Stock';
        }
        
        return 'In Stock';
    }

    public function getStockStatusColor(): string
    {
        if ($this->isOutOfStock()) {
            return 'red';
        }
        
        if ($this->isLowStock()) {
            return 'orange';
        }
        
        return 'green';
    }

    // Relationships
    public function category(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Category\Entities\Category::class);
    }

    public function purchaseTransactionDetails(): HasMany
    {
        return $this->hasMany(\App\Domain\Purchase\Entities\PurchaseTransactionDetail::class, 'product_id');
    }

    public function salesTransactionDetails(): HasMany
    {
        return $this->hasMany(\App\Domain\Sales\Entities\SalesTransactionDetail::class, 'product_id');
    }
} 