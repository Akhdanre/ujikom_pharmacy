<?php

namespace App\Application\DTOs;

class MedicineDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $code,
        public readonly string $name,
        public readonly ?string $description,
        public readonly ?string $category,
        public readonly float $price,
        public readonly int $stock_quantity,
        public readonly int $min_stock_level,
        public readonly ?int $supplier_id,
        public readonly bool $is_active,
        public readonly ?string $created_at,
        public readonly ?string $updated_at
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            code: $data['code'],
            name: $data['name'],
            description: $data['description'] ?? null,
            category: $data['category'] ?? null,
            price: (float) $data['price'],
            stock_quantity: (int) $data['stock_quantity'],
            min_stock_level: (int) $data['min_stock_level'],
            supplier_id: $data['supplier_id'] ?? null,
            is_active: (bool) ($data['is_active'] ?? true),
            created_at: $data['created_at'] ?? null,
            updated_at: $data['updated_at'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'category' => $this->category,
            'price' => $this->price,
            'stock_quantity' => $this->stock_quantity,
            'min_stock_level' => $this->min_stock_level,
            'supplier_id' => $this->supplier_id,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public function isLowStock(): bool
    {
        return $this->stock_quantity <= $this->min_stock_level;
    }

    public function isOutOfStock(): bool
    {
        return $this->stock_quantity <= 0;
    }

    public function getFormattedPrice(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function isAvailable(): bool
    {
        return $this->stock_quantity > 0 && $this->is_active;
    }

    public function getStockStatus(): string
    {
        if ($this->stock_quantity <= 0) {
            return 'Habis';
        } elseif ($this->stock_quantity <= $this->min_stock_level) {
            return 'Stok Menipis';
        } else {
            return 'Tersedia';
        }
    }

    public function getStockStatusKey(): string
    {
        if ($this->isOutOfStock()) {
            return 'out_of_stock';
        }
        
        if ($this->isLowStock()) {
            return 'low_stock';
        }
        
        return 'available';
    }
} 