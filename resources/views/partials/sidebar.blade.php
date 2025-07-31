<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? '' : 'collapsed' }}"
                href="{{ route('admin.dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.medicine*') ? '' : 'collapsed' }}"
                href="{{ route('admin.medicine') }}">
                <i class="bi bi-capsule"></i>
                <span>Obat</span>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.purchase*') ? '' : 'collapsed' }}" href="{{ route('admin.purchase') }}">
                <i class="bi bi-cart-plus"></i>
                <span>Transaksi Pembelian</span>
            </a>
        </li> --}}
        {{-- <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.sales*') ? '' : 'collapsed' }}"
                href="{{ route('admin.sales') }}">
                <i class="bi bi-cart-check"></i>
                <span>Transaksi Penjualan</span>
            </a>
        </li> --}}
        {{-- <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.customers*') ? '' : 'collapsed' }}"
                href="{{ route('admin.customers') }}">
                <i class="bi bi-people"></i>
                <span>Pelanggan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.suppliers*') ? '' : 'collapsed' }}"
                href="{{ route('admin.suppliers') }}">
                <i class="bi bi-truck"></i>
                <span>Supplier</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.reports*') ? '' : 'collapsed' }}"
                href="{{ route('admin.reports') }}">
                <i class="bi bi-graph-up"></i>
                <span>Laporan</span>
            </a>
        </li> --}}

    </ul>

</aside>
