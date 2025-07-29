<?php

namespace App\Models;

use App\Domain\Payment\Entities\Payment as PaymentEntity;

/**
 * Payment Model - Alias untuk Payment Entity
 */
class Payment extends PaymentEntity
{
    // Tidak perlu mendefinisikan relasi lagi karena sudah ada di Entity
} 