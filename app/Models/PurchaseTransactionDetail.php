<?php

namespace App\Models;

use App\Domain\Purchase\Entities\PurchaseTransactionDetail as PurchaseTransactionDetailEntity;

/**
 * PurchaseTransactionDetail Model - Alias untuk PurchaseTransactionDetail Entity
 */
class PurchaseTransactionDetail extends PurchaseTransactionDetailEntity
{
    // Tidak perlu mendefinisikan relasi lagi karena sudah ada di Entity
} 