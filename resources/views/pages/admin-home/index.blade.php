@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard Apotek</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Total Obat Card -->
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                crlass="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Hari Ini</a></li>
                            <li><a class="dropdown-item" href="#">Bulan Ini</a></li>
                            <li><a class="dropdown-item" href="#">Tahun Ini</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Total Obat <span>| Stok Tersedia</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-capsule"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ number_format($totalMedicines) }}</h6>
                                <span class="text-success small pt-1 fw-bold">+12%</span> <span
                                    class="text-muted small pt-2 ps-1">dari bulan lalu</span>

                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- End Total Obat Card -->

            <!-- Pendapatan Card -->
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Hari Ini</a></li>
                            <li><a class="dropdown-item" href="#">Bulan Ini</a></li>
                            <li><a class="dropdown-item" href="#">Tahun Ini</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Pendapatan <span>| Bulan Ini</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                                <h6>Rp {{ number_format($currentMonthRevenue) }}</h6>
                                <span class="text-success small pt-1 fw-bold">+8%</span> <span
                                    class="text-muted small pt-2 ps-1">dari bulan lalu</span>

                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- End Pendapatan Card -->

            <!-- Transaksi Penjualan Card -->
            <div class="col-xxl-4 col-xl-12">

                <div class="card info-card customers-card">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Hari Ini</a></li>
                            <li><a class="dropdown-item" href="#">Bulan Ini</a></li>
                            <li><a class="dropdown-item" href="#">Tahun Ini</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Transaksi Penjualan <span>| Hari Ini</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-cart-check"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $todayTransactions }}</h6>
                                <span class="text-success small pt-1 fw-bold">+15%</span> <span
                                    class="text-muted small pt-2 ps-1">dari kemarin</span>

                            </div>
                        </div>

                    </div>
                </div>

            </div><!-- End Transaksi Penjualan Card -->

            <!-- Grafik Penjualan -->
            <div class="col-12">
                <div class="card">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Hari Ini</a></li>
                            <li><a class="dropdown-item" href="#">Bulan Ini</a></li>
                            <li><a class="dropdown-item" href="#">Tahun Ini</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Grafik Penjualan <span>/7 Hari Terakhir</span></h5>

                        <!-- Line Chart -->
                        <div style="position: relative; height: 350px;">
                            <canvas id="reportsChart"></canvas>
                        </div>

                        {{-- <script src="{{ asset('/vendor/chart.js/chart.js') }}"></script> --}}
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const ctx = document.getElementById('reportsChart').getContext('2d');

                                new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: @json($salesData['labels']),
                                        datasets: [{
                                            label: 'Penjualan (Item)',
                                            data: @json($salesData['sales']),
                                            borderColor: '#4154f1',
                                            backgroundColor: 'rgba(65, 84, 241, 0.1)',
                                            borderWidth: 2,
                                            fill: true,
                                            tension: 0.4,
                                            yAxisID: 'y'
                                        }, {
                                            label: 'Pendapatan (Juta Rp)',
                                            data: @json($salesData['revenue']),
                                            borderColor: '#2eca6a',
                                            backgroundColor: 'rgba(46, 202, 106, 0.1)',
                                            borderWidth: 2,
                                            fill: true,
                                            tension: 0.4,
                                            yAxisID: 'y1'
                                        }, {
                                            label: 'Pelanggan',
                                            data: @json($salesData['customers']),
                                            borderColor: '#ff771d',
                                            backgroundColor: 'rgba(255, 119, 29, 0.1)',
                                            borderWidth: 2,
                                            fill: true,
                                            tension: 0.4,
                                            yAxisID: 'y2'
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        interaction: {
                                            mode: 'index',
                                            intersect: false,
                                        },
                                        plugins: {
                                            legend: {
                                                position: 'top',
                                            },
                                            tooltip: {
                                                callbacks: {
                                                    label: function(context) {
                                                        let label = context.dataset.label || '';
                                                        if (label) {
                                                            label += ': ';
                                                        }
                                                        if (context.dataset.label === 'Pendapatan (Juta Rp)') {
                                                            label += 'Rp ' + context.parsed.y + ' juta';
                                                        } else if (context.dataset.label === 'Penjualan (Item)') {
                                                            label += context.parsed.y + ' item';
                                                        } else {
                                                            label += context.parsed.y + ' orang';
                                                        }
                                                        return label;
                                                    }
                                                }
                                            }
                                        },
                                        scales: {
                                            x: {
                                                display: true,
                                                title: {
                                                    display: true,
                                                    text: 'Hari'
                                                }
                                            },
                                            y: {
                                                type: 'linear',
                                                display: true,
                                                position: 'left',
                                                title: {
                                                    display: true,
                                                    text: 'Penjualan (Item)'
                                                }
                                            },
                                            y1: {
                                                type: 'linear',
                                                display: true,
                                                position: 'right',
                                                title: {
                                                    display: true,
                                                    text: 'Pendapatan (Juta Rp)'
                                                },
                                                grid: {
                                                    drawOnChartArea: false,
                                                },
                                            },
                                            y2: {
                                                type: 'linear',
                                                display: true,
                                                position: 'right',
                                                title: {
                                                    display: true,
                                                    text: 'Pelanggan'
                                                },
                                                grid: {
                                                    drawOnChartArea: false,
                                                },
                                            }
                                        }
                                    }
                                });
                            });
                        </script>
                        <!-- End Line Chart -->

                    </div>

                </div>
            </div><!-- End Grafik Penjualan -->

            <!-- Transaksi Terbaru -->
            <div class="col-12">
                <div class="card recent-sales overflow-auto">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Hari Ini</a></li>
                            <li><a class="dropdown-item" href="#">Bulan Ini</a></li>
                            <li><a class="dropdown-item" href="#">Tahun Ini</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Transaksi Terbaru <span>| Hari Ini</span></h5>

                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Pelanggan</th>
                                    <th scope="col">Obat</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentTransactions as $transaction)
                                <tr>
                                    <th scope="row"><a
                                            href="#">#{{ $transaction['transaction_id'] }}</a></th>
                                    <td>{{ $transaction['user']['name'] ?? 'Pelanggan' }}</td>
                                    <td>
                                        @php
                                            $details = $transaction['details'];
                                            $firstTwoDetails = array_slice($details, 0, 2);
                                            $remainingCount = count($details) - 2;
                                        @endphp
                                        @foreach ($firstTwoDetails as $detail)
                                            <a href="#"
                                                class="text-primary">{{ $detail['medicine']['medicine_name'] ?? 'Obat' }}</a>
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                        @if ($remainingCount > 0)
                                            <span class="text-muted">+{{ $remainingCount }}
                                                lainnya</span>
                                        @endif
                                    </td>
                                    <td>Rp {{ number_format($transaction['total_price']) }}</td>
                                    <td>
                                        @php
                                            $status = $transaction['status'];
                                            $badgeClass = match($status) {
                                                'Selesai' => 'bg-success',
                                                'Proses' => 'bg-warning',
                                                'Dibatalkan' => 'bg-danger',
                                                default => 'bg-secondary'
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $status }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada transaksi terbaru</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>

                </div>
            </div><!-- End Transaksi Terbaru -->

            <!-- Obat Terlaris -->
            <div class="col-12">
                <div class="card top-selling overflow-auto">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Hari Ini</a></li>
                            <li><a class="dropdown-item" href="#">Bulan Ini</a></li>
                            <li><a class="dropdown-item" href="#">Tahun Ini</a></li>
                        </ul>
                    </div>

                    <div class="card-body pb-0">
                        <h5 class="card-title">Obat Terlaris <span>| Bulan Ini</span></h5>

                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">Preview</th>
                                    <th scope="col">Nama Obat</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Terjual</th>
                                    <th scope="col">Pendapatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($topSellingMedicines as $medicine)
                                <tr>
                                    <th scope="row"><a href="#"><img
                                                src="{{ asset('img/product-1.jpg') }}" alt=""></a>
                                    </th>
                                    <td><a href="#"
                                            class="text-primary fw-bold">{{ $medicine['name'] }}</a></td>
                                    <td>Rp {{ number_format($medicine['price']) }}</td>
                                    <td class="fw-bold">{{ $medicine['total_sold'] }}</td>
                                    <td>Rp {{ number_format($medicine['total_revenue']) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data obat terlaris</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>

                </div>
            </div><!-- End Obat Terlaris -->

        </div>
    </section>
@endsection
