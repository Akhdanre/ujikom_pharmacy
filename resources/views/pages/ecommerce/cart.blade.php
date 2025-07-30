<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Keranjang Belanja - DrigSell</title>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
    <!-- Top Header -->
    <div class="bg-primary text-white py-2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <small><i class="fas fa-phone me-2"></i>+62 21 1234 5678</small>
                </div>
                <div class="col-md-6 text-end">
                    <small><i class="fas fa-envelope me-2"></i>info@apoteksehat.com</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ route('ecommerce.home') }}">
                <i class="fas fa-pills me-2"></i>DrigSell
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ecommerce.home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ecommerce.products') }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ecommerce.about') }}">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ecommerce.contact') }}">Kontak</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center">
                    <div class="position-relative me-3">
                        <input type="text" class="form-control" placeholder="Cari produk...">
                        <button class="btn position-absolute end-0 top-0 h-100">
                            <i class="fas fa-search text-muted"></i>
                        </button>
                    </div>
                    <a href="{{ route('ecommerce.cart') }}" class="btn btn-outline-primary position-relative">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ count($cartItems) }}
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @foreach($breadcrumb as $item)
                    @if($item['active'] ?? false)
                        <li class="breadcrumb-item active" aria-current="page">{{ $item['name'] }}</li>
                    @else
                        <li class="breadcrumb-item"><a href="{{ $item['url'] }}" class="text-decoration-none">{{ $item['name'] }}</a></li>
                    @endif
                @endforeach
            </ol>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="row">
            <!-- Cart Items -->
            <div class="col-lg-8">
                <div class="card-custom">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Keranjang Belanja</h5>
                    </div>
                    <div class="card-body p-0">
                        @if(count($cartItems) > 0)
                            @foreach($cartItems as $item)
                                <div class="cart-item p-4 border-bottom">
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="img-fluid rounded" style="width: 80px; height: 80px; object-fit: cover;">
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="fw-bold text-dark mb-1">{{ $item['name'] }}</h6>
                                            <p class="text-muted mb-0">Stok: {{ $item['stock'] }}</p>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="input-group input-group-sm">
                                                <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity({{ $item['id'] }}, -1)">-</button>
                                                <input type="number" class="form-control text-center" value="{{ $item['quantity'] }}" min="1" max="{{ $item['stock'] }}" onchange="updateQuantity({{ $item['id'] }}, this.value)">
                                                <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity({{ $item['id'] }}, 1)">+</button>
                                            </div>
                                        </div>
                                        <div class="col-md-2 text-center">
                                            <div class="fw-bold text-primary">Rp {{ number_format($item['price']) }}</div>
                                            @if($item['discount'] > 0)
                                                <small class="text-muted text-decoration-line-through">Rp {{ number_format($item['original_price']) }}</small>
                                            @endif
                                        </div>
                                        <div class="col-md-2 text-end">
                                            <div class="fw-bold text-primary">Rp {{ number_format($item['subtotal']) }}</div>
                                            <button class="btn btn-sm btn-outline-danger mt-1" onclick="removeItem({{ $item['id'] }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Keranjang belanja kosong</h5>
                                <p class="text-muted">Belum ada produk di keranjang belanja Anda</p>
                                <a href="{{ route('ecommerce.products') }}" class="btn btn-primary">
                                    <i class="fas fa-shopping-bag me-2"></i>Mulai Belanja
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="col-lg-4">
                <div class="card-custom">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-calculator me-2"></i>Ringkasan Belanja</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal ({{ count($cartItems) }} item)</span>
                            <span>Rp {{ number_format($cartSummary['subtotal']) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Diskon</span>
                            <span class="text-success">-Rp {{ number_format($cartSummary['discount']) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Ongkos Kirim</span>
                            <span>Rp {{ number_format($cartSummary['shipping']) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Pajak</span>
                            <span>Rp {{ number_format($cartSummary['tax']) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Total</strong>
                            <strong class="text-primary fs-5">Rp {{ number_format($cartSummary['total']) }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <small class="text-success">Total Hemat</small>
                            <small class="text-success">Rp {{ number_format($cartSummary['saved_total']) }}</small>
                        </div>

                        <button class="btn btn-primary w-100 mb-3" onclick="proceedToCheckout()">
                            <i class="fas fa-credit-card me-2"></i>Lanjut ke Pembayaran
                        </button>

                        <a href="{{ route('ecommerce.products') }}" class="btn btn-outline-primary w-100">
                            <i class="fas fa-arrow-left me-2"></i>Lanjut Belanja
                        </a>
                    </div>
                </div>

                <!-- Coupon Section -->
                <div class="card-custom mt-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-tag me-2"></i>Kupon Diskon</h6>
                    </div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Masukkan kode kupon" id="couponCode">
                            <button class="btn btn-outline-primary" type="button" onclick="applyCoupon()">Gunakan</button>
                        </div>
                        <div class="small text-muted">
                            <strong>Kupon Tersedia:</strong>
                            <ul class="list-unstyled mt-2">
                                @foreach($availableCoupons as $coupon)
                                    <li><i class="fas fa-check text-success me-1"></i>{{ $coupon['code'] }} - {{ $coupon['description'] }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recommended Products -->
        @if(count($recommendedProducts) > 0)
            <div class="mt-5">
                <h4 class="mb-4">Produk Rekomendasi</h4>
                <div class="row">
                    @foreach($recommendedProducts as $product)
                        <div class="col-md-3 mb-4">
                            <div class="product-card h-100">
                                <img src="{{ $product['image'] }}" class="card-img-top" alt="{{ $product['name'] }}" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h6 class="card-title fw-bold">{{ $product['name'] }}</h6>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="text-warning me-1">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star{{ $i <= $product['rating'] ? '' : '-o' }}"></i>
                                            @endfor
                                        </div>
                                        <small class="text-muted">({{ $product['reviews'] }})</small>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong class="text-primary">Rp {{ number_format($product['price']) }}</strong>
                                            @if($product['discount'] > 0)
                                                <small class="text-muted text-decoration-line-through d-block">Rp {{ number_format($product['original_price']) }}</small>
                                            @endif
                                        </div>
                                        <button class="btn btn-sm btn-primary" onclick="addToCart({{ $product['id'] }})">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>DrigSell</h5>
                    <p class="mb-0">Solusi kesehatan terpercaya untuk keluarga Indonesia</p>
                </div>
                <div class="col-md-6 text-end">
                    <p class="mb-0">&copy; 2024 DrigSell. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function updateQuantity(itemId, change) {
            // Implementation for updating quantity
            console.log('Update quantity for item:', itemId, 'change:', change);
        }

        function removeItem(itemId) {
            if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                // Implementation for removing item
                console.log('Remove item:', itemId);
            }
        }

        function applyCoupon() {
            const couponCode = document.getElementById('couponCode').value;
            // Implementation for applying coupon
            console.log('Apply coupon:', couponCode);
        }

        function addToCart(productId) {
            // Implementation for adding to cart
            console.log('Add to cart:', productId);
        }

        function proceedToCheckout() {
            // Implementation for checkout
            console.log('Proceed to checkout');
        }
    </script>
</body>
</html>
