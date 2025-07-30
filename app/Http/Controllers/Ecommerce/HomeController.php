<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends BaseController {
    public function index() {
        // Data dummy untuk hero section
        $heroData = [
            'title' => 'Selamat Datang di Apotek Online Terpercaya',
            'subtitle' => 'Temukan obat-obatan berkualitas dengan harga terbaik',
            'description' => 'Kami menyediakan berbagai macam obat-obatan dan suplemen kesehatan dengan kualitas terjamin dan pelayanan yang cepat.',
            'cta_text' => 'Belanja Sekarang',
            'cta_link' => '/ecommerce/products',
            'image' => '/images/hero-pharmacy.jpg'
        ];

        // Data dummy untuk featured products
        $featuredProducts = [
            [
                'id' => 1,
                'name' => 'Paracetamol 500mg',
                'price' => 15000,
                'original_price' => 20000,
                'discount' => 25,
                'image' => '/images/products/paracetamol.jpg',
                'category' => 'Obat Bebas',
                'rating' => 4.5,
                'reviews' => 128
            ],
            [
                'id' => 2,
                'name' => 'Vitamin C 1000mg',
                'price' => 45000,
                'original_price' => 50000,
                'discount' => 10,
                'image' => '/images/products/vitamin-c.jpg',
                'category' => 'Suplemen',
                'rating' => 4.8,
                'reviews' => 256
            ],
            [
                'id' => 3,
                'name' => 'Masker KN95',
                'price' => 25000,
                'original_price' => 30000,
                'discount' => 17,
                'image' => '/images/products/masker-kn95.jpg',
                'category' => 'Alat Kesehatan',
                'rating' => 4.6,
                'reviews' => 89
            ],
            [
                'id' => 4,
                'name' => 'Thermometer Digital',
                'price' => 85000,
                'original_price' => 100000,
                'discount' => 15,
                'image' => '/images/products/thermometer.jpg',
                'category' => 'Alat Kesehatan',
                'rating' => 4.7,
                'reviews' => 156
            ]
        ];

        // Data dummy untuk categories
        $categories = [
            [
                'id' => 1,
                'name' => 'Obat Bebas',
                'image' => '/images/categories/obat-bebas.jpg',
                'product_count' => 45
            ],
            [
                'id' => 2,
                'name' => 'Suplemen',
                'image' => '/images/categories/suplemen.jpg',
                'product_count' => 32
            ],
            [
                'id' => 3,
                'name' => 'Alat Kesehatan',
                'image' => '/images/categories/alat-kesehatan.jpg',
                'product_count' => 28
            ],
            [
                'id' => 4,
                'name' => 'Perawatan Kulit',
                'image' => '/images/categories/perawatan-kulit.jpg',
                'product_count' => 38
            ]
        ];

        // Data dummy untuk testimonials
        $testimonials = [
            [
                'id' => 1,
                'name' => 'Sarah Johnson',
                'rating' => 5,
                'comment' => 'Pelayanan sangat cepat dan obat yang dikirim berkualitas tinggi. Sangat puas!',
                'avatar' => '/images/testimonials/user1.jpg'
            ],
            [
                'id' => 2,
                'name' => 'Budi Santoso',
                'rating' => 5,
                'comment' => 'Harga terjangkau dan pengiriman tepat waktu. Recommended!',
                'avatar' => '/images/testimonials/user2.jpg'
            ],
            [
                'id' => 3,
                'name' => 'Diana Putri',
                'rating' => 4,
                'comment' => 'Customer service sangat ramah dan membantu. Terima kasih!',
                'avatar' => '/images/testimonials/user3.jpg'
            ]
        ];

        // Data dummy untuk stats
        $stats = [
            'customers' => 15000,
            'products' => 500,
            'orders' => 25000,
            'satisfaction' => 98
        ];

        return view('pages.ecommerce.home', compact(
            'heroData',
            'featuredProducts',
            'categories',
            'testimonials',
            'stats'
        ));
    }
}
