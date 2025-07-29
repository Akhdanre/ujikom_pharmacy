<?php

namespace App\Domain\Customer\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'postal_code',
        'is_active',
        'membership_level',
        'points_balance'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'points_balance' => 'integer',
    ];

    // Business Logic Methods
    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function activate(): void
    {
        $this->is_active = true;
        $this->save();
    }

    public function deactivate(): void
    {
        $this->is_active = false;
        $this->save();
    }

    public function addPoints(int $points): void
    {
        if ($points < 0) {
            throw new \InvalidArgumentException('Points cannot be negative');
        }

        $this->points_balance += $points;
        $this->save();
    }

    public function usePoints(int $points): void
    {
        if ($points < 0) {
            throw new \InvalidArgumentException('Points cannot be negative');
        }

        if ($this->points_balance < $points) {
            throw new \InvalidArgumentException('Insufficient points balance');
        }

        $this->points_balance -= $points;
        $this->save();
    }

    public function getMembershipDiscount(): float
    {
        return match($this->membership_level) {
            'gold' => 0.15, // 15% discount
            'silver' => 0.10, // 10% discount
            'bronze' => 0.05, // 5% discount
            default => 0.00
        };
    }

    public function upgradeMembership(string $newLevel): void
    {
        $validLevels = ['bronze', 'silver', 'gold'];
        
        if (!in_array($newLevel, $validLevels)) {
            throw new \InvalidArgumentException('Invalid membership level');
        }

        $this->membership_level = $newLevel;
        $this->save();
    }

    public function getTotalSpent(): float
    {
        return $this->transactions()
            ->where('status', 'completed')
            ->sum('grand_total');
    }

    public function getTransactionCount(): int
    {
        return $this->transactions()
            ->where('status', 'completed')
            ->count();
    }

    public function getAverageTransactionValue(): float
    {
        $count = $this->getTransactionCount();
        if ($count === 0) return 0;
        
        return $this->getTotalSpent() / $count;
    }

    // Relationships
    public function transactions(): HasMany
    {
        return $this->hasMany(\App\Domain\Transaction\Entities\Transaction::class);
    }
} 