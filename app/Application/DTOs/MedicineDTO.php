<?php

namespace App\Application\DTOs;

class MedicineDTO {
    public function __construct(
        public readonly ?int $id,
        public readonly string $medicine_name,
        public readonly ?string $description,
        public readonly float $price,
        public readonly int $stock,
        public readonly ?int $category_id,
        public readonly ?string $image_url,
        public readonly ?string $expired_at,
        public readonly ?string $created_at,
        public readonly ?string $updated_at,
        public readonly ?object $category = null
    ) {
    }

    public static function fromArray(array $data): self {
        return new self(
            id: $data['id'] ?? null,
            medicine_name: $data['medicine_name'] ?? $data['name'] ?? '',
            description: $data['description'] ?? null,
            price: (float) ($data['price'] ?? 0),
            stock: (int) ($data['stock'] ?? $data['stock_quantity'] ?? 0),
            category_id: $data['category_id'] ?? null,
            image_url: $data['image_url'] ?? null,
            expired_at: $data['expired_at'] ?? null,
            created_at: $data['created_at'] ?? null,
            updated_at: $data['updated_at'] ?? null,
            category: $data['category'] ?? null
        );
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'medicine_name' => $this->medicine_name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'category_id' => $this->category_id,
            'image_url' => $this->image_url,
            'expired_at' => $this->expired_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public function isLowStock(): bool {
        return $this->stock <= 10; // Default minimum stock level
    }

    public function isOutOfStock(): bool {
        return $this->stock <= 0;
    }

    public function isExpired(): bool {
        if (!$this->expired_at) {
            return false;
        }

        return \Carbon\Carbon::parse($this->expired_at)->isPast();
    }

    public function isExpiringSoon(int $days = 30): bool {
        if (!$this->expired_at) {
            return false;
        }

        $expiryDate = \Carbon\Carbon::parse($this->expired_at);
        return $expiryDate->diffInDays(\Carbon\Carbon::now(), false) <= $days;
    }

    public function getFormattedPrice(): string {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function isAvailable(): bool {
        return $this->stock > 0 && !$this->isExpired();
    }

    public function getStockStatus(): string {
        if ($this->stock <= 0) {
            return 'Habis Stok';
        } elseif ($this->stock <= 10) {
            return 'Stok Menipis';
        } else {
            return 'Tersedia';
        }
    }

    public function getStockStatusKey(): string {
        if ($this->isOutOfStock()) {
            return 'out_of_stock';
        }

        if ($this->isLowStock()) {
            return 'low_stock';
        }

        return 'available';
    }

    public function getExpiryStatus(): string {
        if (!$this->expired_at) {
            return 'Tidak ada data';
        }

        if ($this->isExpired()) {
            return 'Kadaluarsa';
        }

        if ($this->isExpiringSoon()) {
            $daysLeft = \Carbon\Carbon::parse($this->expired_at)->diffInDays(\Carbon\Carbon::now(), false);
            return "Akan Kadaluarsa ({$daysLeft} hari)";
        }

        return 'Aman';
    }

    public function getExpiryStatusKey(): string {
        if (!$this->expired_at) {
            return 'no_data';
        }

        if ($this->isExpired()) {
            return 'expired';
        }

        if ($this->isExpiringSoon()) {
            return 'expiring_soon';
        }

        return 'safe';
    }

    public function getDaysUntilExpiry(): ?int {
        if (!$this->expired_at) {
            return null;
        }

        return \Carbon\Carbon::parse($this->expired_at)->diffInDays(\Carbon\Carbon::now(), false);
    }

    public function getFormattedExpiry(): string {
        if (!$this->expired_at) {
            return 'Tidak ada data';
        }

        return \Carbon\Carbon::parse($this->expired_at)->format('d/m/Y');
    }
}
