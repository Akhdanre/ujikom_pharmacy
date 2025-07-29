<?php

namespace Database\Seeders;

use App\Domain\Medicine\Entities\Medicine;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $medicines = [
            // Analgesik
            [
                'code' => 'PAR001',
                'name' => 'Paracetamol 500mg',
                'description' => 'Obat pereda nyeri dan demam yang aman untuk semua usia',
                'category' => 'Analgesik',
                'price' => 5000,
                'stock_quantity' => 100,
                'min_stock_level' => 10,
                'is_active' => true,
            ],
            [
                'code' => 'IBU002',
                'name' => 'Ibuprofen 400mg',
                'description' => 'Obat anti inflamasi non steroid untuk nyeri dan peradangan',
                'category' => 'Analgesik',
                'price' => 8000,
                'stock_quantity' => 75,
                'min_stock_level' => 10,
                'is_active' => true,
            ],
            [
                'code' => 'ASP003',
                'name' => 'Aspirin 100mg',
                'description' => 'Obat pengencer darah dan pereda nyeri',
                'category' => 'Analgesik',
                'price' => 3000,
                'stock_quantity' => 120,
                'min_stock_level' => 15,
                'is_active' => true,
            ],
            
            // Antibiotik
            [
                'code' => 'AMO004',
                'name' => 'Amoxicillin 500mg',
                'description' => 'Antibiotik untuk infeksi bakteri ringan hingga sedang',
                'category' => 'Antibiotik',
                'price' => 15000,
                'stock_quantity' => 50,
                'min_stock_level' => 5,
                'is_active' => true,
            ],
            [
                'code' => 'CIP005',
                'name' => 'Ciprofloxacin 500mg',
                'description' => 'Antibiotik untuk infeksi saluran kemih',
                'category' => 'Antibiotik',
                'price' => 25000,
                'stock_quantity' => 30,
                'min_stock_level' => 5,
                'is_active' => true,
            ],
            
            // Vitamin
            [
                'code' => 'VIT006',
                'name' => 'Vitamin C 1000mg',
                'description' => 'Suplemen vitamin C untuk meningkatkan daya tahan tubuh',
                'category' => 'Vitamin',
                'price' => 12000,
                'stock_quantity' => 200,
                'min_stock_level' => 20,
                'is_active' => true,
            ],
            [
                'code' => 'VIT007',
                'name' => 'Vitamin D3 1000IU',
                'description' => 'Vitamin D untuk kesehatan tulang dan sistem imun',
                'category' => 'Vitamin',
                'price' => 18000,
                'stock_quantity' => 150,
                'min_stock_level' => 15,
                'is_active' => true,
            ],
            [
                'code' => 'VIT008',
                'name' => 'Vitamin B Complex',
                'description' => 'Kombinasi vitamin B untuk energi dan metabolisme',
                'category' => 'Vitamin',
                'price' => 22000,
                'stock_quantity' => 80,
                'min_stock_level' => 10,
                'is_active' => true,
            ],
            
            // Suplemen
            [
                'code' => 'CAL009',
                'name' => 'Calcium Carbonate 500mg',
                'description' => 'Suplemen kalsium untuk kesehatan tulang dan gigi',
                'category' => 'Suplemen',
                'price' => 25000,
                'stock_quantity' => 60,
                'min_stock_level' => 10,
                'is_active' => true,
            ],
            [
                'code' => 'MAG010',
                'name' => 'Magnesium 250mg',
                'description' => 'Suplemen magnesium untuk fungsi otot dan saraf',
                'category' => 'Suplemen',
                'price' => 30000,
                'stock_quantity' => 40,
                'min_stock_level' => 5,
                'is_active' => true,
            ],
            [
                'code' => 'ZIN011',
                'name' => 'Zinc 50mg',
                'description' => 'Suplemen zinc untuk sistem imun dan penyembuhan luka',
                'category' => 'Suplemen',
                'price' => 35000,
                'stock_quantity' => 35,
                'min_stock_level' => 5,
                'is_active' => true,
            ],
            
            // Obat Batuk & Flu
            [
                'code' => 'COU012',
                'name' => 'Dextromethorphan 15mg',
                'description' => 'Obat batuk kering untuk meredakan batuk',
                'category' => 'Batuk & Flu',
                'price' => 8000,
                'stock_quantity' => 90,
                'min_stock_level' => 10,
                'is_active' => true,
            ],
            [
                'code' => 'FLU013',
                'name' => 'Pseudoephedrine 30mg',
                'description' => 'Obat dekongestan untuk hidung tersumbat',
                'category' => 'Batuk & Flu',
                'price' => 10000,
                'stock_quantity' => 70,
                'min_stock_level' => 10,
                'is_active' => true,
            ],
            
            // Obat Lambung
            [
                'code' => 'ANT014',
                'name' => 'Antasida 500mg',
                'description' => 'Obat untuk meredakan asam lambung',
                'category' => 'Obat Lambung',
                'price' => 5000,
                'stock_quantity' => 110,
                'min_stock_level' => 15,
                'is_active' => true,
            ],
            [
                'code' => 'RAN015',
                'name' => 'Ranitidine 150mg',
                'description' => 'Obat untuk tukak lambung dan asam lambung',
                'category' => 'Obat Lambung',
                'price' => 12000,
                'stock_quantity' => 65,
                'min_stock_level' => 10,
                'is_active' => true,
            ],
            
            // Obat Kulit
            [
                'code' => 'BET016',
                'name' => 'Betadine 10%',
                'description' => 'Antiseptik untuk luka dan infeksi kulit',
                'category' => 'Obat Kulit',
                'price' => 15000,
                'stock_quantity' => 45,
                'min_stock_level' => 5,
                'is_active' => true,
            ],
            [
                'code' => 'HYD017',
                'name' => 'Hydrocortisone 1%',
                'description' => 'Krim steroid untuk gatal dan peradangan kulit',
                'category' => 'Obat Kulit',
                'price' => 20000,
                'stock_quantity' => 30,
                'min_stock_level' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($medicines as $medicine) {
            Medicine::create($medicine);
        }
    }
} 