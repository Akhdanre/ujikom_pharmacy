<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $product['name'] }} - DrigSell</title>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
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
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
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
            <!-- Product Images -->
            <div class="col-lg-6 mb-4">
                <div class="card-custom">
                    <div class="card-body p-0">
                        <!-- Main Image -->
                        <div class="position-relative">
                            <img src="{{ $product['images'][0] }}" class="img-fluid w-100" alt="{{ $product['name'] }}"
                                 style="height: 400px; object-fit: cover;" id="mainImage">
                            @if($product['discount'] > 0)
                                <span class="badge bg-danger position-absolute top-0 start-0 m-3 fs-6">
                                    -{{ $product['discount'] }}%
                                </span>
                            @endif
                        </div>

                        <!-- Thumbnail Images -->
                        <div class="d-flex gap-2 mt-3 px-3 pb-3">
                            @foreach($product['images'] as $index => $image)
                                <img src="{{ $image }}" class="img-thumbnail" alt="{{ $product['name'] }}"
                                     style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;"
                                     onclick="changeMainImage('{{ $image }}')"
                                     id="thumb{{ $index }}">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-lg-6 mb-4">
                <div class="card-custom">
                    <div class="card-body">
                        <div class="mb-3">
                            <span class="badge bg-primary">{{ $product['category'] }}</span>
                            <span class="badge bg-secondary">{{ $product['brand'] }}</span>
                        </div>

                        <h2 class="fw-bold mb-3">{{ $product['name'] }}</h2>

                        <!-- Rating -->
                        <div class="d-flex align-items-center mb-3">
                            <div class="text-warning me-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star{{ $i <= $product['rating'] ? '' : '-o' }}"></i>
                                @endfor
                            </div>
                            <span class="text-muted">({{ $product['reviews'] }} ulasan)</span>
                            <span class="badge bg-success ms-2">Stok: {{ $product['stock'] }}</span>
                        </div>

                        <!-- Price -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center">
                                <h3 class="text-primary fw-bold mb-0">Rp {{ number_format($product['price']) }}</h3>
                                @if($product['discount'] > 0)
                                    <span class="text-muted text-decoration-line-through ms-3 fs-5">
                                        Rp {{ number_format($product['original_price']) }}
                                    </span>
                                @endif
                            </div>
                            @if($product['discount'] > 0)
                                <small class="text-success">Hemat Rp {{ number_format($product['original_price'] - $product['price']) }}</small>
                            @endif
                        </div>

                        <!-- Quantity and Add to Cart -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Jumlah:</label>
                            <div class="d-flex align-items-center gap-3">
                                <div class="input-group" style="width: 150px;">
                                    <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(-1)">-</button>
                                    <input type="number" class="form-control text-center" value="1" min="1" max="{{ $product['stock'] }}" id="quantity">
                                    <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(1)">+</button>
                                </div>
                                <button class="btn btn-primary btn-lg" onclick="addToCart()">
                                    <i class="fas fa-shopping-cart me-2"></i>Tambah ke Keranjang
                                </button>
                            </div>
                        </div>

                        <!-- Product Details -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Informasi Produk:</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>SKU:</strong> {{ $product['sku'] }}</p>
                                    <p class="mb-2"><strong>Berat:</strong> {{ $product['weight'] }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Dimensi:</strong> {{ $product['dimensions'] }}</p>
                                    <p class="mb-2"><strong>Kadaluarsa:</strong> {{ $product['expiry_date'] }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Deskripsi:</h6>
                            <p class="text-muted">{{ $product['description'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Details Tabs -->
        <div class="row">
            <div class="col-12">
                <div class="card-custom">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="productTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="indications-tab" data-bs-toggle="tab" data-bs-target="#indications" type="button" role="tab">
                                    Indikasi
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="dosage-tab" data-bs-toggle="tab" data-bs-target="#dosage" type="button" role="tab">
                                    Dosis
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="side-effects-tab" data-bs-toggle="tab" data-bs-target="#side-effects" type="button" role="tab">
                                    Efek Samping
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="warnings-tab" data-bs-toggle="tab" data-bs-target="#warnings" type="button" role="tab">
                                    Peringatan
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="productTabsContent">
                            <div class="tab-pane fade show active" id="indications" role="tabpanel">
                                <ul class="list-unstyled">
                                    @foreach($product['indications'] as $indication)
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>{{ $indication }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="dosage" role="tabpanel">
                                <ul class="list-unstyled">
                                    @foreach($product['dosage'] as $dose)
                                        <li class="mb-2"><i class="fas fa-info-circle text-primary me-2"></i>{{ $dose }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="side-effects" role="tabpanel">
                                <ul class="list-unstyled">
                                    @foreach($product['side_effects'] as $effect)
                                        <li class="mb-2"><i class="fas fa-exclamation-triangle text-warning me-2"></i>{{ $effect }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="warnings" role="tabpanel">
                                <ul class="list-unstyled">
                                    @foreach($product['warnings'] as $warning)
                                        <li class="mb-2"><i class="fas fa-exclamation-circle text-danger me-2"></i>{{ $warning }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card-custom">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-star me-2"></i>Ulasan Pelanggan</h5>
                    </div>
                    <div class="card-body">
                        <!-- Rating Summary -->
                        <div class="row mb-4">
                            <div class="col-md-3 text-center">
                                <h2 class="text-primary mb-1">{{ $ratingSummary['average'] }}</h2>
                                <div class="text-warning mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= $ratingSummary['average'] ? '' : '-o' }}"></i>
                                    @endfor
                                </div>
                                <p class="text-muted">Berdasarkan {{ $ratingSummary['total_reviews'] }} ulasan</p>
                            </div>
                            <div class="col-md-9">
                                @for($i = 5; $i >= 1; $i--)
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="me-2">{{ $i }} <i class="fas fa-star text-warning"></i></span>
                                        <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                            <div class="progress-bar bg-warning" style="width: {{ ($ratingSummary['distribution'][$i] ?? 0) / $ratingSummary['total_reviews'] * 100 }}%"></div>
                                        </div>
                                        <span class="text-muted small">{{ $ratingSummary['distribution'][$i] ?? 0 }}</span>
                                    </div>
                                @endfor
                            </div>
                        </div>

                        <!-- Reviews List -->
                        <div class="reviews-list">
                            @foreach($reviews as $review)
                                <div class="border-bottom pb-3 mb-3">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <h6 class="mb-1">{{ $review['user_name'] }}</h6>
                                            <div class="text-warning mb-1">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star{{ $i <= $review['rating'] ? '' : '-o' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <small class="text-muted">{{ $review['date'] }}</small>
                                    </div>
                                    <p class="mb-2">{{ $review['comment'] }}</p>
                                    @if($review['verified_purchase'])
                                        <span class="badge bg-success"><i class="fas fa-check me-1"></i>Pembelian Terverifikasi</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if(count($relatedProducts) > 0)
            <div class="row mt-5">
                <div class="col-12">
                    <h4 class="mb-4">Produk Terkait</h4>
                    <div class="row">
                        @foreach($relatedProducts as $related)
                            <div class="col-md-3 mb-4">
                                <div class="product-card h-100">
                                    <img src="{{ $related['image'] }}" class="card-img-top" alt="{{ $related['name'] }}"
                                         style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <h6 class="card-title fw-bold">{{ $related['name'] }}</h6>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="text-warning me-1">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star{{ $i <= $related['rating'] ? '' : '-o' }}"></i>
                                                @endfor
                                            </div>
                                            <small class="text-muted">({{ $related['reviews'] }})</small>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong class="text-primary">Rp {{ number_format($related['price']) }}</strong>
                                                @if($related['discount'] > 0)
                                                    <small class="text-muted text-decoration-line-through d-block">
                                                        Rp {{ number_format($related['original_price']) }}
                                                    </small>
                                                @endif
                                            </div>
                                            <a href="{{ route('ecommerce.product.detail', $related['id']) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
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
        function changeMainImage(imageSrc) {
            document.getElementById('mainImage').src = imageSrc;

            // Update active thumbnail
            document.querySelectorAll('[id^="thumb"]').forEach(thumb => {
                thumb.classList.remove('border-primary');
            });
            event.target.classList.add('border-primary');
        }

        function changeQuantity(change) {
            const input = document.getElementById('quantity');
            let value = parseInt(input.value) + change;
            if (value < 1) value = 1;
            if (value > {{ $product['stock'] }}) value = {{ $product['stock'] }};
            input.value = value;
        }

        function addToCart() {
            const quantity = document.getElementById('quantity').value;
            const productId = {{ $product['id'] }};

            // Implementation for adding to cart
            console.log('Add to cart:', productId, 'quantity:', quantity);
            // You can add AJAX call here to add product to cart

            alert('Produk berhasil ditambahkan ke keranjang!');
        }
    </script>
</body>
</html>
