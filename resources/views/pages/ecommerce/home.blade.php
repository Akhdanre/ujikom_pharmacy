@extends('components.layout.app')

@section('title', 'Produk - DrigSell')

@section('style')
    <style>
        .hero-section {
            background: var(--bg-gradient-primary);
            color: var(--text-inverse);
            padding: 60px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        }

        .category-icon {
            width: 60px;
            height: 60px;
            background: var(--bg-gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: var(--text-inverse);
            font-size: 24px;
        }

        .product-info {
            padding: 15px;
        }

        .banner-section {
            background: var(--bg-gradient-secondary);
            color: var(--text-inverse);
            border-radius: 20px;
            padding: 30px;
            margin: 30px 0;
        }

        .feature-item {
            text-align: center;
            padding: 20px;
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            background: var(--primary-500);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: var(--text-inverse);
            font-size: 20px;
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 40px 0;
            }

            .search-bar {
                max-width: 100%;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
@endsection

@section('content')

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4 animate-fade-in-up">Kesehatan Anda, Prioritas Kami</h1>
                    <p class="lead mb-4 animate-fade-in-up">
                        Temukan berbagai obat, vitamin, dan suplemen berkualitas dengan harga terbaik. Pengiriman cepat dan
                        aman ke seluruh Indonesia.
                    </p>
                    <div class="animate-fade-in-up">
                        <a href="{{ route('ecommerce.products') }}" class="btn btn-light btn-lg me-3">
                            <i class="fas fa-shopping-bag me-2"></i>Belanja Sekarang
                        </a>
                        <a href="{{ route('ecommerce.about') }}" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-info-circle me-2"></i>Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="https://undraw.co/api/illustrations/undraw_medicine_b-1-ol.svg" alt="Ilustrasi Kesehatan"
                        class="img-fluid rounded-3 shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="h1 fw-bold mb-3">Kategori Produk</h2>
                    <p class="lead text-muted">Pilih kategori yang sesuai dengan kebutuhan Anda</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-3 col-6">
                    <div class="category-card text-center">
                        <div
                            class="category-icon bg-primary-500 text-white p-3 rounded-circle mb-2 d-inline-flex justify-content-center align-items-center">
                            <i class="fas fa-pills"></i>
                        </div>
                        <h5 class="fw-bold">Obat Bebas</h5>
                        <p class="text-muted small">Obat yang dapat dibeli tanpa resep</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="category-card text-center">
                        <div
                            class="category-icon bg-primary-500 text-white p-3 rounded-circle mb-2 d-inline-flex justify-content-center align-items-center">
                            <i class="fas fa-prescription-bottle"></i>
                        </div>
                        <h5 class="fw-bold">Obat Keras</h5>
                        <p class="text-muted small">Obat dengan resep dokter</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="category-card text-center">
                        <div
                            class="category-icon bg-primary-500 text-white p-3 rounded-circle mb-2 d-inline-flex justify-content-center align-items-center">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h5 class="fw-bold">Vitamin & Suplemen</h5>
                        <p class="text-muted small">Nutrisi tambahan untuk kesehatan</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="category-card text-center">
                        <div
                            class="category-icon bg-primary-500 text-white p-3 rounded-circle mb-2 d-inline-flex justify-content-center align-items-center">
                            <i class="fas fa-baby"></i>
                        </div>
                        <h5 class="fw-bold">Perawatan Bayi</h5>
                        <p class="text-muted small">Produk khusus untuk bayi dan anak</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="h1 fw-bold mb-3">Produk Unggulan</h2>
                    <p class="lead text-muted">Produk terlaris dan berkualitas tinggi</p>
                </div>
            </div>
            <div class="row g-4">
                @for ($i = 1; $i <= 8; $i++)
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="https://via.placeholder.com/300x200/00BFA6/FFFFFF?text=Obat+{{ $i }}"
                                    alt="Product {{ $i }}">
                                @if ($i <= 3)
                                    <div class="product-badge">Terlaris</div>
                                @endif
                            </div>
                            <div class="product-info">
                                <h6 class="product-title">Obat Sakit Kepala {{ $i }}</h6>
                                <div class="product-price">Rp {{ number_format(rand(5000, 50000), 0, ',', '.') }}</div>
                                <div class="product-rating">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <span class="ms-1 text-muted">({{ rand(10, 100) }})</span>
                                </div>
                                <button class="btn btn-add-cart">
                                    <i class="fas fa-cart-plus me-2"></i>Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('ecommerce.products') }}" class="btn btn-primary btn-lg">Lihat Semua Produk</a>
            </div>
        </div>
    </section>

    <!-- Scripts -->
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        // Add to cart animation
        document.querySelectorAll('.btn-add-cart').forEach(button => {
            button.addEventListener('click', function() {
                this.innerHTML = '<i class="fas fa-check me-2"></i>Ditambahkan';
                this.style.background = '#28a745';
                setTimeout(() => {
                    this.innerHTML = '<i class="fas fa-cart-plus me-2"></i>Tambah ke Keranjang';
                    this.style.background = '';
                }, 2000);
            });
        });

        // Smooth scroll for internal anchors
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
@endsection

@endsection
