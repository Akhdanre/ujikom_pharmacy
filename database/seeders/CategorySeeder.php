<?php

namespace Database\Seeders;

use App\Domain\Category\Entities\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'category_name' => 'Analgesik',
                'description' => 'Obat pereda nyeri dan demam',
            ],
            [
                'category_name' => 'Antibiotik',
                'description' => 'Obat untuk mengatasi infeksi bakteri',
            ],
            [
                'category_name' => 'Vitamin',
                'description' => 'Suplemen vitamin dan mineral',
            ],
            [
                'category_name' => 'Antasida',
                'description' => 'Obat untuk masalah pencernaan',
            ],
            [
                'category_name' => 'Antihistamin',
                'description' => 'Obat untuk alergi dan pilek',
            ],
            [
                'category_name' => 'Antihipertensi',
                'description' => 'Obat untuk tekanan darah tinggi',
            ],
            [
                'category_name' => 'Antidiabetik',
                'description' => 'Obat untuk diabetes',
            ],
            [
                'category_name' => 'Kardiovaskular',
                'description' => 'Obat untuk penyakit jantung dan pembuluh darah',
            ],
            [
                'category_name' => 'Respirasi',
                'description' => 'Obat untuk masalah pernapasan',
            ],
            [
                'category_name' => 'Dermatologi',
                'description' => 'Obat untuk masalah kulit',
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }
    }
} 