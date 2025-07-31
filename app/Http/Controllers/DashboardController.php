<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\Purchase;

class DashboardController extends Controller
{
    public function index()
    {
        // Get statistics for dashboard
        $totalMedicines = Medicine::count();
        $totalCustomers = Customer::count();
        $totalSales = Sale::count();
        $totalPurchases = Purchase::count();

        // Get recent sales
        $recentSales = Sale::with(['customer', 'medicine'])
            ->latest()
            ->take(5)
            ->get();

        // Get top selling medicines
        $topSellingMedicines = Medicine::withCount('sales')
            ->orderBy('sales_count', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalMedicines',
            'totalCustomers', 
            'totalSales',
            'totalPurchases',
            'recentSales',
            'topSellingMedicines'
        ));
    }
} 