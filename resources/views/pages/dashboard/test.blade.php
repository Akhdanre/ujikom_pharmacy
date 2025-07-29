@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Welcome Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h1>Welcome to Pharmacy Dashboard</h1>
            <p>Here's a quick overview of your pharmacy's performance.</p>
        </div>
    </div>

    <!-- Statistic Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Medicines</h5>
                    <h2 class="card-text">128</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Low Stock</h5>
                    <h2 class="card-text">7</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Expired</h5>
                    <h2 class="card-text">3</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Sales (This Month)</h5>
                    <h2 class="card-text">Rp 12,500,000</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mb-5">
        <div class="d-flex flex-wrap gap-3">
            <a href="{{ route('medicines.create') }}" class="btn btn-primary btn-lg">+ Add Medicine</a>
            <a href="{{ route('transactions.create') }}" class="btn btn-success btn-lg">+ New Sale</a>
            <a href="{{ route('buy-transactions.create') }}" class="btn btn-info btn-lg">+ New Purchase</a>
        </div>
    </div>
</div>
@endsection 