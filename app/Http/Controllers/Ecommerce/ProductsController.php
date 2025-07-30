<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class ProductsController extends BaseController {
    public function index(Request $request) {
        // Data dummy untuk filters
        $categories = [
            ['id' => 1, 'name' => 'Obat Bebas', 'count' => 45],
            ['id' => 2, 'name' => 'Obat Keras', 'count' => 23],
            ['id' => 3, 'name' => 'Suplemen', 'count' => 32],
            ['id' => 4, 'name' => 'Alat Kesehatan', 'count' => 28],
            ['id' => 5, 'name' => 'Perawatan Kulit', 'count' => 38],
            ['id' => 6, 'name' => 'Perawatan Rambut', 'count' => 25],
            ['id' => 7, 'name' => 'Perawatan Gigi', 'count' => 18],
            ['id' => 8, 'name' => 'Bayi & Anak', 'count' => 22]
        ];

        $brands = [
            ['id' => 1, 'name' => 'Kimia Farma', 'count' => 15],
            ['id' => 2, 'name' => 'Dexa Medica', 'count' => 12],
            ['id' => 3, 'name' => 'Kalbe Farma', 'count' => 18],
            ['id' => 4, 'name' => 'Sanbe Farma', 'count' => 8],
            ['id' => 5, 'name' => 'Tempo Scan', 'count' => 10],
            ['id' => 6, 'name' => 'Mecosin', 'count' => 6]
        ];

        $priceRanges = [
            ['min' => 0, 'max' => 25000, 'label' => 'Rp 0 - Rp 25.000'],
            ['min' => 25000, 'max' => 50000, 'label' => 'Rp 25.000 - Rp 50.000'],
            ['min' => 50000, 'max' => 100000, 'label' => 'Rp 50.000 - Rp 100.000'],
            ['min' => 100000, 'max' => 250000, 'label' => 'Rp 100.000 - Rp 250.000'],
            ['min' => 250000, 'max' => null, 'label' => 'Rp 250.000+']
        ];

        // Data dummy untuk products (dengan pagination)
        $products = [
            [
                'id' => 1,
                'name' => 'Paracetamol 500mg - 10 Tablet',
                'price' => 15000,
                'original_price' => 20000,
                'discount' => 25,
                'image' => '/images/products/paracetamol.jpg',
                'category' => 'Obat Bebas',
                'brand' => 'Kimia Farma',
                'rating' => 4.5,
                'reviews' => 128,
                'stock' => 50,
                'is_featured' => true
            ],
            [
                'id' => 2,
                'name' => 'Vitamin C 1000mg - 30 Tablet',
                'price' => 45000,
                'original_price' => 50000,
                'discount' => 10,
                'image' => '/images/products/vitamin-c.jpg',
                'category' => 'Suplemen',
                'brand' => 'Dexa Medica',
                'rating' => 4.8,
                'reviews' => 256,
                'stock' => 75,
                'is_featured' => true
            ],
            [
                'id' => 3,
                'name' => 'Masker KN95 - 10 Pcs',
                'price' => 25000,
                'original_price' => 30000,
                'discount' => 17,
                'image' => '/images/products/masker-kn95.jpg',
                'category' => 'Alat Kesehatan',
                'brand' => 'Mecosin',
                'rating' => 4.6,
                'reviews' => 89,
                'stock' => 100,
                'is_featured' => false
            ],
            [
                'id' => 4,
                'name' => 'Thermometer Digital Infrared',
                'price' => 85000,
                'original_price' => 100000,
                'discount' => 15,
                'image' => '/images/products/thermometer.jpg',
                'category' => 'Alat Kesehatan',
                'brand' => 'Tempo Scan',
                'rating' => 4.7,
                'reviews' => 156,
                'stock' => 25,
                'is_featured' => false
            ],
            [
                'id' => 5,
                'name' => 'Amoxicillin 500mg - 10 Kapsul',
                'price' => 35000,
                'original_price' => 40000,
                'discount' => 12,
                'image' => '/images/products/amoxicillin.jpg',
                'category' => 'Obat Keras',
                'brand' => 'Kalbe Farma',
                'rating' => 4.4,
                'reviews' => 67,
                'stock' => 30,
                'is_featured' => false
            ],
            [
                'id' => 6,
                'name' => 'Omega-3 1000mg - 60 Kapsul',
                'price' => 120000,
                'original_price' => 150000,
                'discount' => 20,
                'image' => '/images/products/omega-3.jpg',
                'category' => 'Suplemen',
                'brand' => 'Sanbe Farma',
                'rating' => 4.9,
                'reviews' => 189,
                'stock' => 40,
                'is_featured' => true
            ],
            [
                'id' => 7,
                'name' => 'Face Wash Acne Control',
                'price' => 55000,
                'original_price' => 65000,
                'discount' => 15,
                'image' => '/images/products/face-wash.jpg',
                'category' => 'Perawatan Kulit',
                'brand' => 'Dexa Medica',
                'rating' => 4.3,
                'reviews' => 94,
                'stock' => 60,
                'is_featured' => false
            ],
            [
                'id' => 8,
                'name' => 'Shampoo Anti Dandruff',
                'price' => 35000,
                'original_price' => 40000,
                'discount' => 12,
                'image' => '/images/products/shampoo.jpg',
                'category' => 'Perawatan Rambut',
                'brand' => 'Kimia Farma',
                'rating' => 4.2,
                'reviews' => 78,
                'stock' => 45,
                'is_featured' => false
            ]
        ];

        // Simulasi pagination
        $currentPage = $request->get('page', 1);
        $perPage = 8;
        $totalProducts = count($products);
        $totalPages = ceil($totalProducts / $perPage);

        // Filter berdasarkan request
        $search = $request->get('search');
        $category = $request->get('category');
        $brand = $request->get('brand');
        $minPrice = $request->get('min_price');
        $maxPrice = $request->get('max_price');
        $sort = $request->get('sort', 'newest');

        // Data untuk breadcrumb
        $breadcrumb = [
            ['name' => 'Home', 'url' => '/ecommerce/home'],
            ['name' => 'Products', 'url' => '#', 'active' => true]
        ];

        return view('pages.ecommerce.products', compact(
            'products',
            'categories',
            'brands',
            'priceRanges',
            'currentPage',
            'totalPages',
            'totalProducts',
            'breadcrumb',
            'search',
            'category',
            'brand',
            'minPrice',
            'maxPrice',
            'sort'
        ));
    }
}
