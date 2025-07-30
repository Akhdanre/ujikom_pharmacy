<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pencarian: {{ $query }} - DrigSell</title>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-light">


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
                        <input type="text" class="form-control" placeholder="Cari produk..."
                            value="{{ $query }}" id="searchInput">
                        <button class="btn position-absolute end-0 top-0 h-100" onclick="performSearch()">
                            <i class="fas fa-search text-muted"></i>
                        </button>
                    </div>
                    <a href="{{ route('ecommerce.cart') }}" class="btn btn-outline-primary position-relative">
                        <i class="fas fa-shopping-cart"></i>
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @foreach ($breadcrumb as $item)
                    @if ($item['active'] ?? false)
                        <li class="breadcrumb-item active" aria-current="page">{{ $item['name'] }}</li>
                    @else
                        <li class="breadcrumb-item"><a href="{{ $item['url'] }}"
                                class="text-decoration-none">{{ $item['name'] }}</a></li>
                    @endif
                @endforeach
            </ol>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="container my-5">
        <!-- Search Results Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card-custom">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-1">Hasil Pencarian: "{{ $query }}"</h4>
                                <p class="text-muted mb-0">
                                    Ditemukan {{ $searchStats['total_results'] }} hasil dalam
                                    {{ $searchStats['search_time'] }} detik
                                </p>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="me-3">Urutkan:</span>
                                <select class="form-select form-select-sm" style="width: auto;" id="sortSelect">
                                    <option value="relevance" {{ $sort == 'relevance' ? 'selected' : '' }}>Relevansi
                                    </option>
                                    <option value="price_low" {{ $sort == 'price_low' ? 'selected' : '' }}>Harga
                                        Terendah</option>
                                    <option value="price_high" {{ $sort == 'price_high' ? 'selected' : '' }}>Harga
                                        Tertinggi</option>
                                    <option value="rating" {{ $sort == 'rating' ? 'selected' : '' }}>Rating Tertinggi
                                    </option>
                                    <option value="newest" {{ $sort == 'newest' ? 'selected' : '' }}>Terbaru</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Filter Sidebar -->
            <div class="col-lg-3">
                <div class="card-custom sticky-top" style="top: 100px;">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-filter me-2"></i>Filter Hasil</h6>
                    </div>
                    <div class="card-body">
                        <!-- Categories -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Kategori</label>
                            @foreach ($categories as $cat)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $cat['id'] }}"
                                        id="cat{{ $cat['id'] }}" {{ $category == $cat['id'] ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cat{{ $cat['id'] }}">
                                        {{ $cat['name'] }} ({{ $cat['count'] }})
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <!-- Brands -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Brand</label>
                            @foreach ($brands as $brand)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $brand['id'] }}"
                                        id="brand{{ $brand['id'] }}" {{ $brand == $brand['id'] ? 'checked' : '' }}>
                                    <label class="form-check-label" for="brand{{ $brand['id'] }}">
                                        {{ $brand['name'] }} ({{ $brand['count'] }})
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <!-- Price Range -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Range Harga</label>
                            @foreach ($priceRanges as $range)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="price_range"
                                        value="{{ $range['min'] }}-{{ $range['max'] }}"
                                        id="price{{ $loop->index }}">
                                    <label class="form-check-label" for="price{{ $loop->index }}">
                                        {{ $range['label'] }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <!-- Apply Filters -->
                        <button class="btn btn-primary w-100" onclick="rr()">
                            <i class="fas fa-search me-2"></i>Terapkan Filter
                        </button>
                    </div>
                </div>

                <!-- Search Suggestions -->
                <div class="card-custom mt-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-lightbulb me-2"></i>Saran Pencarian</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2">
                            @foreach ($searchSuggestions as $suggestion)
                                <a href="?q={{ $suggestion }}"
                                    class="badge bg-light text-dark text-decoration-none">
                                    {{ $suggestion }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Popular Searches -->
                <div class="card-custom mt-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-fire me-2"></i>Pencarian Populer</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2">
                            @foreach ($popularSearches as $popular)
                                <a href="?q={{ $popular }}" class="badge bg-primary text-decoration-none">
                                    {{ $popular }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Results -->
            <div class="col-lg-9">
                @if (count($searchResults) > 0)
                    <div class="row">
                        @foreach ($searchResults as $product)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="product-card h-100">
                                    <div class="position-relative">
                                        <img src="{{ $product['image'] }}" class="card-img-top"
                                            alt="{{ $product['name'] }}" style="height: 200px; object-fit: cover;">
                                        @if ($product['discount'] > 0)
                                            <span class="badge bg-danger position-absolute top-0 end-0 m-2">
                                                -{{ $product['discount'] }}%
                                            </span>
                                        @endif
                                        @if ($product['is_featured'])
                                            <span class="badge bg-warning position-absolute top-0 start-0 m-2">
                                                <i class="fas fa-star"></i> Featured
                                            </span>
                                        @endif
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <div class="mb-2">
                                            <small class="text-muted">{{ $product['category'] }}</small>
                                        </div>
                                        <h6 class="card-title fw-bold mb-2">{{ $product['name'] }}</h6>
                                        <p class="text-muted small mb-2">{{ $product['brand'] }}</p>

                                        <!-- Highlight search terms -->
                                        <div class="mb-2">
                                            <small class="text-muted">{!! $product['highlight'] !!}</small>
                                        </div>

                                        <div class="d-flex align-items-center mb-2">
                                            <div class="text-warning me-1">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i
                                                        class="fas fa-star{{ $i <= $product['rating'] ? '' : '-o' }}"></i>
                                                @endfor
                                            </div>
                                            <small class="text-muted">({{ $product['reviews'] }})</small>
                                        </div>

                                        <div class="mt-auto">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div>
                                                    <strong class="text-primary fs-5">Rp
                                                        {{ number_format($product['price']) }}</strong>
                                                    @if ($product['discount'] > 0)
                                                        <small class="text-muted text-decoration-line-through d-block">
                                                            Rp {{ number_format($product['original_price']) }}
                                                        </small>
                                                    @endif
                                                </div>
                                                <small class="text-muted">Stok: {{ $product['stock'] }}</small>
                                            </div>

                                            <div class="d-grid gap-2">
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="addToCart({{ $product['id'] }})">
                                                    <i class="fas fa-shopping-cart me-2"></i>Tambah ke Keranjang
                                                </button>
                                                <a href="{{ route('ecommerce.product.detail', $product['id']) }}"
                                                    class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-eye me-2"></i>Lihat Detail
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if ($totalPages > 1)
                        <nav aria-label="Search results pagination" class="mt-5">
                            <ul class="pagination justify-content-center">
                                @if ($currentPage > 1)
                                    <li class="page-item">
                                        <a class="page-link"
                                            href="?q={{ $query }}&page={{ $currentPage - 1 }}">Previous</a>
                                    </li>
                                @endif

                                @for ($i = 1; $i <= $totalPages; $i++)
                                    <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                                        <a class="page-link"
                                            href="?q={{ $query }}&page={{ $i }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                @if ($currentPage < $totalPages)
                                    <li class="page-item">
                                        <a class="page-link"
                                            href="?q={{ $query }}&page={{ $currentPage + 1 }}">Next</a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    @endif
                @else
                    <!-- No Results -->
                    <div class="card-custom">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Tidak ada hasil ditemukan</h5>
                            <p class="text-muted mb-4">Coba kata kunci lain atau periksa ejaan Anda</p>

                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <h6 class="mb-3">Saran pencarian:</h6>
                                    <div class="d-flex flex-wrap gap-2 justify-content-center">
                                        @foreach ($searchSuggestions as $suggestion)
                                            <a href="?q={{ $suggestion }}"
                                                class="badge bg-primary text-decoration-none">
                                                {{ $suggestion }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('ecommerce.products') }}" class="btn btn-primary">
                                    <i class="fas fa-th-large me-2"></i>Lihat Semua Produk
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
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
        function performSearch() {
            const query = document.getElementById('searchInput').value.trim();
            if (query) {
                window.location.href = `{{ route('ecommerce.search') }}?q=${encodeURIComponent(query)}`;
            }
        }

        function applyFilters() {
            const query = '{{ $query }}';
            const categories = Array.from(document.querySelectorAll('input[type="checkbox"][id^="cat"]:checked'))
                .map(cb => cb.value);
            const brands = Array.from(document.querySelectorAll('input[type="checkbox"][id^="brand"]:checked'))
                .map(cb => cb.value);
            const priceRange = document.querySelector('input[name="price_range"]:checked')?.value;
            const sort = document.getElementById('sortSelect').value;

            let url = new URL(window.location);
            if (query) url.searchParams.set('q', query);
            if (categories.length) url.searchParams.set('category', categories.join(','));
            if (brands.length) url.searchParams.set('brand', brands.join(','));
            if (priceRange) url.searchParams.set('price_range', priceRange);
            if (sort) url.searchParams.set('sort', sort);

            window.location.href = url.toString();
        }

        function addToCart(productId) {
            // Implementation for adding to cart
            console.log('Add to cart:', productId);
            // You can add AJAX call here to add product to cart
        }

        // Auto-search on Enter key
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });

        // Auto-apply filters when checkboxes change
        document.querySelectorAll('input[type="checkbox"], input[type="radio"]').forEach(input => {
            input.addEventListener('change', applyFilters);
        });

        // Auto-apply filters when sort changes
        document.getElementById('sortSelect').addEventListener('change', applyFilters);
    </script>
</body>

</html>
