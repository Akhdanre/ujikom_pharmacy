<?php

namespace App\Domain\Medicine\Entities;

use App\Domain\Medicine\ValueObjects\MedicineName;
use App\Domain\Medicine\ValueObjects\MedicineCode;
use App\Domain\Medicine\ValueObjects\Price;
use App\Domain\Medicine\ValueObjects\StockQuantity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Medicine extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'category',
        'price',
        'stock_quantity',
        'min_stock_level',
        'supplier_id',
        'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock_quantity' => 'integer',
        'min_stock_level' => 'integer',
        'is_active' => 'boolean',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    // Business Logic Methods
    public function isLowStock(): bool
    {
        return $this->stock_quantity <= $this->min_stock_level;
    }

    public function isOutOfStock(): bool
    {
        return $this->stock_quantity <= 0;
    }

    public function canSell(int $quantity): bool
    {
        return $this->is_active && $this->stock_quantity >= $quantity;
    }

    public function reduceStock(int $quantity): void
    {
        if ($this->stock_quantity < $quantity) {
            throw new \InvalidArgumentException('Insufficient stock');
        }
        
        $this->stock_quantity -= $quantity;
        $this->save();
    }

    public function addStock(int $quantity): void
    {
        $this->stock_quantity += $quantity;
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

    public function deactivate(): void
    {
        $this->is_active = false;
        $this->save();
    }

    public function activate(): void
    {
        $this->is_active = true;
        $this->save();
    }

    // Relationships
    public function transactionDetails(): HasMany
    {
        return $this->hasMany(\App\Domain\Transaction\Entities\TransactionDetail::class);
    }

    public function supplier()
    {
        return $this->belongsTo(\App\Domain\Inventory\Entities\Supplier::class);
    }
} 