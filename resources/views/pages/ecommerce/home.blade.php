<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DrigSell - Toko Obat Online Terpercaya</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">

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

        /* Features Section */
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

        /* Footer */
        .footer {
            background: var(--neutral-900);
            color: var(--text-inverse);
            padding: 40px 0 20px;
        }

        .footer h5 {
            color: var(--primary-500);
            margin-bottom: 20px;
        }

        .footer a {
            color: var(--neutral-400);
            text-decoration: none;
            transition: var(--transition-normal);
        }

        .footer a:hover {
            color: var(--primary-500);
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
    <!-- Main Header -->
    <header class="main-header">
        <div class="container-fluid bg-primary-500">
            <div class="row align-items-center py-3">
                <!-- Logo -->
                <div class="col-md-3">
                    <a href="{{ route('home') }}" class="text-decoration-none text-white">
                        <h2 class="mb-0 fw-bold">
                            <i class="fas fa-pills me-2 text-white"></i>DrigSell
                        </h2>
                    </a>

                </div>

                <!-- Search Form -->
                <div class="col-md-6 d-flex justify-content-center">
                    <form class="d-flex w-100" action="{{ route('search') }}" method="GET" style="max-width: 600px;">
                        <input type="text" name="q" class="form-control"
                            placeholder="Cari obat, vitamin, atau suplemen...">
                        <button type="submit" class="btn btn-primary ms-2" style="border-radius: 25px;">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                <!-- Cart & User -->
                <div class="col-md-3 d-flex justify-content-end align-items-center gap-3">
                    <!-- Cart -->
                    <a href="{{ route('cart') }}" class="btn btn-primary position-relative">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                        </span>
                    </a>

                    <!-- User -->
                    <div class="dropdown">
                        <a class="btn dropdown-toggle d-flex align-items-center " href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" style="border: none; box-shadow: none;">
                            <span class="d-inline-block rounded-circle bg-primary-50 text-white text-center me-2"
                                style="width: 35px; height: 35px; line-height: 35px;">
                                <i class="fas fa-user"></i>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('login') }}">login</a></li>
                            <li><a class="dropdown-item" href="">Profil</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </div>


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
                    <img src="https://via.placeholder.com/500x400/00BFA6/FFFFFF?text=PharmaCare" alt="PharmaCare"
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
                    <div class="category-card ">
                        <div class="category-icon bg-primary-500 text-white p-3 rounded-circle mb-2 d-inline-flex justify-content-center align-items-center"
                            style="width: 50px; height: 50px;">
                            <i class="fas fa-pills"></i>
                        </div>
                        <h5 class="fw-bold ">Obat Bebas</h5>
                        <p class="text-muted small">Obat yang dapat dibeli tanpa resep</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="category-card">
                        <div
                            class="category-icon bg-primary-500 text-white p-3 rounded-circle mb-2 d-inline-flex justify-content-center align-items-center">
                            <i class="fas fa-prescription-bottle"></i>
                        </div>
                        <h5 class="fw-bold">Obat Keras</h5>
                        <p class="text-muted small">Obat dengan resep dokter</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="category-card">
                        <div
                            class="category-icon bg-primary-500 text-white p-3 rounded-circle mb-2 d-inline-flex justify-content-center align-items-center">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h5 class="fw-bold">Vitamin & Suplemen</h5>
                        <p class="text-muted small">Nutrisi tambahan untuk kesehatan</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="category-card">
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
                    <div class="col-lg-3 col-md-4 col-6 ">
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
                                <div class="product-price">Rp {{ number_format(rand(5000, 50000), 0, ',', '.') }}
                                </div>
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



    < <!-- Footer -->
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
                        <img src="https://via.placeholder.com/200x30/FFFFFF/666666?text=Payment+Methods"
                            alt="Payment Methods">
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
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        </script>
</body>

</html>
