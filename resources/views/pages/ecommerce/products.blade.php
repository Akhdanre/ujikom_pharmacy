<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Produk - DrigSell</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
            background-color: var(--bg-light);
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

        /* Filter Sidebar */
        .filter-sidebar {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: var(--shadow);
            height: fit-content;
            position: sticky;
            top: 100px;
        }

        .filter-section {
            margin-bottom: 25px;
        }

        .filter-section h6 {
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: 15px;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 8px;
        }

        .form-check {
            margin-bottom: 10px;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .price-range {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .price-input {
            flex: 1;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 14px;
        }

        /* Product Grid */
        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            border: 1px solid #E9ECEF;
            height: 100%;
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
            display: flex;
            flex-direction: column;
            height: calc(100% - 200px);
        }

        .product-title {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-dark);
            font-size: 14px;
            line-height: 1.4;
            flex-grow: 1;
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

        .product-location {
            color: var(--text-light);
            font-size: 12px;
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
            margin-top: auto;
        }

        .btn-add-cart:hover {
            background: #00A896;
            color: white;
            transform: scale(1.05);
        }

        /* Sort and View Options */
        .sort-options {
            background: white;
            border-radius: 15px;
            padding: 15px 20px;
            box-shadow: var(--shadow);
            margin-bottom: 20px;
        }

        .view-toggle {
            display: flex;
            gap: 10px;
        }

        .view-btn {
            padding: 8px 12px;
            border: 1px solid #ddd;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .view-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        /* Pagination */
        .pagination {
            justify-content: center;
            margin-top: 30px;
        }

        .page-link {
            color: var(--primary-color);
            border-color: #ddd;
        }

        .page-link:hover {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Breadcrumb */
        .breadcrumb {
            background: transparent;
            padding: 15px 0;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: var(--text-light);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .filter-sidebar {
                position: static;
                margin-bottom: 20px;
            }
            
            .search-bar {
                max-width: 100%;
            }
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
                        <input type="text" name="q" class="search-bar" placeholder="Cari obat, vitamin, atau suplemen..." value="{{ $search ?? '' }}">
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

    <!-- Breadcrumb -->
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Produk</li>
            </ol>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="container py-4">
        <div class="row">
            <!-- Filter Sidebar -->
            <div class="col-lg-3">
                <div class="filter-sidebar">
                    <h5 class="mb-4">Filter Produk</h5>
                    
                    <!-- Category Filter -->
                    <div class="filter-section">
                        <h6>Kategori</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="cat1" name="category[]" value="obat-bebas">
                            <label class="form-check-label" for="cat1">Obat Bebas</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="cat2" name="category[]" value="obat-keras">
                            <label class="form-check-label" for="cat2">Obat Keras</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="cat3" name="category[]" value="vitamin">
                            <label class="form-check-label" for="cat3">Vitamin & Suplemen</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="cat4" name="category[]" value="bayi">
                            <label class="form-check-label" for="cat4">Perawatan Bayi</label>
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div class="filter-section">
                        <h6>Rentang Harga</h6>
                        <div class="price-range">
                            <input type="number" class="price-input" placeholder="Min" name="min_price" value="{{ $minPrice ?? '' }}">
                            <span>-</span>
                            <input type="number" class="price-input" placeholder="Max" name="max_price" value="{{ $maxPrice ?? '' }}">
                        </div>
                        <button class="btn btn-primary btn-sm w-100 mt-2">Terapkan</button>
                    </div>

                    <!-- Rating Filter -->
                    <div class="filter-section">
                        <h6>Rating</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rating5">
                            <label class="form-check-label" for="rating5">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                (5.0)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rating4">
                            <label class="form-check-label" for="rating4">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="far fa-star text-warning"></i>
                                & up (4.0)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rating3">
                            <label class="form-check-label" for="rating3">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="far fa-star text-warning"></i>
                                <i class="far fa-star text-warning"></i>
                                & up (3.0)
                            </label>
                        </div>
                    </div>

                    <!-- Availability -->
                    <div class="filter-section">
                        <h6>Ketersediaan</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="ready">
                            <label class="form-check-label" for="ready">Stok Tersedia</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="preorder">
                            <label class="form-check-label" for="preorder">Pre-order</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="col-lg-9">
                <!-- Sort and View Options -->
                <div class="sort-options">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <span class="text-muted">Menampilkan {{ count($medicines ?? []) }} produk</span>
                        </div>
                        <div class="col-md-6 text-end">
                            <div class="d-flex justify-content-end align-items-center gap-3">
                                <span class="text-muted">Urutkan:</span>
                                <select class="form-select form-select-sm" style="width: auto;">
                                    <option>Terpopuler</option>
                                    <option>Harga Terendah</option>
                                    <option>Harga Tertinggi</option>
                                    <option>Rating Tertinggi</option>
                                    <option>Terbaru</option>
                                </select>
                                <div class="view-toggle">
                                    <button class="view-btn active">
                                        <i class="fas fa-th"></i>
                                    </button>
                                    <button class="view-btn">
                                        <i class="fas fa-list"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="row g-4">
                    @for ($i = 1; $i <= 12; $i++)
                    <div class="col-lg-4 col-md-6 col-6">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="https://via.placeholder.com/300x200/00BFA6/FFFFFF?text=Obat+{{ $i }}" alt="Product {{ $i }}">
                                @if($i <= 3)
                                <div class="product-badge">Terlaris</div>
                                @endif
                            </div>
                            <div class="product-info">
                                <h6 class="product-title">Obat Sakit Kepala {{ $i }} - {{ rand(10, 50) }}mg</h6>
                                <div class="product-price">Rp {{ number_format(rand(5000, 50000), 0, ',', '.') }}</div>
                                <div class="product-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <span class="ms-1 text-muted">({{ rand(10, 100) }})</span>
                                </div>
                                <div class="product-location">
                                    <i class="fas fa-map-marker-alt me-1"></i>Jakarta Pusat
                                </div>
                                <button class="btn btn-add-cart">
                                    <i class="fas fa-cart-plus me-2"></i>Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>

                <!-- Pagination -->
                <nav aria-label="Product pagination">
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="fas fa-pills me-2"></i>DrigSell</h5>
                    <p>Toko obat online terpercaya dengan berbagai produk kesehatan berkualitas tinggi.</p>
                </div>
                <div class="col-md-2">
                    <h6>Produk</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-muted">Obat Bebas</a></li>
                        <li><a href="#" class="text-muted">Obat Keras</a></li>
                        <li><a href="#" class="text-muted">Vitamin</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h6>Layanan</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-muted">Pengiriman</a></li>
                        <li><a href="#" class="text-muted">Pembayaran</a></li>
                        <li><a href="#" class="text-muted">Garansi</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h6>Perusahaan</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-muted">Tentang Kami</a></li>
                        <li><a href="#" class="text-muted">Kontak</a></li>
                        <li><a href="#" class="text-muted">Blog</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h6>Bantuan</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-muted">FAQ</a></li>
                        <li><a href="#" class="text-muted">Cara Belanja</a></li>
                        <li><a href="#" class="text-muted">Kebijakan</a></li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p class="mb-0">&copy; 2024 DrigSell. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
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

        // View toggle functionality
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Filter functionality
        document.querySelectorAll('.form-check-input').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                // Add filter logic here
                console.log('Filter changed:', this.id, this.checked);
            });
        });
    </script>
</body>
</html> 