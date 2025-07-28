<?php

namespace App\Models;

use App\Domain\Category\Entities\Category as CategoryEntity;

/**
 * Category Model - Alias untuk Category Entity
 */
class Category extends CategoryEntity
{
    // Tidak perlu mendefinisikan relasi lagi karena sudah ada di Entity
} 