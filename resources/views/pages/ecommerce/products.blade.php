@extends('components.layout.app')

@section('title', 'Produk - DrigSell')

@section('content')
    <h1>{{ $message }}</h1>
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
