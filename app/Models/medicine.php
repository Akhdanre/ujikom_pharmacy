<?php

namespace App\Models;

use App\Domain\Medicine\Entities\Medicine as MedicineEntity;

/**
 * Medicine Model - Alias untuk Medicine Entity
 */
class medicine extends MedicineEntity
{
    // Tidak perlu mendefinisikan relasi lagi karena sudah ada di Entity
}
