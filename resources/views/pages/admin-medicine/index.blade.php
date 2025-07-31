@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Manajemen Obat</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Daftar Obat</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Tombol untuk membuat data obat baru -->
            <div class="col-12 mb-4">
                <a href="" class="btn btn-lg btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Obat Baru
                </a>
            </div>

            <!-- Statistik Obat -->
            <div class="col-xxl-3 col-md-6 mb-4">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Obat <span>| Tersedia</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-capsule"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $statistics['total_medicines'] ?? 0 }}</h6>
                                <span class="text-success small pt-1 fw-bold">Aktif</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stok Menipis Card -->
            <div class="col-xxl-3 col-md-6 mb-4">
                <div class="card info-card customers-card">
                    <div class="card-body">
                        <h5 class="card-title">Stok Menipis <span>| Perlu Restock</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $statistics['low_stock_count'] ?? 0 }}</h6>
                                <span class="text-warning small pt-1 fw-bold">Perhatian</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Habis Stok Card -->
            <div class="col-xxl-3 col-md-6 mb-4">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Habis Stok <span>| Out of Stock</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-x-circle"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $statistics['out_of_stock_count'] ?? 0 }}</h6>
                                <span class="text-danger small pt-1 fw-bold">Kritis</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kadaluarsa Card -->
            <div class="col-xxl-3 col-md-6 mb-4">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Kadaluarsa <span>| Expired</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-calendar-x"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $statistics['expired_count'] ?? 0 }}</h6>
                                <span class="text-danger small pt-1 fw-bold">Tidak Aman</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter & Pencarian -->
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Filter & Pencarian</h5>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="search">Cari Obat</label>
                                    <input type="text" class="form-control" wire:model="search"
                                        placeholder="Nama obat...">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="category">Kategori</label>
                                    <select class="form-select" wire:model="category">
                                        <option value="">Semua Kategori</option>
                                        <option value="analgesik">Analgesik</option>
                                        <option value="antibiotik">Antibiotik</option>
                                        <option value="vitamin">Vitamin</option>
                                        <option value="antasida">Antasida</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="stockStatus">Status Stok</label>
                                    <select class="form-select" wire:model="stockStatus">
                                        <option value="">Semua Status</option>
                                        <option value="available">Tersedia</option>
                                        <option value="low_stock">Stok Menipis</option>
                                        <option value="out_of_stock">Habis Stok</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="expiryStatus">Status Kadaluarsa</label>
                                    <select class="form-select" wire:model="expiryStatus">
                                        <option value="">Semua Status</option>
                                        <option value="expired">Kadaluarsa</option>
                                        <option value="expiring_soon">Akan Kadaluarsa</option>
                                        <option value="safe">Aman</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Obat -->
            <div class="col-12">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Obat <span>| Semua Produk</span></h5>

                        <!-- Tabel Daftar Obat -->
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Obat</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Status Stok</th>
                                    <th scope="col">Kadaluarsa</th>
                                    <th scope="col">Status Kadaluarsa</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($medicines as $index => $medicine)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>{{ $medicine->medicine_name }}</td>
                                        <td>{{ $medicine->category->name ?? 'Umum' }}</td>
                                        <td>{{ $medicine->getFormattedPrice() }}</td>
                                        <td>{{ $medicine->stock }}</td>
                                        <td>{{ $medicine->getStockStatus() }}</td>
                                        <td>{{ $medicine->getFormattedExpiry() }}</td>
                                        <td>{{ $medicine->getExpiryStatus() }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#viewModal{{ $medicine->id }}">
                                                Lihat
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        {{ $medicines->links('vendor.pagination.custom-pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
