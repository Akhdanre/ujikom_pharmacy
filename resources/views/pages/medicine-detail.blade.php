<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $medicine['name'] }} - {{ config('app.name', 'Apotek Sehat') }}</title>
    
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
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center">
                        <div class="h-8 w-8 bg-green-600 rounded-full flex items-center justify-center">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <span class="ml-2 text-xl font-bold text-gray-900">Apotek Sehat</span>
                    </a>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                        Kembali ke Beranda
                    </a>
                    <a href="{{ route('login') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Login Admin
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-4">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700">
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('home', ['category' => $medicine['category']]) }}" class="ml-4 text-gray-500 hover:text-gray-700">
                                {{ $medicine['category'] }}
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-4 text-gray-700">{{ $medicine['name'] }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Product Detail -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Product Image Placeholder -->
            <div class="bg-white rounded-lg shadow-md p-8">
                <div class="aspect-w-1 aspect-h-1 w-full">
                    <div class="bg-gray-200 rounded-lg flex items-center justify-center h-96">
                        <div class="text-center">
                            <svg class="h-24 w-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            <p class="text-gray-500">Gambar Produk</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="bg-white rounded-lg shadow-md p-8">
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-500">{{ $medicine->code }}</span>
                        <span class="text-sm px-3 py-1 bg-green-100 text-green-800 rounded-full">
                            {{ $medicine->category }}
                        </span>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $medicine->name }}</h1>
                    <div class="flex items-center mb-4">
                        <span class="text-3xl font-bold text-green-600">{{ $medicine->getFormattedPrice() }}</span>
                        <span class="ml-4 text-sm text-gray-500">Stok: {{ $medicine->stock_quantity }}</span>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Deskripsi</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $medicine->description }}</p>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Informasi Produk</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <span class="text-sm font-medium text-gray-500">Kode Produk</span>
                            <p class="text-gray-900">{{ $medicine->code }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Kategori</span>
                            <p class="text-gray-900">{{ $medicine->category }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Stok Tersedia</span>
                            <p class="text-gray-900">{{ $medicine->stock_quantity }} unit</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Status</span>
                            <p class="text-gray-900">
                                @if($medicine->stock_quantity > 0)
                                    <span class="text-green-600">Tersedia</span>
                                @else
                                    <span class="text-red-600">Habis</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div class="border-t pt-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Untuk pemesanan, silakan hubungi admin</p>
                            <p class="text-sm text-gray-500">Telp: (021) 123-4567</p>
                        </div>
                        <a href="{{ route('login') }}" 
                           class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-md font-medium">
                            Hubungi Admin
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if(count($relatedMedicines) > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Terkait</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedMedicines as $related)
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden">
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-medium text-gray-500">{{ $related->code }}</span>
                            <span class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded-full">
                                {{ $related->category }}
                            </span>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">{{ $related->name }}</h3>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $related->description }}</p>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-lg font-bold text-green-600">{{ $related->getFormattedPrice() }}</span>
                            <span class="text-sm text-gray-500">Stok: {{ $related->stock_quantity }}</span>
                        </div>
                        <a href="{{ route('medicine.detail', $related->id) }}" 
                           class="block w-full bg-green-600 hover:bg-green-700 text-white text-center py-2 rounded-md font-medium">
                            Lihat Detail
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12">
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