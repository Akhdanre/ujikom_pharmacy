<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Pharmacy Management System') }} - Home</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    @vite(['resources/css/app.css'])
    
    <style>
        :root {
            --color-primary: #2E7D32;
            --color-secondary: #66BB6A;
            --color-accent: #43A047;
            --color-background: #FFFFFF;
            --color-text-primary: #212121;
            --color-text-secondary: #757575;
            --color-success: #66BB6A;
            --color-warning: #FFA726;
            --color-error: #E57373;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
            color: white;
            padding: 4rem 0;
        }
        
        .feature-card {
            border: 1px solid #E0E0E0;
            border-radius: 0.5rem;
            padding: 2rem;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 1rem;
            background: var(--color-secondary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn-custom-primary {
            background-color: var(--color-primary);
            border-color: var(--color-primary);
            color: white;
        }
        
        .btn-custom-primary:hover {
            background-color: var(--color-accent);
            border-color: var(--color-accent);
            color: white;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: var(--color-primary);">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                Pharmacy Management System
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-4">Selamat Datang di Pharmacy Management System</h1>
            <p class="lead mb-5">Sistem manajemen apotek yang modern dan terintegrasi untuk mengelola obat, transaksi, dan inventori dengan mudah.</p>
            
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('login') }}" class="btn btn-light btn-lg px-4">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    Login Admin
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Register
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="h1 fw-bold mb-3" style="color: var(--color-text-primary);">Fitur Utama</h2>
                    <p class="lead text-muted">Kelola apotek Anda dengan fitur-fitur canggih yang dirancang untuk efisiensi maksimal</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: white;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3v5a3 3 0 006 0v-5c0-1.657-1.343-3-3-3z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 20h14"/>
                            </svg>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: var(--color-text-primary);">Manajemen Obat</h4>
                        <p class="text-muted">Kelola inventori obat dengan mudah, termasuk stok, harga, dan tanggal kadaluarsa.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: white;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: var(--color-text-primary);">Transaksi Penjualan</h4>
                        <p class="text-muted">Proses transaksi penjualan dengan cepat dan akurat, termasuk pembayaran dan laporan.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: white;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"/>
                            </svg>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: var(--color-text-primary);">Pembelian dari Supplier</h4>
                        <p class="text-muted">Kelola pembelian obat dari supplier dengan sistem yang terintegrasi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Dashboard Preview Section -->
    <section class="py-5" style="background-color: #F5F5F5;">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="h1 fw-bold mb-3" style="color: var(--color-text-primary);">Dashboard yang Informatif</h2>
                    <p class="lead text-muted">Pantau performa apotek Anda dengan dashboard yang menampilkan data real-time</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card text-center border-0 shadow-sm">
                        <div class="card-body">
                            <div class="mb-3">
                                <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-success);">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3v5a3 3 0 006 0v-5c0-1.657-1.343-3-3-3z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 20h14"/>
                                </svg>
                            </div>
                            <h3 class="fw-bold" style="color: var(--color-text-primary);">128</h3>
                            <p class="text-muted mb-0">Total Obat</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="card text-center border-0 shadow-sm">
                        <div class="card-body">
                            <div class="mb-3">
                                <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-warning);">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                            </div>
                            <h3 class="fw-bold" style="color: var(--color-text-primary);">7</h3>
                            <p class="text-muted mb-0">Stok Menipis</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="card text-center border-0 shadow-sm">
                        <div class="card-body">
                            <div class="mb-3">
                                <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-error);">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="fw-bold" style="color: var(--color-text-primary);">3</h3>
                            <p class="text-muted mb-0">Obat Kadaluarsa</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="card text-center border-0 shadow-sm">
                        <div class="card-body">
                            <div class="mb-3">
                                <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-success);">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a5 5 0 00-10 0v2"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 20h14"/>
                                </svg>
                            </div>
                            <h3 class="fw-bold" style="color: var(--color-text-primary);">Rp 12.5M</h3>
                            <p class="text-muted mb-0">Total Penjualan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5">
        <div class="container text-center">
            <h2 class="h1 fw-bold mb-4" style="color: var(--color-text-primary);">Siap untuk Memulai?</h2>
            <p class="lead text-muted mb-5">Bergabunglah dengan sistem manajemen apotek terbaik untuk meningkatkan efisiensi bisnis Anda.</p>
            <a href="{{ route('login') }}" class="btn btn-custom-primary btn-lg px-5">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                Mulai Sekarang
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4" style="background-color: var(--color-text-primary); color: white;">
        <div class="container text-center">
            <p class="mb-0">&copy; 2024 Pharmacy Management System. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 