<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\BaseController;

use Illuminate\Http\Request;

class ContactController extends BaseController {
    public function index() {
        // Data dummy untuk hero section
        $heroData = [
            'title' => 'Hubungi Kami',
            'subtitle' => 'Kami Siap Membantu Anda',
            'description' => 'Tim customer service kami siap membantu Anda dengan pertanyaan, keluhan, atau saran terkait produk dan layanan kami.',
            'image' => '/images/contact/hero-contact.jpg'
        ];

        // Data dummy untuk contact information
        $contactInfo = [
            'address' => [
                'title' => 'Alamat Kantor',
                'content' => 'Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta 12345',
                'icon' => 'map-pin'
            ],
            'phone' => [
                'title' => 'Telepon',
                'content' => '+62 21 1234 5678',
                'icon' => 'phone'
            ],
            'email' => [
                'title' => 'Email',
                'content' => 'info@apoteksehat.com',
                'icon' => 'mail'
            ],
            'whatsapp' => [
                'title' => 'WhatsApp',
                'content' => '+62 812 3456 7890',
                'icon' => 'message-circle'
            ]
        ];

        // Data dummy untuk business hours
        $businessHours = [
            [
                'day' => 'Senin - Jumat',
                'hours' => '08:00 - 21:00 WIB'
            ],
            [
                'day' => 'Sabtu',
                'hours' => '08:00 - 18:00 WIB'
            ],
            [
                'day' => 'Minggu',
                'hours' => '09:00 - 17:00 WIB'
            ],
            [
                'day' => 'Hari Libur Nasional',
                'hours' => '09:00 - 16:00 WIB'
            ]
        ];

        // Data dummy untuk departments
        $departments = [
            [
                'name' => 'Customer Service',
                'description' => 'Untuk pertanyaan umum, keluhan, dan bantuan teknis',
                'email' => 'cs@apoteksehat.com',
                'phone' => '+62 21 1234 5678 ext. 1',
                'response_time' => '1-2 jam kerja'
            ],
            [
                'name' => 'Konsultasi Farmasi',
                'description' => 'Untuk konsultasi obat dan produk kesehatan',
                'email' => 'pharmacy@apoteksehat.com',
                'phone' => '+62 21 1234 5678 ext. 2',
                'response_time' => '2-4 jam kerja'
            ],
            [
                'name' => 'Pengiriman & Logistik',
                'description' => 'Untuk pertanyaan terkait pengiriman dan tracking',
                'email' => 'logistics@apoteksehat.com',
                'phone' => '+62 21 1234 5678 ext. 3',
                'response_time' => '1-3 jam kerja'
            ],
            [
                'name' => 'Kerjasama & Partnership',
                'description' => 'Untuk kerjasama bisnis dan partnership',
                'email' => 'partnership@apoteksehat.com',
                'phone' => '+62 21 1234 5678 ext. 4',
                'response_time' => '24-48 jam kerja'
            ]
        ];

        // Data dummy untuk FAQ
        $faqs = [
            [
                'question' => 'Bagaimana cara memesan produk di DrigSell?',
                'answer' => 'Anda dapat memesan produk dengan cara: 1) Pilih produk yang diinginkan, 2) Tambahkan ke keranjang, 3) Isi data pengiriman, 4) Pilih metode pembayaran, 5) Konfirmasi pesanan.'
            ],
            [
                'question' => 'Apakah produk yang dijual original dan berkualitas?',
                'answer' => 'Ya, semua produk yang kami jual adalah original dan telah melalui proses verifikasi kualitas yang ketat. Kami bekerja sama dengan distributor resmi dan produsen farmasi terkemuka.'
            ],
            [
                'question' => 'Berapa lama waktu pengiriman?',
                'answer' => 'Waktu pengiriman bervariasi tergantung lokasi dan metode pengiriman yang dipilih: Regular (3-5 hari), Express (1-2 hari), Same Day (hari yang sama untuk Jakarta).'
            ],
            [
                'question' => 'Apakah ada garansi untuk produk yang dibeli?',
                'answer' => 'Ya, kami memberikan garansi 100% untuk produk yang rusak atau tidak sesuai pesanan. Produk dapat dikembalikan dalam waktu 7 hari setelah diterima.'
            ],
            [
                'question' => 'Bagaimana cara konsultasi dengan apoteker?',
                'answer' => 'Anda dapat berkonsultasi dengan apoteker kami melalui chat online, WhatsApp, atau telepon. Konsultasi tersedia setiap hari selama jam operasional.'
            ],
            [
                'question' => 'Apakah ada minimum pembelian?',
                'answer' => 'Tidak ada minimum pembelian untuk produk. Namun, untuk mendapatkan gratis ongkir, minimum pembelian adalah Rp 200.000.'
            ]
        ];

        // Data dummy untuk social media
        $socialMedia = [
            [
                'platform' => 'Facebook',
                'url' => 'https://facebook.com/apoteksehat',
                'icon' => 'facebook',
                'username' => '@apoteksehat'
            ],
            [
                'platform' => 'Instagram',
                'url' => 'https://instagram.com/apoteksehat',
                'icon' => 'instagram',
                'username' => '@apoteksehat'
            ],
            [
                'platform' => 'Twitter',
                'url' => 'https://twitter.com/apoteksehat',
                'icon' => 'twitter',
                'username' => '@apoteksehat'
            ],
            [
                'platform' => 'YouTube',
                'url' => 'https://youtube.com/apoteksehat',
                'icon' => 'youtube',
                'username' => 'Apotek Sehat'
            ],
            [
                'platform' => 'LinkedIn',
                'url' => 'https://linkedin.com/company/apoteksehat',
                'icon' => 'linkedin',
                'username' => 'DrigSell'
            ]
        ];

        // Data dummy untuk map coordinates
        $mapData = [
            'latitude' => -6.2088,
            'longitude' => 106.8456,
            'zoom' => 15,
            'title' => 'DrigSell - Kantor Pusat'
        ];

        // Data dummy untuk breadcrumb
        $breadcrumb = [
            ['name' => 'Home', 'url' => '/ecommerce/home'],
            ['name' => 'Contact', 'url' => '#', 'active' => true]
        ];

        return view('pages.ecommerce.contact', compact(
            'heroData',
            'contactInfo',
            'businessHours',
            'departments',
            'faqs',
            'socialMedia',
            'mapData',
            'breadcrumb'
        ));
    }

    public function sendMessage(Request $request) {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'department' => 'required|string|max:100'
        ]);

        // Simulasi pengiriman pesan
        $messageData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
            'department' => $request->input('department'),
            'created_at' => now()
        ];

        // Response dummy
        return response()->json([
            'success' => true,
            'message' => 'Pesan Anda telah berhasil dikirim. Tim kami akan segera menghubungi Anda.',
            'ticket_number' => 'TKT-' . date('Ymd') . '-' . rand(1000, 9999)
        ]);
    }

    public function subscribeNewsletter(Request $request) {
        // Validasi email
        $request->validate([
            'email' => 'required|email|max:255'
        ]);

        // Simulasi subscribe newsletter
        return response()->json([
            'success' => true,
            'message' => 'Terima kasih telah berlangganan newsletter kami!'
        ]);
    }
}
