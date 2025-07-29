<?php

namespace App\Models;

use App\Domain\Shipping\Entities\Shipping as ShippingEntity;

/**
 * Shipping Model - Alias untuk Shipping Entity
 */
class Shipping extends ShippingEntity
{
    // Tidak perlu mendefinisikan relasi lagi karena sudah ada di Entity
} 