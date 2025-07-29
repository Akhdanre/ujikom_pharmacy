<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DrigSell - Toko Obat Online Terpercaya</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    
    <style>
        :root {
            --primary-color: #00BFA6;
            --secondary-color: #FF6B35;
            --accent-color: #FFD93D;
            --text-dark: #2C3E50;
            --text-light: #7F8C8D;
            --bg-light: #F8F9FA;
            --white: #FFFFFF;
            --shadow: 0 2px 10px rgba(0,0,0,0.1);
            --shadow-hover: 0 5px 20px rgba(0,0,0,0.15);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-dark);
        }

        /* Header Styles */
        .top-header {
            background: var(--primary-color);
            color: white;
            padding: 8px 0;
            font-size: 14px;
        }

        .main-header {
            background: white;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .search-bar {
            background: var(--bg-light);
            border: 2px solid var(--primary-color);
            border-radius: 25px;
            padding: 12px 20px;
            width: 100%;
            max-width: 500px;
        }

        .search-bar:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 191, 166, 0.1);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, #00A896 100%);
            color: white;
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

        /* Category Cards */
        .category-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
            border-color: var(--primary-color);
        }

        .category-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), #00A896);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: white;
            font-size: 24px;
        }

        /* Product Cards */
        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            border: 1px solid #E9ECEF;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .product-image {
            height: 200px;
            background: linear-gradient(45deg, #f8f9fa, #e9ecef);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .product-image img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }

        .product-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: var(--secondary-color);
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
        }

        .product-info {
            padding: 15px;
        }

        .product-title {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-dark);
            font-size: 14px;
            line-height: 1.4;
        }

        .product-price {
            font-size: 18px;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .product-rating {
            color: var(--accent-color);
            font-size: 14px;
            margin-bottom: 10px;
        }

        .btn-add-cart {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 25px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-add-cart:hover {
            background: #00A896;
            color: white;
            transform: scale(1.05);
        }

        /* Banner Section */
        .banner-section {
            background: linear-gradient(135deg, var(--secondary-color), #FF8A65);
            color: white;
            border-radius: 20px;
            padding: 30px;
            margin: 30px 0;
        }

        /* Features Section */
        .feature-item {
            text-align: center;
            padding: 20px;
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: white;
            font-size: 20px;
        }

        /* Footer */
        .footer {
            background: var(--text-dark);
            color: white;
            padding: 40px 0 20px;
        }

        .footer h5 {
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .footer a {
            color: #BDC3C7;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: var(--primary-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-section {
                padding: 40px 0;
            }
            
            .search-bar {
                max-width: 100%;
            }
        }

        /* Animation */
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
</head>
<body>
    <!-- Top Header -->
    <div class="top-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <i class="fas fa-phone me-2"></i> Hubungi Kami: 021-1234567
                    <i class="fas fa-envelope ms-3 me-2"></i> info@pharmacare.com
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('login') }}" class="text-white me-3 text-decoration-none">
                        <i class="fas fa-user me-1"></i> Login Admin
                    </a>
                    <a href="{{ route('register') }}" class="text-white text-decoration-none">
                        <i class="fas fa-user-plus me-1"></i> Register
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="main-header">
        <div class="container">
            <div class="row align-items-center py-3">
                <div class="col-md-3">
                    <a href="{{ route('home') }}" class="text-decoration-none">
                        <h2 class="mb-0 text-primary fw-bold">
                            <i class="fas fa-pills me-2"></i>DrigSell
                        </h2>
                    </a>
                </div>
                <div class="col-md-6">
                    <form class="d-flex" action="{{ route('search') }}" method="GET">
                        <input type="text" name="q" class="search-bar" placeholder="Cari obat, vitamin, atau suplemen...">
                        <button type="submit" class="btn btn-primary ms-2" style="border-radius: 25px;">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
                <div class="col-md-3 text-end">
                    <a href="{{ route('cart') }}" class="btn btn-outline-primary position-relative">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4 animate-fade-in-up">
                        Kesehatan Anda, Prioritas Kami
                    </h1>
                    <p class="lead mb-4 animate-fade-in-up">
                        Temukan berbagai obat, vitamin, dan suplemen berkualitas dengan harga terbaik. 
                        Pengiriman cepat dan aman ke seluruh Indonesia.
                    </p>
                    <div class="animate-fade-in-up">
                        <a href="{{ route('products') }}" class="btn btn-light btn-lg me-3">
                            <i class="fas fa-shopping-bag me-2"></i>Belanja Sekarang
                        </a>
                        <a href="{{ route('about') }}" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-info-circle me-2"></i>Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="https://via.placeholder.com/500x400/00BFA6/FFFFFF?text=PharmaCare" 
                         alt="PharmaCare" class="img-fluid rounded-3 shadow">
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
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="fas fa-pills"></i>
                        </div>
                        <h5 class="fw-bold">Obat Bebas</h5>
                        <p class="text-muted small">Obat yang dapat dibeli tanpa resep</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="fas fa-prescription-bottle"></i>
                        </div>
                        <h5 class="fw-bold">Obat Keras</h5>
                        <p class="text-muted small">Obat dengan resep dokter</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h5 class="fw-bold">Vitamin & Suplemen</h5>
                        <p class="text-muted small">Nutrisi tambahan untuk kesehatan</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="category-card">
                        <div class="category-icon">
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
                            <img src="https://via.placeholder.com/300x200/00BFA6/FFFFFF?text=Obat+{{ $i }}" alt="Product {{ $i }}">
                            @if($i <= 3)
                            <div class="product-badge">Terlaris</div>
                            @endif
                        </div>
                        <div class="product-info">
                            <h6 class="product-title">Obat Sakit Kepala {{ $i }}</h6>
                            <div class="product-price">Rp {{ number_format(rand(5000, 50000), 0, ',', '.') }}</div>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
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
                <a href="{{ route('products') }}" class="btn btn-primary btn-lg">
                    Lihat Semua Produk
                </a>
            </div>
        </div>
    </section>

    <!-- Banner Section -->
    <section class="container">
        <div class="banner-section">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 class="fw-bold mb-3">Gratis Ongkir!</h3>
                    <p class="mb-3">Untuk pembelian minimal Rp 100.000 ke seluruh Indonesia</p>
                    <a href="{{ route('products') }}" class="btn btn-light">Belanja Sekarang</a>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-truck fa-3x"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h5>100% Asli</h5>
                        <p class="text-muted">Semua produk dijamin asli dan berkualitas</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <h5>Pengiriman Cepat</h5>
                        <p class="text-muted">Pengiriman dalam 1-3 hari kerja</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-undo"></i>
                        </div>
                        <h5>Garansi 100%</h5>
                        <p class="text-muted">Uang kembali jika produk tidak sesuai</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h5>24/7 Support</h5>
                        <p class="text-muted">Layanan pelanggan siap membantu Anda</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="fas fa-pills me-2"></i>DrigSell</h5>
                    <p>Toko obat online terpercaya dengan berbagai produk kesehatan berkualitas tinggi.</p>
                    <div class="social-links">
                        <a href="#" class="me-3"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#"><i class="fab fa-youtube fa-lg"></i></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <h5>Produk</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Obat Bebas</a></li>
                        <li><a href="#">Obat Keras</a></li>
                        <li><a href="#">Vitamin</a></li>
                        <li><a href="#">Suplemen</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h5>Layanan</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Pengiriman</a></li>
                        <li><a href="#">Pembayaran</a></li>
                        <li><a href="#">Garansi</a></li>
                        <li><a href="#">Konsultasi</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h5>Perusahaan</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                        <li><a href="{{ route('contact') }}">Kontak</a></li>
                        <li><a href="#">Karir</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h5>Bantuan</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Cara Belanja</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2024 DrigSell. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-end">
                    <img src="https://via.placeholder.com/200x30/FFFFFF/666666?text=Payment+Methods" alt="Payment Methods">
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    
    <script>
        // Add to cart functionality
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

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html> 