@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Welcome Header -->
    <x-shared.components.layout.page-header 
        title="Welcome to Pharmacy Dashboard"
        subtitle="Here's a quick overview of your pharmacy's performance." />

    <!-- Statistic Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <x-shared.components.cards.stat-card 
                title="Total Medicines"
                value="128"
                color="success"
                icon="<path d='M12 8c-1.657 0-3 1.343-3 3v5a3 3 0 006 0v-5c0-1.657-1.343-3-3-3z'/><path d='M5 20h14'/>" />
        </div>
        <div class="col-md-3">
            <x-shared.components.cards.stat-card 
                title="Low Stock"
                value="7"
                color="warning"
                icon="<path d='M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z'/>" />
        </div>
        <div class="col-md-3">
            <x-shared.components.cards.stat-card 
                title="Expired"
                value="3"
                color="error"
                icon="<path d='M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'/>" />
        </div>
        <div class="col-md-3">
            <x-shared.components.cards.stat-card 
                title="Total Sales (This Month)"
                value="Rp 12,500,000"
                color="success"
                icon="<path d='M17 9V7a5 5 0 00-10 0v2'/><path d='M5 20h14'/>" />
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mb-5">
        <div class="d-flex flex-wrap gap-3">
            <a href="{{ route('medicines.create') }}" class="btn btn-primary btn-lg">+ Add Medicine</a>
            <a href="{{ route('transactions.create') }}" class="btn btn-success btn-lg">+ New Sale</a>
            <a href="{{ route('buy-transactions.create') }}" class="btn btn-info btn-lg">+ New Purchase</a>
            <a href="{{ route('medicines.low-stock') }}" class="btn btn-warning btn-lg">View Low Stock</a>
            <a href="{{ route('medicines.expired') }}" class="btn btn-danger btn-lg">View Expired</a>
            <a href="{{ route('medicines.inventory-report') }}" class="btn btn-secondary btn-lg">Inventory Report</a>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row g-4 mb-5">
        <!-- Sales Chart -->
        <div class="col-lg-8">
            <x-charts.chart-container 
                title="Sales Performance"
                id="salesChart"
                height="300px"
                :periodSelector="true" />
        </div>

        <!-- Purchase Chart -->
        <div class="col-lg-4">
            <x-shared.components.charts.chart-container 
                title="Purchase vs Sales"
                id="purchaseChart"
                height="300px" />
        </div>
    </div>

    <!-- Top Selling Products -->
    <div class="row g-4 mb-5">
        <div class="col-lg-6">
            <x-shared.components.charts.chart-container 
                title="Top Selling Products"
                id="topProductsChart"
                height="250px" />
        </div>

        <!-- Revenue Trend -->
        <div class="col-lg-6">
            <x-shared.components.charts.chart-container 
                title="Revenue Trend"
                id="revenueChart"
                height="250px" />
        </div>
    </div>

    <!-- Quick Access to Transactions -->
    <x-shared.components.cards.content-card>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 fw-bold mb-2" style="color: var(--color-text-primary);">Recent Activity</h2>
                <p class="text-muted mb-0">View and manage all your pharmacy transactions</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('transactions.index') }}" class="btn btn-primary">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    View Sales
                </a>
                <a href="{{ route('buy-transactions.index') }}" class="btn btn-info">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01" />
                    </svg>
                    View Purchases
                </a>
            </div>
        </div>
    </x-shared.components.cards.content-card>
</div>

<!-- Chart.js Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sales Chart
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Sales (Rp)',
                data: [2500000, 3200000, 2800000, 4100000, 3800000, 5200000, 4800000],
                borderColor: '#66BB6A',
                backgroundColor: 'rgba(102, 187, 106, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                        }
                    }
                }
            }
        }
    });

    // Purchase vs Sales Chart
    const purchaseCtx = document.getElementById('purchaseChart').getContext('2d');
    const purchaseChart = new Chart(purchaseCtx, {
        type: 'doughnut',
        data: {
            labels: ['Sales', 'Purchase'],
            datasets: [{
                data: [12500000, 8500000],
                backgroundColor: ['#66BB6A', '#FFA726'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Top Products Chart
    const topProductsCtx = document.getElementById('topProductsChart').getContext('2d');
    const topProductsChart = new Chart(topProductsCtx, {
        type: 'bar',
        data: {
            labels: ['Paracetamol', 'Amoxicillin', 'Ibuprofen', 'Vitamin C', 'Omeprazole'],
            datasets: [{
                label: 'Units Sold',
                data: [45, 38, 32, 28, 25],
                backgroundColor: [
                    '#66BB6A',
                    '#FFA726',
                    '#E57373',
                    '#9BC1BC',
                    '#5CA4A9'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Revenue Trend Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Revenue',
                data: [8500000, 9200000, 7800000, 10500000, 12500000, 11800000],
                borderColor: '#5CA4A9',
                backgroundColor: 'rgba(92, 164, 169, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                        }
                    }
                }
            }
        }
    });

    // Period selector functionality
    const periodButtons = document.querySelectorAll('[data-period]');
    periodButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            periodButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');
            
            // Update chart data based on period (dummy data for demo)
            const period = this.dataset.period;
            let newData = [];
            let newLabels = [];
            
            if (period === 'week') {
                newLabels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                newData = [2500000, 3200000, 2800000, 4100000, 3800000, 5200000, 4800000];
            } else if (period === 'month') {
                newLabels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
                newData = [15000000, 18000000, 22000000, 25000000];
            } else if (period === 'year') {
                newLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                newData = [8500000, 9200000, 7800000, 10500000, 12500000, 11800000, 13200000, 14500000, 13800000, 15600000, 16800000, 17500000];
            }
            
            salesChart.data.labels = newLabels;
            salesChart.data.datasets[0].data = newData;
            salesChart.update();
        });
    });
});
</script>
@endsection
