<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class CartController extends BaseController {
    public function index() {
        // Data dummy untuk cart items
        $cartItems = [
            [
                'id' => 1,
                'product_id' => 1,
                'name' => 'Paracetamol 500mg - 10 Tablet',
                'price' => 15000,
                'original_price' => 20000,
                'discount' => 25,
                'image' => '/images/products/paracetamol.jpg',
                'quantity' => 2,
                'stock' => 50,
                'subtotal' => 30000,
                'saved_amount' => 10000
            ],
            [
                'id' => 2,
                'product_id' => 2,
                'name' => 'Vitamin C 1000mg - 30 Tablet',
                'price' => 45000,
                'original_price' => 50000,
                'discount' => 10,
                'image' => '/images/products/vitamin-c.jpg',
                'quantity' => 1,
                'stock' => 75,
                'subtotal' => 45000,
                'saved_amount' => 5000
            ],
            [
                'id' => 3,
                'product_id' => 3,
                'name' => 'Masker KN95 - 10 Pcs',
                'price' => 25000,
                'original_price' => 30000,
                'discount' => 17,
                'image' => '/images/products/masker-kn95.jpg',
                'quantity' => 3,
                'stock' => 100,
                'subtotal' => 75000,
                'saved_amount' => 15000
            ]
        ];

        // Data dummy untuk cart summary
        $cartSummary = [
            'subtotal' => 150000,
            'discount' => 30000,
            'shipping' => 15000,
            'tax' => 7500,
            'total' => 142500,
            'saved_total' => 30000
        ];

        // Data dummy untuk shipping options
        $shippingOptions = [
            [
                'id' => 1,
                'name' => 'Regular Delivery',
                'description' => '3-5 hari kerja',
                'price' => 15000,
                'estimated_days' => '3-5 hari kerja'
            ],
            [
                'id' => 2,
                'name' => 'Express Delivery',
                'description' => '1-2 hari kerja',
                'price' => 25000,
                'estimated_days' => '1-2 hari kerja'
            ],
            [
                'id' => 3,
                'name' => 'Same Day Delivery',
                'description' => 'Hari yang sama (Jakarta)',
                'price' => 50000,
                'estimated_days' => 'Hari yang sama'
            ]
        ];

        // Data dummy untuk coupon codes
        $availableCoupons = [
            [
                'code' => 'WELCOME10',
                'description' => 'Diskon 10% untuk pembelian pertama',
                'discount' => '10%',
                'min_purchase' => 100000,
                'max_discount' => 50000
            ],
            [
                'code' => 'HEALTH20',
                'description' => 'Diskon 20% untuk produk kesehatan',
                'discount' => '20%',
                'min_purchase' => 150000,
                'max_discount' => 75000
            ],
            [
                'code' => 'FREESHIP',
                'description' => 'Gratis ongkir untuk pembelian di atas Rp 200.000',
                'discount' => 'Gratis Ongkir',
                'min_purchase' => 200000,
                'max_discount' => 25000
            ]
        ];

        // Data dummy untuk recommended products
        $recommendedProducts = [
            [
                'id' => 4,
                'name' => 'Thermometer Digital Infrared',
                'price' => 85000,
                'original_price' => 100000,
                'discount' => 15,
                'image' => '/images/products/thermometer.jpg',
                'rating' => 4.7,
                'reviews' => 156
            ],
            [
                'id' => 5,
                'name' => 'Amoxicillin 500mg - 10 Kapsul',
                'price' => 35000,
                'original_price' => 40000,
                'discount' => 12,
                'image' => '/images/products/amoxicillin.jpg',
                'rating' => 4.4,
                'reviews' => 67
            ],
            [
                'id' => 6,
                'name' => 'Omega-3 1000mg - 60 Kapsul',
                'price' => 120000,
                'original_price' => 150000,
                'discount' => 20,
                'image' => '/images/products/omega-3.jpg',
                'rating' => 4.9,
                'reviews' => 189
            ],
            [
                'id' => 7,
                'name' => 'Face Wash Acne Control',
                'price' => 55000,
                'original_price' => 65000,
                'discount' => 15,
                'image' => '/images/products/face-wash.jpg',
                'rating' => 4.3,
                'reviews' => 94
            ]
        ];

        // Data dummy untuk breadcrumb
        $breadcrumb = [
            ['name' => 'Home', 'url' => '/ecommerce/home'],
            ['name' => 'Cart', 'url' => '#', 'active' => true]
        ];

        return view('pages.ecommerce.cart', compact(
            'cartItems',
            'cartSummary',
            'shippingOptions',
            'availableCoupons',
            'recommendedProducts',
            'breadcrumb'
        ));
    }

    public function addToCart(Request $request) {
        // Simulasi menambah item ke cart
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        // Response dummy
        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan ke keranjang',
            'cart_count' => 5, // Total item di cart
            'cart_total' => 142500
        ]);
    }

    public function updateQuantity(Request $request) {
        // Simulasi update quantity
        $itemId = $request->input('item_id');
        $quantity = $request->input('quantity');

        return response()->json([
            'success' => true,
            'message' => 'Quantity berhasil diupdate',
            'new_subtotal' => 30000,
            'new_total' => 142500
        ]);
    }

    public function removeItem(Request $request) {
        // Simulasi remove item
        $itemId = $request->input('item_id');

        return response()->json([
            'success' => true,
            'message' => 'Item berhasil dihapus dari keranjang',
            'cart_count' => 4,
            'cart_total' => 112500
        ]);
    }

    public function applyCoupon(Request $request) {
        // Simulasi apply coupon
        $couponCode = $request->input('coupon_code');

        return response()->json([
            'success' => true,
            'message' => 'Kupon berhasil diterapkan',
            'discount_amount' => 15000,
            'new_total' => 127500
        ]);
    }
}
