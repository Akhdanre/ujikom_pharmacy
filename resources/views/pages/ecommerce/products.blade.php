@extends('components.layout.app')

@section('title', 'Produk - DrigSell')

@section('content')



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
        <div class="row">
            <!-- Filter Sidebar -->
            <div class="col-lg-3">
                <div class="card-custom sticky-top" style="top: 100px;">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-filter me-2"></i>Filter Produk</h6>
                    </div>
                    <div class="card-body">
                        <!-- Search -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Cari Produk</label>
                            <input type="text" class="form-control" placeholder="Nama produk..."
                                value="{{ $search }}">
                        </div>

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

                        {{-- <!-- Brands -->
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
                        </div> --}}

                        {{-- <!-- Price Range -->
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
                        </div> --}}

                        <!-- Sort -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Urutkan</label>
                            <select class="form-select" id="sortSelect">
                                <option value="newest" {{ $sort == 'newest' ? 'selected' : '' }}>Terbaru</option>
                                <option value="price_low" {{ $sort == 'price_low' ? 'selected' : '' }}>Harga Terendah
                                </option>
                                <option value="price_high" {{ $sort == 'price_high' ? 'selected' : '' }}>Harga
                                    Tertinggi</option>
                                <option value="rating" {{ $sort == 'rating' ? 'selected' : '' }}>Rating Tertinggi
                                </option>
                                <option value="popular" {{ $sort == 'popular' ? 'selected' : '' }}>Terpopuler</option>
                            </select>
                        </div>

                        <!-- Apply Filters -->
                        <button class="btn btn-primary w-100" onclick="applyFilters()">
                            <i class="fas fa-search me-2"></i>Terapkan Filter
                        </button>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="col-lg-9">
                <!-- Products Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="mb-1">Semua Produk</h4>
                        {{-- <!-- <p class="text-muted mb-0">Menampilkan {{ $totalProducts }} produk</p> --> --}}
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="me-3">Tampilkan:</span>
                        <select class="form-select form-select-sm" style="width: auto;">
                            <option value="8">8 per halaman</option>
                            <option value="16">16 per halaman</option>
                            <option value="24">24 per halaman</option>
                        </select>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="product-card h-100">
                                <div class="position-relative">
                                    <img src="{{ $product['image'] }}" class="card-img-top" alt="{{ $product['name'] }}"
                                        style="height: 200px; object-fit: cover;">
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

                                    <div class="d-flex align-items-center mb-2">
                                        <div class="text-warning me-1">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star{{ $i <= $product['rating'] ? '' : '-o' }}"></i>
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
                    <nav aria-label="Products pagination" class="mt-5">
                        <ul class="pagination justify-content-center">
                            @if ($currentPage > 1)
                                <li class="page-item">
                                    <a class="page-link" href="?page={{ $currentPage - 1 }}">Previous</a>
                                </li>
                            @endif

                            @for ($i = 1; $i <= $totalPages; $i++)
                                <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                                    <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                                </li>
                            @endfor

                            @if ($currentPage < $totalPages)
                                <li class="page-item">
                                    <a class="page-link" href="?page={{ $currentPage + 1 }}">Next</a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                @endif
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        function applyFilters() {
            const search = document.querySelector('input[type="text"]').value;
            const categories = Array.from(document.querySelectorAll('input[type="checkbox"][id^="cat"]:checked'))
                .map(cb => cb.value);
            const brands = Array.from(document.querySelectorAll('input[type="checkbox"][id^="brand"]:checked'))
                .map(cb => cb.value);
            const priceRange = document.querySelector('input[name="price_range"]:checked')?.value;
            const sort = document.getElementById('sortSelect').value;

            let url = new URL(window.location);
            if (search) url.searchParams.set('search', search);
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
            alert('Produk berhasil ditambahkan ke keranjang!');
        }

        // Auto-apply filters when checkboxes change
        document.querySelectorAll('input[type="checkbox"], input[type="radio"]').forEach(input => {
            input.addEventListener('change', applyFilters);
        });

        // Auto-apply filters when sort changes
        document.getElementById('sortSelect').addEventListener('change', applyFilters);
    </script>
@endsection
