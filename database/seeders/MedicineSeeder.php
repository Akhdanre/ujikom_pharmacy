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
                'name' => 'Paracetamol 500mg',
                'medicine_name' => 'Paracetamol 500mg',
                'description' => 'Obat pereda nyeri dan demam yang aman untuk semua usia',
                'price' => 5000,
                'stock' => 100,
                'expired_at' => now()->addMonths(12), // 1 tahun dari sekarang
            ],
            [
                'name' => 'Ibuprofen 400mg',
                'medicine_name' => 'Ibuprofen 400mg',
                'description' => 'Obat anti inflamasi non steroid untuk nyeri dan peradangan',
                'price' => 8000,
                'stock' => 75,
                'expired_at' => now()->addDays(15), // Akan kadaluarsa dalam 15 hari
            ],
            [
                'name' => 'Aspirin 100mg',
                'medicine_name' => 'Aspirin 100mg',
                'description' => 'Obat pengencer darah dan pereda nyeri',
                'price' => 3000,
                'stock' => 120,
                'expired_at' => now()->subDays(5), // Sudah kadaluarsa 5 hari yang lalu
            ],
            
            // Antibiotik
            [
                'name' => 'Amoxicillin 500mg',
                'medicine_name' => 'Amoxicillin 500mg',
                'description' => 'Antibiotik untuk infeksi bakteri ringan hingga sedang',
                'price' => 15000,
                'stock' => 50,
                'expired_at' => now()->addDays(25), // Akan kadaluarsa dalam 25 hari
            ],
            [
                'name' => 'Ciprofloxacin 500mg',
                'medicine_name' => 'Ciprofloxacin 500mg',
                'description' => 'Antibiotik untuk infeksi saluran kemih',
                'price' => 25000,
                'stock' => 30,
                'expired_at' => now()->addMonths(6), // 6 bulan dari sekarang
            ],
            
            // Vitamin
            [
                'name' => 'Vitamin C 1000mg',
                'medicine_name' => 'Vitamin C 1000mg',
                'description' => 'Suplemen vitamin C untuk meningkatkan daya tahan tubuh',
                'price' => 12000,
                'stock' => 200,
            ],
            [
                'name' => 'Vitamin D3 1000IU',
                'medicine_name' => 'Vitamin D3 1000IU',
                'description' => 'Vitamin D untuk kesehatan tulang dan sistem imun',
                'price' => 18000,
                'stock' => 150,
            ],
            [
                'name' => 'Vitamin B Complex',
                'medicine_name' => 'Vitamin B Complex',
                'description' => 'Kombinasi vitamin B untuk energi dan metabolisme',
                'price' => 22000,
                'stock' => 80,
            ],
            
            // Antasida
            [
                'name' => 'Antasida Tablet',
                'medicine_name' => 'Antasida Tablet',
                'description' => 'Obat untuk mengatasi asam lambung dan maag',
                'price' => 5000,
                'stock' => 90,
            ],
            [
                'name' => 'Ranitidine 150mg',
                'medicine_name' => 'Ranitidine 150mg',
                'description' => 'Obat untuk mengurangi produksi asam lambung',
                'price' => 10000,
                'stock' => 60,
            ],
            
            // Antihistamin
            [
                'name' => 'Cetirizine 10mg',
                'medicine_name' => 'Cetirizine 10mg',
                'description' => 'Obat anti alergi untuk mengatasi gejala alergi',
                'price' => 8000,
                'stock' => 70,
            ],
            [
                'name' => 'Loratadine 10mg',
                'medicine_name' => 'Loratadine 10mg',
                'description' => 'Antihistamin untuk mengatasi alergi dan rinitis',
                'price' => 12000,
                'stock' => 45,
            ],
            
            // Obat Batuk dan Flu
            [
                'name' => 'Dextromethorphan Syrup',
                'medicine_name' => 'Dextromethorphan Syrup',
                'description' => 'Obat batuk kering untuk meredakan batuk',
                'price' => 15000,
                'stock' => 40,
            ],
            [
                'name' => 'Pseudoephedrine 30mg',
                'medicine_name' => 'Pseudoephedrine 30mg',
                'description' => 'Dekongestan untuk mengatasi hidung tersumbat',
                'price' => 7000,
                'stock' => 85,
            ],
            
            // Obat Diabetes
            [
                'name' => 'Metformin 500mg',
                'medicine_name' => 'Metformin 500mg',
                'description' => 'Obat untuk mengontrol kadar gula darah pada diabetes',
                'price' => 30000,
                'stock' => 25,
            ],
            [
                'name' => 'Glibenclamide 5mg',
                'medicine_name' => 'Glibenclamide 5mg',
                'description' => 'Obat antidiabetes untuk menurunkan gula darah',
                'price' => 25000,
                'stock' => 35,
            ],
            
            // Obat Hipertensi
            [
                'name' => 'Amlodipine 5mg',
                'medicine_name' => 'Amlodipine 5mg',
                'description' => 'Obat untuk mengontrol tekanan darah tinggi',
                'price' => 35000,
                'stock' => 20,
            ],
            [
                'name' => 'Captopril 25mg',
                'medicine_name' => 'Captopril 25mg',
                'description' => 'ACE inhibitor untuk mengobati hipertensi',
                'price' => 28000,
                'stock' => 30,
            ],
            
            // Obat Kolesterol
            [
                'name' => 'Simvastatin 20mg',
                'medicine_name' => 'Simvastatin 20mg',
                'description' => 'Statin untuk menurunkan kadar kolesterol',
                'price' => 40000,
                'stock' => 15,
            ],
            [
                'name' => 'Atorvastatin 10mg',
                'medicine_name' => 'Atorvastatin 10mg',
                'description' => 'Obat untuk mengontrol kadar kolesterol darah',
                'price' => 45000,
                'stock' => 18,
            ],
            
            // Obat Asma
            [
                'name' => 'Salbutamol Inhaler',
                'medicine_name' => 'Salbutamol Inhaler',
                'description' => 'Bronkodilator untuk mengatasi serangan asma',
                'price' => 55000,
                'stock' => 12,
            ],
            [
                'name' => 'Budesonide Inhaler',
                'medicine_name' => 'Budesonide Inhaler',
                'description' => 'Kortikosteroid inhalasi untuk asma kronis',
                'price' => 75000,
                'stock' => 8,
            ],
        ];

        foreach ($medicines as $medicine) {
            Medicine::create($medicine);
        }

        $this->command->info('Medicine data seeded successfully!');
    }
} 