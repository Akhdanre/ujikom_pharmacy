<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\BaseController;

class ProductDetailController extends BaseController {
    public function show($id) {
        // Data dummy untuk product detail
        $product = [
            'id' => $id,
            'name' => 'Paracetamol 500mg - 10 Tablet',
            'price' => 15000,
            'original_price' => 20000,
            'discount' => 25,
            'images' => [
                '/images/products/paracetamol-1.jpg',
                '/images/products/paracetamol-2.jpg',
                '/images/products/paracetamol-3.jpg',
                '/images/products/paracetamol-4.jpg'
            ],
            'category' => 'Obat Bebas',
            'brand' => 'Kimia Farma',
            'rating' => 4.5,
            'reviews' => 128,
            'stock' => 50,
            'sku' => 'PAR-500-10T',
            'weight' => '50 gram',
            'dimensions' => '8 x 5 x 2 cm',
            'description' => 'Paracetamol 500mg adalah obat untuk meredakan demam dan nyeri ringan hingga sedang seperti sakit kepala, sakit gigi, dan nyeri otot.',
            'indications' => [
                'Meredakan demam',
                'Mengatasi sakit kepala',
                'Mengurangi nyeri otot',
                'Meredakan sakit gigi'
            ],
            'dosage' => [
                'Dewasa: 1-2 tablet setiap 4-6 jam',
                'Anak-anak: Sesuai petunjuk dokter',
                'Maksimal 8 tablet per hari'
            ],
            'side_effects' => [
                'Mual ringan',
                'Sakit perut',
                'Reaksi alergi (jarang)'
            ],
            'warnings' => [
                'Jangan dikonsumsi lebih dari dosis yang dianjurkan',
                'Konsultasikan dengan dokter jika gejala berlanjut',
                'Simpan di tempat kering dan sejuk'
            ],
            'expiry_date' => '2026-12-31',
            'manufacturer' => 'PT Kimia Farma Tbk',
            'is_prescription' => false,
            'is_featured' => true
        ];

        // Data dummy untuk reviews
        $reviews = [
            [
                'id' => 1,
                'user_name' => 'Sarah Johnson',
                'rating' => 5,
                'date' => '2024-01-15',
                'comment' => 'Obat ini sangat efektif untuk meredakan sakit kepala. Harganya juga terjangkau.',
                'verified_purchase' => true,
                'helpful' => 12
            ],
            [
                'id' => 2,
                'user_name' => 'Budi Santoso',
                'rating' => 4,
                'date' => '2024-01-10',
                'comment' => 'Pengiriman cepat dan obat berkualitas. Sudah beberapa kali beli di sini.',
                'verified_purchase' => true,
                'helpful' => 8
            ],
            [
                'id' => 3,
                'user_name' => 'Diana Putri',
                'rating' => 5,
                'date' => '2024-01-08',
                'comment' => 'Sangat membantu untuk meredakan demam anak saya. Recommended!',
                'verified_purchase' => true,
                'helpful' => 15
            ],
            [
                'id' => 4,
                'user_name' => 'Ahmad Rizki',
                'rating' => 4,
                'date' => '2024-01-05',
                'comment' => 'Obat original dan harga bersaing. Pelayanan customer service juga bagus.',
                'verified_purchase' => true,
                'helpful' => 6
            ],
            [
                'id' => 5,
                'user_name' => 'Maya Sari',
                'rating' => 5,
                'date' => '2024-01-03',
                'comment' => 'Pengalaman belanja yang menyenangkan. Obat sampai dengan kondisi baik.',
                'verified_purchase' => true,
                'helpful' => 9
            ]
        ];

        // Data dummy untuk related products
        $relatedProducts = [
            [
                'id' => 2,
                'name' => 'Ibuprofen 400mg - 10 Tablet',
                'price' => 18000,
                'original_price' => 22000,
                'discount' => 18,
                'image' => '/images/products/ibuprofen.jpg',
                'rating' => 4.3,
                'reviews' => 95
            ],
            [
                'id' => 3,
                'name' => 'Asam Mefenamat 500mg - 10 Tablet',
                'price' => 22000,
                'original_price' => 28000,
                'discount' => 21,
                'image' => '/images/products/asam-mefenamat.jpg',
                'rating' => 4.1,
                'reviews' => 67
            ],
            [
                'id' => 4,
                'name' => 'Antasida 10 Tablet',
                'price' => 12000,
                'original_price' => 15000,
                'discount' => 20,
                'image' => '/images/products/antasida.jpg',
                'rating' => 4.4,
                'reviews' => 112
            ],
            [
                'id' => 5,
                'name' => 'Vitamin C 500mg - 30 Tablet',
                'price' => 35000,
                'original_price' => 40000,
                'discount' => 12,
                'image' => '/images/products/vitamin-c-500.jpg',
                'rating' => 4.6,
                'reviews' => 189
            ]
        ];

        // Data dummy untuk breadcrumb
        $breadcrumb = [
            ['name' => 'Home', 'url' => '/ecommerce/home'],
            ['name' => 'Products', 'url' => '/ecommerce/products'],
            ['name' => 'Obat Bebas', 'url' => '/ecommerce/products?category=1'],
            ['name' => $product['name'], 'url' => '#', 'active' => true]
        ];

        // Data dummy untuk rating summary
        $ratingSummary = [
            'average' => 4.5,
            'total_reviews' => 128,
            'distribution' => [
                5 => 85,
                4 => 25,
                3 => 12,
                2 => 4,
                1 => 2
            ]
        ];

        return view('pages.ecommerce.product-detail', compact(
            'product',
            'reviews',
            'relatedProducts',
            'breadcrumb',
            'ratingSummary'
        ));
    }
}
