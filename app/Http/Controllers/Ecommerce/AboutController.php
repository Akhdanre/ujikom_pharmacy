<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\BaseController;

class AboutController extends BaseController {
    public function index() {
        // Data dummy untuk hero section
        $heroData = [
            'title' => 'Tentang Kami',
            'subtitle' => 'Apotek Online Terpercaya untuk Kesehatan Keluarga Anda',
            'description' => 'Kami berkomitmen untuk menyediakan produk kesehatan berkualitas dengan pelayanan terbaik untuk memenuhi kebutuhan kesehatan masyarakat Indonesia.',
            'image' => '/images/about/hero-about.jpg'
        ];

        // Data dummy untuk company overview
        $companyOverview = [
            'name' => 'DrigSell',
            'founded' => '2020',
            'mission' => 'Menyediakan akses mudah dan aman terhadap produk kesehatan berkualitas untuk seluruh masyarakat Indonesia.',
            'vision' => 'Menjadi platform apotek online terdepan yang dipercaya dalam memenuhi kebutuhan kesehatan masyarakat.',
            'description' => 'DrigSell didirikan dengan visi untuk memudahkan masyarakat dalam mengakses produk kesehatan berkualitas. Kami bekerja sama dengan berbagai produsen farmasi terkemuka untuk memastikan setiap produk yang kami jual memenuhi standar kualitas tertinggi.'
        ];

        // Data dummy untuk company stats
        $companyStats = [
            [
                'number' => '15.000+',
                'label' => 'Pelanggan Puas',
                'icon' => 'users'
            ],
            [
                'number' => '500+',
                'label' => 'Produk Kesehatan',
                'icon' => 'package'
            ],
            [
                'number' => '25.000+',
                'label' => 'Pesanan Berhasil',
                'icon' => 'shopping-cart'
            ],
            [
                'number' => '98%',
                'label' => 'Tingkat Kepuasan',
                'icon' => 'star'
            ]
        ];

        // Data dummy untuk values
        $values = [
            [
                'title' => 'Kualitas Terjamin',
                'description' => 'Setiap produk yang kami jual telah melalui proses verifikasi kualitas yang ketat untuk memastikan keamanan dan efektivitas.',
                'icon' => 'shield-check'
            ],
            [
                'title' => 'Pelayanan Cepat',
                'description' => 'Kami berkomitmen untuk memberikan pelayanan yang cepat dan responsif kepada setiap pelanggan.',
                'icon' => 'clock'
            ],
            [
                'title' => 'Harga Terjangkau',
                'description' => 'Kami menawarkan produk kesehatan berkualitas dengan harga yang kompetitif dan terjangkau.',
                'icon' => 'tag'
            ],
            [
                'title' => 'Konsultasi Gratis',
                'description' => 'Tim farmasi kami siap memberikan konsultasi gratis untuk membantu Anda memilih produk yang tepat.',
                'icon' => 'message-circle'
            ]
        ];

        // Data dummy untuk team
        $team = [
            [
                'name' => 'Dr. Sarah Johnson',
                'position' => 'CEO & Founder',
                'image' => '/images/team/sarah-johnson.jpg',
                'bio' => 'Dokter dengan pengalaman 15 tahun di bidang farmasi dan kesehatan.',
                'linkedin' => 'https://linkedin.com/in/sarah-johnson',
                'email' => 'sarah@apoteksehat.com'
            ],
            [
                'name' => 'Budi Santoso, S.Farm',
                'position' => 'Head of Pharmacy',
                'image' => '/images/team/budi-santoso.jpg',
                'bio' => 'Apoteker berpengalaman dengan fokus pada keamanan dan kualitas produk.',
                'linkedin' => 'https://linkedin.com/in/budi-santoso',
                'email' => 'budi@apoteksehat.com'
            ],
            [
                'name' => 'Diana Putri',
                'position' => 'Head of Operations',
                'image' => '/images/team/diana-putri.jpg',
                'bio' => 'Spesialis operasional dengan pengalaman 10 tahun di e-commerce.',
                'linkedin' => 'https://linkedin.com/in/diana-putri',
                'email' => 'diana@apoteksehat.com'
            ],
            [
                'name' => 'Ahmad Rizki',
                'position' => 'Head of Technology',
                'image' => '/images/team/ahmad-rizki.jpg',
                'bio' => 'Teknolog dengan fokus pada pengembangan platform yang aman dan user-friendly.',
                'linkedin' => 'https://linkedin.com/in/ahmad-rizki',
                'email' => 'ahmad@apoteksehat.com'
            ]
        ];

        // Data dummy untuk milestones
        $milestones = [
            [
                'year' => '2020',
                'title' => 'Pendirian Perusahaan',
                'description' => 'DrigSell didirikan dengan visi untuk memudahkan akses produk kesehatan.'
            ],
            [
                'year' => '2021',
                'title' => 'Peluncuran Platform',
                'description' => 'Platform e-commerce resmi diluncurkan dengan 100 produk kesehatan.'
            ],
            [
                'year' => '2022',
                'title' => 'Ekspansi Produk',
                'description' => 'Menambah 300+ produk baru dan memperluas jangkauan pengiriman.'
            ],
            [
                'year' => '2023',
                'title' => 'Pencapaian 10.000 Pelanggan',
                'description' => 'Berhasil melayani lebih dari 10.000 pelanggan dengan tingkat kepuasan tinggi.'
            ],
            [
                'year' => '2024',
                'title' => 'Inovasi Teknologi',
                'description' => 'Meluncurkan fitur konsultasi online dan sistem rekomendasi produk AI.'
            ]
        ];

        // Data dummy untuk certifications
        $certifications = [
            [
                'name' => 'ISO 9001:2015',
                'description' => 'Sistem Manajemen Mutu',
                'image' => '/images/certifications/iso-9001.png',
                'year' => '2023'
            ],
            [
                'name' => 'BPOM',
                'description' => 'Badan Pengawas Obat dan Makanan',
                'image' => '/images/certifications/bpom.png',
                'year' => '2022'
            ],
            [
                'name' => 'Halal',
                'description' => 'Sertifikasi Halal MUI',
                'image' => '/images/certifications/halal.png',
                'year' => '2023'
            ],
            [
                'name' => 'ISO 27001',
                'description' => 'Sistem Manajemen Keamanan Informasi',
                'image' => '/images/certifications/iso-27001.png',
                'year' => '2024'
            ]
        ];

        // Data dummy untuk testimonials
        $testimonials = [
            [
                'name' => 'Maya Sari',
                'position' => 'Ibu Rumah Tangga',
                'comment' => 'Sangat puas dengan pelayanan DrigSell. Produk berkualitas dan pengiriman cepat.',
                'rating' => 5,
                'image' => '/images/testimonials/maya-sari.jpg'
            ],
            [
                'name' => 'Rudi Hermawan',
                'position' => 'Karyawan Swasta',
                'comment' => 'Harga terjangkau dan produk original. Sudah menjadi pelanggan setia sejak 2021.',
                'rating' => 5,
                'image' => '/images/testimonials/rudi-hermawan.jpg'
            ],
            [
                'name' => 'Siti Nurhaliza',
                'position' => 'Mahasiswa',
                'comment' => 'Konsultasi gratis sangat membantu. Tim farmasi sangat ramah dan informatif.',
                'rating' => 5,
                'image' => '/images/testimonials/siti-nurhaliza.jpg'
            ]
        ];

        // Data dummy untuk breadcrumb
        $breadcrumb = [
            ['name' => 'Home', 'url' => '/ecommerce/home'],
            ['name' => 'About', 'url' => '#', 'active' => true]
        ];

        return view('pages.ecommerce.about', compact(
            'heroData',
            'companyOverview',
            'companyStats',
            'values',
            'team',
            'milestones',
            'certifications',
            'testimonials',
            'breadcrumb'
        ));
    }
}
