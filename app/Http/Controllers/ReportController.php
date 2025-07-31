<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Purchase;
use App\Models\Medicine;
use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'month');
        
        // Sales Report
        $salesData = $this->getSalesData($period);
        
        // Purchase Report
        $purchaseData = $this->getPurchaseData($period);
        
        // Top Selling Medicines
        $topSellingMedicines = Medicine::withCount('sales')
            ->orderBy('sales_count', 'desc')
            ->take(10)
            ->get();
            
        // Top Customers
        $topCustomers = Customer::withCount('sales')
            ->orderBy('sales_count', 'desc')
            ->take(10)
            ->get();

        return view('reports.index', compact(
            'salesData',
            'purchaseData',
            'topSellingMedicines',
            'topCustomers',
            'period'
        ));
    }

    private function getSalesData($period)
    {
        $startDate = $this->getStartDate($period);
        
        return Sale::where('sale_date', '>=', $startDate)
            ->selectRaw('DATE(sale_date) as date, SUM(total_amount) as total_sales, COUNT(*) as total_transactions')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    private function getPurchaseData($period)
    {
        $startDate = $this->getStartDate($period);
        
        return Purchase::where('purchase_date', '>=', $startDate)
            ->selectRaw('DATE(purchase_date) as date, SUM(total_amount) as total_purchases, COUNT(*) as total_transactions')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    private function getStartDate($period)
    {
        switch ($period) {
            case 'week':
                return Carbon::now()->subWeek();
            case 'month':
                return Carbon::now()->subMonth();
            case 'quarter':
                return Carbon::now()->subQuarter();
            case 'year':
                return Carbon::now()->subYear();
            default:
                return Carbon::now()->subMonth();
        }
    }
} 