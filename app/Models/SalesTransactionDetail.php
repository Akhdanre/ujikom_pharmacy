<?php

namespace App\Models;

use App\Domain\Sales\Entities\SalesTransactionDetail as SalesTransactionDetailEntity;

/**
 * SalesTransactionDetail Model - Alias untuk SalesTransactionDetail Entity
 */
class SalesTransactionDetail extends SalesTransactionDetailEntity
{
    // Tidak perlu mendefinisikan relasi lagi karena sudah ada di Entity
} 