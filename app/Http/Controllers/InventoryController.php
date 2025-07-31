<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $medicines = Medicine::with('category')
            ->orderBy('stock', 'asc')
            ->paginate(15);

        $lowStockMedicines = Medicine::where('stock', '<=', 10)->get();
        $outOfStockMedicines = Medicine::where('stock', 0)->get();
        $expiringMedicines = Medicine::where('expiry_date', '<=', now()->addMonths(3))->get();

        return view('inventory.index', compact(
            'medicines',
            'lowStockMedicines',
            'outOfStockMedicines',
            'expiringMedicines'
        ));
    }
} 