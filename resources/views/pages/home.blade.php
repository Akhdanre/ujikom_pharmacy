<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Apotek Sehat') }} - Toko Obat Online</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Livewire Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <div class="h-8 w-8 bg-green-600 rounded-full flex items-center justify-center">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <span class="ml-2 text-xl font-bold text-gray-900">Apotek Sehat</span>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                        Login Admin
                    </a>
                    <a href="{{ route('register') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-green-500 to-blue-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">Selamat Datang di Apotek Sehat</h1>
                <p class="text-xl mb-8">Temukan obat yang Anda butuhkan dengan mudah dan aman</p>
                
                <!-- Search Bar -->
                <form action="{{ route('home') }}" method="GET" class="max-w-2xl mx-auto">
                    <div class="flex">
                        <input type="text" name="search" value="{{ $search }}" 
                               class="flex-1 px-4 py-3 rounded-l-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500"
                               placeholder="Cari obat, vitamin, atau suplemen...">
                        <button type="submit" 
                                class="bg-green-600 hover:bg-green-700 px-6 py-3 rounded-r-lg font-medium">
                            Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    @if(count($categories) > 0)
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Kategori Obat</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            <a href="{{ route('home') }}" 
               class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow text-center {{ !$category ? 'ring-2 ring-green-500' : '' }}">
                <div class="text-green-600 mb-2">
                    <svg class="h-8 w-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <span class="text-sm font-medium">Semua</span>
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('home', ['category' => $cat]) }}" 
               class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow text-center {{ $category === $cat ? 'ring-2 ring-green-500' : '' }}">
                <div class="text-green-600 mb-2">
                    <svg class="h-8 w-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <span class="text-sm font-medium">{{ $cat }}</span>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Featured Products -->
    @if(count($featuredMedicines) > 0)
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Unggulan</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredMedicines as $medicine)
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden">
                <div class="p-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-medium text-gray-500">{{ $medicine->code }}</span>
                        <span class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded-full">
                            {{ $medicine->category }}
                        </span>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">{{ $medicine->name }}</h3>
                    <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $medicine->description }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-green-600">{{ $medicine->getFormattedPrice() }}</span>
                        <span class="text-sm text-gray-500">Stok: {{ $medicine->stock_quantity }}</span>
                    </div>
                </div>
                <div class="px-4 pb-4">
                    <a href="{{ route('medicine.detail', $medicine->id) }}" 
                       class="block w-full bg-green-600 hover:bg-green-700 text-white text-center py-2 rounded-md font-medium">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- All Products -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900">
                @if($category)
                    Produk {{ $category }}
                @else
                    Semua Produk
                @endif
            </h2>
            <span class="text-gray-600">{{ count($medicines) }} produk ditemukan</span>
        </div>

        @if(count($medicines) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($medicines as $medicine)
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden">
                <div class="p-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-medium text-gray-500">{{ $medicine->code }}</span>
                        <span class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded-full">
                            {{ $medicine->category }}
                        </span>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">{{ $medicine->name }}</h3>
                    <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $medicine->description }}</p>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-lg font-bold text-green-600">{{ $medicine->getFormattedPrice() }}</span>
                        <span class="text-sm text-gray-500">Stok: {{ $medicine->stock_quantity }}</span>
                    </div>
                    <a href="{{ route('medicine.detail', $medicine->id) }}" 
                       class="block w-full bg-green-600 hover:bg-green-700 text-white text-center py-2 rounded-md font-medium">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <div class="text-gray-400 mb-4">
                <svg class="h-16 w-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada produk ditemukan</h3>
            <p class="text-gray-600">Coba ubah kata kunci pencarian atau kategori</p>
        </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Apotek Sehat</h3>
                    <p class="text-gray-400">Menyediakan obat berkualitas dengan pelayanan terbaik untuk kesehatan Anda.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Layanan</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Resep Online</a></li>
                        <li><a href="#" class="hover:text-white">Konsultasi</a></li>
                        <li><a href="#" class="hover:text-white">Pengiriman</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Informasi</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-white">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>Jl. Apotek No. 123</li>
                        <li>Jakarta, Indonesia</li>
                        <li>Telp: (021) 123-4567</li>
                        <li>Email: info@apoteksehat.com</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 Apotek Sehat. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Livewire Scripts -->
    @livewireScripts
</body>
</html> 