<?php

namespace App\Domain\Inventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'code',
        'email',
        'phone',
        'address',
        'city',
        'contact_person',
        'is_active',
        'notes'
    ];

    protected $casts = [
        'is_active' => 'boolean',
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

    public function updateContactInfo(string $email, string $phone, string $contactPerson): void
    {
        $this->email = $email;
        $this->phone = $phone;
        $this->contact_person = $contactPerson;
        $this->save();
    }

    public function updateAddress(string $address, string $city): void
    {
        $this->address = $address;
        $this->city = $city;
        $this->save();
    }

    public function getMedicineCount(): int
    {
        return $this->medicines()->count();
    }

    public function getActiveMedicineCount(): int
    {
        return $this->medicines()->where('is_active', true)->count();
    }

    public function getTotalMedicineValue(): float
    {
        return $this->medicines()
            ->where('is_active', true)
            ->get()
            ->sum(function ($medicine) {
                return $medicine->price * $medicine->stock_quantity;
            });
    }

    // Relationships
    public function medicines(): HasMany
    {
        return $this->hasMany(\App\Domain\Medicine\Entities\Medicine::class);
    }
} 