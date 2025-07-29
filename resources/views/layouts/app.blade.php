<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Dashboard')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="d-flex" style="height: 100vh; overflow: hidden;">
        <!-- Sidebar -->
        <div class="sidebar d-none d-md-block" style="width: 280px; height: 100vh; overflow-y: auto;">
            <div class="d-flex flex-column h-100">
                <!-- Logo -->
                <div class="sidebar-header">
                    <h1 class="h4 mb-0 text-white fw-bold">
                        {{ config('app.name', 'Pharmacy') }}
                    </h1>
                </div>
                
                <!-- Navigation -->
                <div class="flex-grow-1 overflow-auto">
                    <nav class="sidebar-nav p-3">
                        <a href="{{ route('dashboard') }}" 
                           class="nav-link d-flex align-items-center {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <svg class="me-3" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z" />
                            </svg>
                            Dashboard
                        </a>
                        
                        <a href="{{ route('medicines.index') }}" 
                           class="nav-link d-flex align-items-center {{ request()->routeIs('medicines.*') ? 'active' : '' }}">
                            <svg class="me-3" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Medicines
                        </a>
                        
                        <a href="{{ route('transactions.index') }}" 
                           class="nav-link d-flex align-items-center {{ request()->routeIs('transactions.*') ? 'active' : '' }}">
                            <svg class="me-3" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Sales
                        </a>
                        
                        <a href="{{ route('buy-transactions.index') }}" 
                           class="nav-link d-flex align-items-center {{ request()->routeIs('buy-transactions.*') ? 'active' : '' }}">
                            <svg class="me-3" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01" />
                            </svg>
                            Buy Transactions
                        </a>
                        
                        <a href="{{ route('medicines.low-stock') }}" 
                           class="nav-link d-flex align-items-center {{ request()->routeIs('medicines.low-stock') ? 'active' : '' }}">
                            <svg class="me-3" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                            Low Stock
                        </a>
                        
                        <a href="{{ route('medicines.expired') }}" 
                           class="nav-link d-flex align-items-center {{ request()->routeIs('medicines.expired') ? 'active' : '' }}">
                            <svg class="me-3" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Expired
                        </a>
                        
                        <a href="{{ route('medicines.inventory-report') }}" 
                           class="nav-link d-flex align-items-center {{ request()->routeIs('medicines.inventory-report') ? 'active' : '' }}">
                            <svg class="me-3" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Reports
                        </a>
                    </nav>
                </div>
                
                <!-- User Menu -->
                <div class="border-top border-white border-opacity-25 p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background-color: var(--color-cta);">
                                <span class="small fw-medium text-white">
                                    {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                                </span>
                            </div>
                        </div>
                        <div class="ms-3">
                            <p class="small fw-medium text-white mb-0">{{ Auth::user()->name ?? 'User' }}</p>
                            <p class="small text-white-50 mb-0">{{ Auth::user()->email ?? 'user@example.com' }}</p>
                        </div>
                        <div class="ms-auto">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" 
                                        class="btn btn-link text-white-50 p-0 border-0">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-grow-1 d-flex flex-column" style="height: 100vh; overflow: hidden;">
            <!-- Top bar for mobile -->
            <div class="d-md-none p-3">
                <button type="button" 
                        class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 48px; height: 48px;"
                        id="mobile-menu-button">
                    <span class="visually-hidden">Open sidebar</span>
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Page Content -->
            <main class="flex-grow-1 overflow-auto">
                <div class="p-4">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile sidebar overlay -->
    <div class="offcanvas offcanvas-start mobile-sidebar" tabindex="-1" id="mobile-sidebar" style="width: 280px;">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title text-white">{{ config('app.name', 'Pharmacy') }}</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-0">
            <nav class="sidebar-nav p-3">
                <a href="{{ route('dashboard') }}" 
                   class="nav-link d-flex align-items-center {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <svg class="me-3" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z" />
                    </svg>
                    Dashboard
                </a>
                
                <a href="{{ route('medicines.index') }}" 
                   class="nav-link d-flex align-items-center {{ request()->routeIs('medicines.*') ? 'active' : '' }}">
                    <svg class="me-3" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Medicines
                </a>
                
                <a href="{{ route('transactions.index') }}" 
                   class="nav-link d-flex align-items-center {{ request()->routeIs('transactions.*') ? 'active' : '' }}">
                    <svg class="me-3" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Sales
                </a>
                
                <a href="{{ route('buy-transactions.index') }}" 
                   class="nav-link d-flex align-items-center {{ request()->routeIs('buy-transactions.*') ? 'active' : '' }}">
                    <svg class="me-3" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01" />
                    </svg>
                    Buy Transactions
                </a>
                
                <a href="{{ route('medicines.low-stock') }}" 
                   class="nav-link d-flex align-items-center {{ request()->routeIs('medicines.low-stock') ? 'active' : '' }}">
                    <svg class="me-3" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                    Low Stock
                </a>
                
                <a href="{{ route('medicines.expired') }}" 
                   class="nav-link d-flex align-items-center {{ request()->routeIs('medicines.expired') ? 'active' : '' }}">
                    <svg class="me-3" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Expired
                </a>
                
                <a href="{{ route('medicines.inventory-report') }}" 
                   class="nav-link d-flex align-items-center {{ request()->routeIs('medicines.inventory-report') ? 'active' : '' }}">
                    <svg class="me-3" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Reports
                </a>
            </nav>
            
            <div class="border-top border-white border-opacity-25 p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background-color: var(--color-cta);">
                            <span class="small fw-medium text-white">
                                {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                            </span>
                        </div>
                    </div>
                    <div class="ms-3">
                        <p class="small fw-medium text-white mb-0">{{ Auth::user()->name ?? 'User' }}</p>
                        <p class="small text-white-50 mb-0">{{ Auth::user()->email ?? 'user@example.com' }}</p>
                    </div>
                    <div class="ms-auto">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" 
                                    class="btn btn-link text-white-50 p-0 border-0">
                                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript for mobile sidebar -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileSidebar = new bootstrap.Offcanvas(document.getElementById('mobile-sidebar'));
            
            if (mobileMenuButton) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileSidebar.show();
                });
            }
        });
    </script>
</body>
</html> 