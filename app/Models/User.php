<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Domain\User\Entities\User as UserEntity;

class User extends UserEntity
{
    use HasFactory, Notifiable;

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    // Relationships
    public function purchaseTransactions(): HasMany
    {
        return $this->hasMany(\App\Models\PurchaseTransaction::class, 'user_id');
    }

    public function salesTransactions(): HasMany
    {
        return $this->hasMany(\App\Models\SalesTransaction::class, 'user_id');
    }
}
