<?php

namespace App\Domain\Category\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $table = 'kategoris';

    protected $fillable = [
        'category_name',
        'description'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Business Logic Methods
    public function getDisplayName(): string
    {
        return $this->category_name;
    }

    public function updateName(string $newName): void
    {
        if (empty(trim($newName))) {
            throw new \InvalidArgumentException('Category name cannot be empty');
        }

        $this->category_name = trim($newName);
        $this->save();
    }

    public function updateDescription(?string $description): void
    {
        $this->description = $description;
        $this->save();
    }

    public function hasMedicines(): bool
    {
        return $this->medicines()->count() > 0;
    }

    public function getMedicineCount(): int
    {
        return $this->medicines()->count();
    }

    public function getTotalStock(): int
    {
        return $this->medicines()->sum('stock');
    }

    public function getAveragePrice(): float
    {
        return $this->medicines()->avg('price') ?? 0;
    }

    public function getLowStockMedicines(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->medicines()->where('stock', '<=', 10)->get();
    }

    public function getExpiredMedicines(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->medicines()->where('expired_at', '<', now())->get();
    }

    public function getExpiringSoonMedicines(int $days = 30): \Illuminate\Database\Eloquent\Collection
    {
        return $this->medicines()
            ->where('expired_at', '>=', now())
            ->where('expired_at', '<=', now()->addDays($days))
            ->get();
    }

    // Relationships
    public function medicines(): HasMany
    {
        return $this->hasMany(\App\Domain\Medicine\Entities\Medicine::class, 'category_id');
    }
} 