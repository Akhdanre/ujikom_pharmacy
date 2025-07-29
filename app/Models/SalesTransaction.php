<?php

namespace App\Models;

use App\Domain\Sales\Entities\SalesTransaction as SalesTransactionEntity;

/**
 * SalesTransaction Model - Alias untuk SalesTransaction Entity
 */
class SalesTransaction extends SalesTransactionEntity
{
    // Tidak perlu mendefinisikan relasi lagi karena sudah ada di Entity
} 