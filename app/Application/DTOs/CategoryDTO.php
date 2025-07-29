<?php

namespace App\Application\DTOs;

class CategoryDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $category_name,
        public readonly ?string $description,
        public readonly ?string $created_at,
        public readonly ?string $updated_at,
        public readonly ?int $medicines_count = null,
        public readonly ?int $total_stock = null,
        public readonly ?float $average_price = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            category_name: $data['category_name'],
            description: $data['description'] ?? null,
            created_at: $data['created_at'] ?? null,
            updated_at: $data['updated_at'] ?? null,
            medicines_count: $data['medicines_count'] ?? null,
            total_stock: $data['total_stock'] ?? null,
            average_price: $data['average_price'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'category_name' => $this->category_name,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'medicines_count' => $this->medicines_count,
            'total_stock' => $this->total_stock,
            'average_price' => $this->average_price,
        ];
    }

    public function getDisplayName(): string
    {
        return $this->category_name;
    }

    public function hasMedicines(): bool
    {
        return $this->medicines_count > 0;
    }

    public function isEmpty(): bool
    {
        return $this->medicines_count === 0;
    }

    public function getFormattedAveragePrice(): string
    {
        if ($this->average_price === null) {
            return 'N/A';
        }
        return 'Rp ' . number_format($this->average_price, 0, ',', '.');
    }

    public function getFormattedTotalStock(): string
    {
        if ($this->total_stock === null) {
            return 'N/A';
        }
        return number_format($this->total_stock, 0, ',', '.');
    }
} 