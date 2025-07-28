<?php

namespace App\Models;

use App\Domain\Purchase\Entities\PurchaseTransaction as PurchaseTransactionEntity;

/**
 * PurchaseTransaction Model - Alias untuk PurchaseTransaction Entity
 */
class PurchaseTransaction extends PurchaseTransactionEntity
{
    // Tidak perlu mendefinisikan relasi lagi karena sudah ada di Entity
} 