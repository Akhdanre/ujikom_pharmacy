<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\SalesTransaction;
use App\Models\Medicine;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends BaseController {
    public function index() {
        // Data dummy untuk kartu statistik
        $totalMedicines = 1250;
        $totalCustomers = 450;
        
        // Pendapatan bulan ini (dummy)
        $currentMonthRevenue = 15264000;
        
        // Transaksi hari ini (dummy)
        $todayTransactions = 89;
        
        // Data dummy untuk grafik penjualan (7 hari terakhir)
        $salesData = $this->getDummySalesChartData();
        
        // Data dummy untuk transaksi terbaru
        $recentTransactions = $this->getDummyRecentTransactions();
        
        // Data dummy untuk obat terlaris
        $topSellingMedicines = $this->getDummyTopSellingMedicines();

        return view('pages.admin-home.index', compact(
            'totalMedicines',
            'totalCustomers', 
            'currentMonthRevenue',
            'todayTransactions',
            'salesData',
            'recentTransactions',
            'topSellingMedicines'
        ));
    }
    
    private function getDummySalesChartData() {
        // Data dummy untuk 7 hari terakhir
        $labels = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $sales = [45, 52, 38, 67, 58, 73, 61];
        $revenue = [2.8, 3.2, 2.4, 4.1, 3.6, 4.5, 3.8]; // dalam juta rupiah
        $customers = [12, 15, 10, 18, 14, 20, 16];
        
        return [
            'labels' => $labels,
            'sales' => $sales,
            'revenue' => $revenue,
            'customers' => $customers
        ];
    }
    
    private function getDummyRecentTransactions() {
        return [
            [
                'transaction_id' => 2457,
                'user' => ['name' => 'Budi Santoso'],
                'details' => [
                    ['medicine' => ['medicine_name' => 'Paracetamol 500mg']],
                    ['medicine' => ['medicine_name' => 'Vitamin C 1000mg']]
                ],
                'total_price' => 15000,
                'status' => 'Selesai'
            ],
            [
                'transaction_id' => 2147,
                'user' => ['name' => 'Siti Aminah'],
                'details' => [
                    ['medicine' => ['medicine_name' => 'Amoxicillin 500mg']]
                ],
                'total_price' => 25000,
                'status' => 'Proses'
            ],
            [
                'transaction_id' => 2049,
                'user' => ['name' => 'Ahmad Rizki'],
                'details' => [
                    ['medicine' => ['medicine_name' => 'Vitamin C 1000mg']],
                    ['medicine' => ['medicine_name' => 'Ibuprofen 400mg']],
                    ['medicine' => ['medicine_name' => 'Cetirizine 10mg']]
                ],
                'total_price' => 35000,
                'status' => 'Selesai'
            ],
            [
                'transaction_id' => 2644,
                'user' => ['name' => 'Dewi Sartika'],
                'details' => [
                    ['medicine' => ['medicine_name' => 'Omeprazole 20mg']]
                ],
                'total_price' => 45000,
                'status' => 'Dibatalkan'
            ],
            [
                'transaction_id' => 2645,
                'user' => ['name' => 'Rudi Hermawan'],
                'details' => [
                    ['medicine' => ['medicine_name' => 'Ibuprofen 400mg']]
                ],
                'total_price' => 20000,
                'status' => 'Selesai'
            ]
        ];
    }
    
    private function getDummyTopSellingMedicines() {
        return [
            [
                'name' => 'Paracetamol 500mg',
                'price' => 15000,
                'total_sold' => 124,
                'total_revenue' => 1860000
            ],
            [
                'name' => 'Amoxicillin 500mg',
                'price' => 25000,
                'total_sold' => 98,
                'total_revenue' => 2450000
            ],
            [
                'name' => 'Vitamin C 1000mg',
                'price' => 35000,
                'total_sold' => 74,
                'total_revenue' => 2590000
            ],
            [
                'name' => 'Omeprazole 20mg',
                'price' => 45000,
                'total_sold' => 63,
                'total_revenue' => 2835000
            ],
            [
                'name' => 'Ibuprofen 400mg',
                'price' => 20000,
                'total_sold' => 41,
                'total_revenue' => 820000
            ]
        ];
    }
}
