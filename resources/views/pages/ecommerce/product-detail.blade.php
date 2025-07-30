<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Produk - DrigSell</title>
    
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

        /* Product Detail Styles */
        .product-detail-card {
            background: white;
            border-radius: 15px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .product-gallery {
            position: relative;
        }

        .main-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 15px 0 0 15px;
        }

        .thumbnail-images {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .thumbnail:hover,
        .thumbnail.active {
            border-color: var(--primary-color);
        }

        .product-info {
            padding: 30px;
        }

        .product-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 10px;
        }

        .product-brand {
            color: var(--text-light);
            font-size: 14px;
            margin-bottom: 15px;
        }

        .product-rating {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .rating-stars {
            color: var(--accent-color);
        }

        .rating-text {
            color: var(--text-light);
            font-size: 14px;
        }

        .product-price {
            font-size: 32px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .original-price {
            text-decoration: line-through;
            color: var(--text-light);
            font-size: 18px;
            margin-left: 10px;
        }

        .discount-badge {
            background: var(--secondary-color);
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
            margin-left: 10px;
        }

        .product-options {
            margin-bottom: 25px;
        }

        .option-group {
            margin-bottom: 20px;
        }

        .option-label {
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--text-dark);
        }

        .option-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .option-btn {
            padding: 8px 16px;
            border: 2px solid #ddd;
            background: white;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .option-btn:hover,
        .option-btn.active {
            border-color: var(--primary-color);
            background: var(--primary-color);
            color: white;
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .quantity-btn {
            width: 40px;
            height: 40px;
            border: 1px solid #ddd;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .quantity-btn:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .quantity-input {
            width: 60px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 8px;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }

        .btn-buy-now {
            background: var(--secondary-color);
            color: white;
            border: none;
            border-radius: 25px;
            padding: 15px 30px;
            font-weight: 600;
            flex: 1;
            transition: all 0.3s ease;
        }

        .btn-buy-now:hover {
            background: #e55a2b;
            color: white;
            transform: scale(1.05);
        }

        .btn-add-cart {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 25px;
            padding: 15px 30px;
            font-weight: 600;
            flex: 1;
            transition: all 0.3s ease;
        }

        .btn-add-cart:hover {
            background: #00A896;
            color: white;
            transform: scale(1.05);
        }

        .btn-wishlist {
            width: 50px;
            height: 50px;
            border: 2px solid #ddd;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-wishlist:hover,
        .btn-wishlist.active {
            border-color: var(--secondary-color);
            color: var(--secondary-color);
        }

        .product-meta {
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        .meta-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .meta-label {
            color: var(--text-light);
        }

        .meta-value {
            color: var(--text-dark);
            font-weight: 500;
        }

        /* Description Tabs */
        .description-tabs {
            background: white;
            border-radius: 15px;
            box-shadow: var(--shadow);
            margin-top: 30px;
        }

        .nav-tabs {
            border-bottom: 1px solid #eee;
            padding: 0 30px;
        }

        .nav-tabs .nav-link {
            border: none;
            color: var(--text-light);
            font-weight: 600;
            padding: 20px 0;
            margin-right: 30px;
        }

        .nav-tabs .nav-link.active {
            color: var(--primary-color);
            border-bottom: 3px solid var(--primary-color);
        }

        .tab-content {
            padding: 30px;
        }

        /* Related Products */
        .related-products {
            margin-top: 40px;
        }

        .related-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--text-dark);
        }

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

        .product-info-small {
            padding: 15px;
        }

        .product-title-small {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-dark);
            font-size: 14px;
            line-height: 1.4;
        }

        .product-price-small {
            font-size: 16px;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .btn-add-cart-small {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 20px;
            padding: 8px 16px;
            font-weight: 600;
            font-size: 12px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-add-cart-small:hover {
            background: #00A896;
            color: white;
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
            .main-image {
                border-radius: 15px 15px 0 0;
            }
            
            .product-info {
                padding: 20px;
            }
            
            .action-buttons {
                flex-direction: column;
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

    <!-- Breadcrumb -->
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products') }}">Produk</a></li>
                <li class="breadcrumb-item active">Detail Produk</li>
            </ol>
        </nav>
    </div>

    <!-- Product Detail -->
    <div class="container py-4">
        <div class="row">
            <!-- Product Images -->
            <div class="col-lg-6">
                <div class="product-detail-card">
                    <div class="product-gallery">
                        <img src="https://via.placeholder.com/600x400/00BFA6/FFFFFF?text=Obat+Detail" alt="Product" class="main-image" id="mainImage">
                        <div class="thumbnail-images">
                            <img src="https://via.placeholder.com/80x80/00BFA6/FFFFFF?text=1" alt="Thumbnail 1" class="thumbnail active" onclick="changeImage(this)">
                            <img src="https://via.placeholder.com/80x80/FF6B35/FFFFFF?text=2" alt="Thumbnail 2" class="thumbnail" onclick="changeImage(this)">
                            <img src="https://via.placeholder.com/80x80/FFD93D/FFFFFF?text=3" alt="Thumbnail 3" class="thumbnail" onclick="changeImage(this)">
                            <img src="https://via.placeholder.com/80x80/6C5CE7/FFFFFF?text=4" alt="Thumbnail 4" class="thumbnail" onclick="changeImage(this)">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-lg-6">
                <div class="product-detail-card">
                    <div class="product-info">
                        <h1 class="product-title">Paracetamol 500mg - Obat Sakit Kepala</h1>
                        <div class="product-brand">Brand: Kimia Farma</div>
                        
                        <div class="product-rating">
                            <div class="rating-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="rating-text">4.8 (128 ulasan)</span>
                        </div>

                        <div class="product-price">
                            Rp 15.000
                            <span class="original-price">Rp 20.000</span>
                            <span class="discount-badge">-25%</span>
                        </div>

                        <!-- Product Options -->
                        <div class="product-options">
                            <div class="option-group">
                                <div class="option-label">Ukuran:</div>
                <div class="option-buttons">
                    <button class="option-btn active">10 Tablet</button>
                    <button class="option-btn">20 Tablet</button>
                    <button class="option-btn">30 Tablet</button>
                </div>
            </div>

            <div class="option-group">
                <div class="option-label">Kemasan:</div>
                <div class="option-buttons">
                    <button class="option-btn active">Strip</button>
                    <button class="option-btn">Botol</button>
                </div>
            </div>
        </div>

        <!-- Quantity Selector -->
        <div class="quantity-selector">
            <span class="option-label">Jumlah:</span>
            <button class="quantity-btn" onclick="changeQuantity(-1)">-</button>
            <input type="number" class="quantity-input" value="1" min="1" id="quantityInput">
            <button class="quantity-btn" onclick="changeQuantity(1)">+</button>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <button class="btn-buy-now">
                <i class="fas fa-bolt me-2"></i>Beli Sekarang
            </button>
            <button class="btn-add-cart">
                <i class="fas fa-cart-plus me-2"></i>Tambah ke Keranjang
            </button>
            <button class="btn-wishlist" onclick="toggleWishlist()">
                <i class="far fa-heart"></i>
            </button>
        </div>

        <!-- Product Meta -->
        <div class="product-meta">
            <div class="meta-item">
                <span class="meta-label">Stok:</span>
                <span class="meta-value text-success">Tersedia (50)</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Kategori:</span>
                <span class="meta-value">Obat Bebas</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Berat:</span>
                <span class="meta-value">50 gram</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Pengiriman:</span>
                <span class="meta-value">1-3 hari kerja</span>
            </div>
        </div>
    </div>
</div>
            </div>
        </div>

        <!-- Description Tabs -->
        <div class="description-tabs">
            <ul class="nav nav-tabs" id="productTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab">
                        Deskripsi
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="specification-tab" data-bs-toggle="tab" data-bs-target="#specification" type="button" role="tab">
                        Spesifikasi
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab">
                        Ulasan (128)
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="productTabsContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel">
                    <h5>Deskripsi Produk</h5>
                    <p>Paracetamol 500mg adalah obat yang digunakan untuk meredakan demam dan nyeri ringan hingga sedang seperti sakit kepala, sakit gigi, nyeri otot, dan nyeri haid.</p>
                    
                    <h6>Indikasi:</h6>
                    <ul>
                        <li>Meredakan demam</li>
                        <li>Mengatasi sakit kepala</li>
                        <li>Meredakan nyeri otot</li>
                        <li>Mengatasi sakit gigi</li>
                        <li>Meredakan nyeri haid</li>
                    </ul>

                    <h6>Cara Penggunaan:</h6>
                    <p>Dewasa: 1-2 tablet setiap 4-6 jam sesuai kebutuhan. Maksimal 8 tablet per hari.</p>
                    
                    <h6>Peringatan:</h6>
                    <ul>
                        <li>Jangan melebihi dosis yang dianjurkan</li>
                        <li>Konsultasikan dengan dokter jika gejala berlanjut</li>
                        <li>Simpan di tempat kering dan sejuk</li>
                    </ul>
                </div>
                
                <div class="tab-pane fade" id="specification" role="tabpanel">
                    <h5>Spesifikasi Produk</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <td><strong>Komposisi</strong></td>
                                    <td>Paracetamol 500mg</td>
                                </tr>
                                <tr>
                                    <td><strong>Bentuk</strong></td>
                                    <td>Tablet</td>
                                </tr>
                                <tr>
                                    <td><strong>Kemasan</strong></td>
                                    <td>10 tablet per strip</td>
                                </tr>
                                <tr>
                                    <td><strong>Berat</strong></td>
                                    <td>50 gram</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <td><strong>Merek</strong></td>
                                    <td>Kimia Farma</td>
                                </tr>
                                <tr>
                                    <td><strong>Kategori</strong></td>
                                    <td>Obat Bebas</td>
                                </tr>
                                <tr>
                                    <td><strong>Expired Date</strong></td>
                                    <td>2025-12-31</td>
                                </tr>
                                <tr>
                                    <td><strong>Registrasi</strong></td>
                                    <td>DKL1234567890A1</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="reviews" role="tabpanel">
                    <h5>Ulasan Pembeli</h5>
                    
                    <!-- Review Summary -->
                    <div class="row mb-4">
                        <div class="col-md-3 text-center">
                            <div class="h2 text-warning">4.8</div>
                            <div class="text-muted">Rata-rata Rating</div>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="d-flex align-items-center mb-2">
                                <span class="me-2">5</span>
                                <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                    <div class="progress-bar bg-warning" style="width: 80%"></div>
                                </div>
                                <span>80%</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="me-2">4</span>
                                <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                    <div class="progress-bar bg-warning" style="width: 15%"></div>
                                </div>
                                <span>15%</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="me-2">3</span>
                                <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                    <div class="progress-bar bg-warning" style="width: 3%"></div>
                                </div>
                                <span>3%</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="me-2">2</span>
                                <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                    <div class="progress-bar bg-warning" style="width: 1%"></div>
                                </div>
                                <span>1%</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="me-2">1</span>
                                <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                    <div class="progress-bar bg-warning" style="width: 1%"></div>
                                </div>
                                <span>1%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Individual Reviews -->
                    <div class="review-item border-bottom pb-3 mb-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1">Ahmad S.</h6>
                                <div class="text-warning mb-2">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <small class="text-muted">2 hari yang lalu</small>
                        </div>
                        <p>Obat ini sangat efektif untuk meredakan sakit kepala. Pengiriman juga cepat. Recommended!</p>
                    </div>

                    <div class="review-item border-bottom pb-3 mb-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1">Sarah M.</h6>
                                <div class="text-warning mb-2">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                            <small class="text-muted">1 minggu yang lalu</small>
                        </div>
                        <p>Kualitas obat bagus, harga terjangkau. Akan beli lagi jika diperlukan.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <div class="related-products">
            <h3 class="related-title">Produk Terkait</h3>
            <div class="row g-4">
                @for ($i = 1; $i <= 4; $i++)
                <div class="col-lg-3 col-md-6">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="https://via.placeholder.com/300x200/00BFA6/FFFFFF?text=Related+{{ $i }}" alt="Related Product {{ $i }}">
                        </div>
                        <div class="product-info-small">
                            <h6 class="product-title-small">Obat Sakit Kepala {{ $i }}</h6>
                            <div class="product-price-small">Rp {{ number_format(rand(5000, 50000), 0, ',', '.') }}</div>
                            <button class="btn-add-cart-small">
                                <i class="fas fa-cart-plus me-1"></i>Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                </div>
                @endfor
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
        // Change main image
        function changeImage(thumbnail) {
            document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('active'));
            thumbnail.classList.add('active');
            document.getElementById('mainImage').src = thumbnail.src.replace('80x80', '600x400');
        }

        // Change quantity
        function changeQuantity(change) {
            const input = document.getElementById('quantityInput');
            let value = parseInt(input.value) + change;
            if (value < 1) value = 1;
            input.value = value;
        }

        // Toggle wishlist
        function toggleWishlist() {
            const btn = document.querySelector('.btn-wishlist');
            const icon = btn.querySelector('i');
            btn.classList.toggle('active');
            
            if (btn.classList.contains('active')) {
                icon.className = 'fas fa-heart';
                icon.style.color = '#FF6B35';
            } else {
                icon.className = 'far fa-heart';
                icon.style.color = '';
            }
        }

        // Add to cart functionality
        document.querySelectorAll('.btn-add-cart, .btn-add-cart-small').forEach(button => {
            button.addEventListener('click', function() {
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-check me-2"></i>Ditambahkan';
                this.style.background = '#28a745';
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.style.background = '';
                }, 2000);
            });
        });

        // Buy now functionality
        document.querySelector('.btn-buy-now').addEventListener('click', function() {
            alert('Fitur pembelian akan segera tersedia!');
        });

        // Option button functionality
        document.querySelectorAll('.option-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const parent = this.parentElement;
                parent.querySelectorAll('.option-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html> 