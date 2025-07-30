<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class SearchController extends BaseController {
    public function index(Request $request) {
        $query = $request->get('q', '');
        $category = $request->get('category');
        $brand = $request->get('brand');
        $minPrice = $request->get('min_price');
        $maxPrice = $request->get('max_price');
        $sort = $request->get('sort', 'relevance');

        // Data dummy untuk search results
        $searchResults = [
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
                'is_featured' => true,
                'highlight' => 'Paracetamol <strong>500mg</strong> untuk meredakan demam dan nyeri'
            ],
            [
                'id' => 2,
                'name' => 'Paracetamol 650mg - 10 Tablet',
                'price' => 18000,
                'original_price' => 22000,
                'discount' => 18,
                'image' => '/images/products/paracetamol-650.jpg',
                'category' => 'Obat Bebas',
                'brand' => 'Dexa Medica',
                'rating' => 4.3,
                'reviews' => 95,
                'stock' => 35,
                'is_featured' => false,
                'highlight' => 'Paracetamol <strong>650mg</strong> dengan dosis lebih tinggi'
            ],
            [
                'id' => 3,
                'name' => 'Paracetamol Sirup 120ml',
                'price' => 25000,
                'original_price' => 30000,
                'discount' => 17,
                'image' => '/images/products/paracetamol-sirup.jpg',
                'category' => 'Obat Bebas',
                'brand' => 'Kalbe Farma',
                'rating' => 4.6,
                'reviews' => 78,
                'stock' => 20,
                'is_featured' => false,
                'highlight' => 'Paracetamol <strong>sirup</strong> untuk anak-anak'
            ],
            [
                'id' => 4,
                'name' => 'Ibuprofen 400mg - 10 Tablet',
                'price' => 18000,
                'original_price' => 22000,
                'discount' => 18,
                'image' => '/images/products/ibuprofen.jpg',
                'category' => 'Obat Bebas',
                'brand' => 'Kimia Farma',
                'rating' => 4.3,
                'reviews' => 95,
                'stock' => 45,
                'is_featured' => false,
                'highlight' => 'Ibuprofen <strong>400mg</strong> untuk anti inflamasi'
            ],
            [
                'id' => 5,
                'name' => 'Asam Mefenamat 500mg - 10 Tablet',
                'price' => 22000,
                'original_price' => 28000,
                'discount' => 21,
                'image' => '/images/products/asam-mefenamat.jpg',
                'category' => 'Obat Keras',
                'brand' => 'Dexa Medica',
                'rating' => 4.1,
                'reviews' => 67,
                'stock' => 30,
                'is_featured' => false,
                'highlight' => 'Asam Mefenamat <strong>500mg</strong> untuk nyeri'
            ]
        ];

        // Data dummy untuk filters
        $categories = [
            ['id' => 1, 'name' => 'Obat Bebas', 'count' => 45],
            ['id' => 2, 'name' => 'Obat Keras', 'count' => 23],
            ['id' => 3, 'name' => 'Suplemen', 'count' => 32],
            ['id' => 4, 'name' => 'Alat Kesehatan', 'count' => 28],
            ['id' => 5, 'name' => 'Perawatan Kulit', 'count' => 38]
        ];

        $brands = [
            ['id' => 1, 'name' => 'Kimia Farma', 'count' => 15],
            ['id' => 2, 'name' => 'Dexa Medica', 'count' => 12],
            ['id' => 3, 'name' => 'Kalbe Farma', 'count' => 18],
            ['id' => 4, 'name' => 'Sanbe Farma', 'count' => 8],
            ['id' => 5, 'name' => 'Tempo Scan', 'count' => 10]
        ];

        $priceRanges = [
            ['min' => 0, 'max' => 25000, 'label' => 'Rp 0 - Rp 25.000'],
            ['min' => 25000, 'max' => 50000, 'label' => 'Rp 25.000 - Rp 50.000'],
            ['min' => 50000, 'max' => 100000, 'label' => 'Rp 50.000 - Rp 100.000'],
            ['min' => 100000, 'max' => 250000, 'label' => 'Rp 100.000 - Rp 250.000'],
            ['min' => 250000, 'max' => null, 'label' => 'Rp 250.000+']
        ];

        // Data dummy untuk search suggestions
        $searchSuggestions = [
            'paracetamol 500mg',
            'paracetamol sirup',
            'paracetamol anak',
            'obat demam',
            'obat sakit kepala',
            'ibuprofen',
            'asam mefenamat'
        ];

        // Data dummy untuk popular searches
        $popularSearches = [
            'vitamin c',
            'masker kn95',
            'thermometer digital',
            'omega 3',
            'face wash',
            'shampoo anti dandruff',
            'sabun mandi'
        ];

        // Data dummy untuk search stats
        $searchStats = [
            'total_results' => 5,
            'search_time' => 0.15,
            'suggestions_count' => 7
        ];

        // Data dummy untuk breadcrumb
        $breadcrumb = [
            ['name' => 'Home', 'url' => '/ecommerce/home'],
            ['name' => 'Search', 'url' => '#', 'active' => true]
        ];

        // Simulasi pagination
        $currentPage = $request->get('page', 1);
        $perPage = 10;
        $totalResults = count($searchResults);
        $totalPages = ceil($totalResults / $perPage);

        return view('pages.ecommerce.search', compact(
            'query',
            'searchResults',
            'categories',
            'brands',
            'priceRanges',
            'searchSuggestions',
            'popularSearches',
            'searchStats',
            'breadcrumb',
            'currentPage',
            'totalPages',
            'totalResults',
            'category',
            'brand',
            'minPrice',
            'maxPrice',
            'sort'
        ));
    }

    public function suggestions(Request $request) {
        $query = $request->get('q', '');

        // Data dummy untuk autocomplete suggestions
        $suggestions = [
            [
                'type' => 'product',
                'id' => 1,
                'name' => 'Paracetamol 500mg - 10 Tablet',
                'price' => 15000,
                'image' => '/images/products/paracetamol.jpg',
                'category' => 'Obat Bebas'
            ],
            [
                'type' => 'product',
                'id' => 2,
                'name' => 'Paracetamol 650mg - 10 Tablet',
                'price' => 18000,
                'image' => '/images/products/paracetamol-650.jpg',
                'category' => 'Obat Bebas'
            ],
            [
                'type' => 'product',
                'id' => 3,
                'name' => 'Paracetamol Sirup 120ml',
                'price' => 25000,
                'image' => '/images/products/paracetamol-sirup.jpg',
                'category' => 'Obat Bebas'
            ],
            [
                'type' => 'category',
                'id' => 1,
                'name' => 'Obat Bebas',
                'product_count' => 45
            ],
            [
                'type' => 'brand',
                'id' => 1,
                'name' => 'Kimia Farma',
                'product_count' => 15
            ]
        ];

        return response()->json([
            'suggestions' => $suggestions,
            'query' => $query
        ]);
    }
}
