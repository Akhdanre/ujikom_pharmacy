@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <x-shared.components.layout.page-header 
        title="Transactions"
        subtitle="Manage all pharmacy transactions"
        :action="route('transactions.create')"
        actionText="New Transaction"
        actionIcon="<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 6v6m0 0v6m0-6h6m-6 0H6'/>" />

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filters and Search -->
    <x-shared.components.filters.filter-panel>
        <div class="col-md-3">
            <label for="status-filter" class="form-label">Status</label>
            <select class="form-select" id="status-filter">
                <option value="">All Status</option>
                <option value="completed">Completed</option>
                <option value="pending">Pending</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="payment-filter" class="form-label">Payment Method</label>
            <select class="form-select" id="payment-filter">
                <option value="">All Methods</option>
                <option value="Cash">Cash</option>
                <option value="Transfer">Transfer</option>
                <option value="Card">Card</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="date-from" class="form-label">Date From</label>
            <input type="date" class="form-control" id="date-from">
        </div>
        <div class="col-md-3">
            <label for="date-to" class="form-label">Date To</label>
            <input type="date" class="form-control" id="date-to">
        </div>
        
        <x-slot name="search">
            <x-shared.components.filters.search-filter 
                placeholder="Search by customer name, medicine, or phone..." 
                id="search-input" />
        </x-slot>
    </x-shared.components.filters.filter-panel>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <x-shared.components.cards.stat-card 
                title="Total Transactions"
                :value="count($transactions)"
                color="success" />
        </div>
        <div class="col-md-3">
            <x-shared.components.cards.stat-card 
                title="Completed"
                :value="count(array_filter($transactions, fn($t) => $t['status'] === 'completed'))"
                color="success" />
        </div>
        <div class="col-md-3">
            <x-shared.components.cards.stat-card 
                title="Pending"
                :value="count(array_filter($transactions, fn($t) => $t['status'] === 'pending'))"
                color="warning" />
        </div>
        <div class="col-md-3">
            <x-shared.components.cards.stat-card 
                title="Cancelled"
                :value="count(array_filter($transactions, fn($t) => $t['status'] === 'cancelled'))"
                color="error" />
        </div>
    </div>

    <!-- Transactions Table -->
    <x-shared.components.cards.content-card>
        <x-shared.components.tables.data-table 
            :headers="['ID', 'Date', 'Customer', 'Medicine', 'Qty', 'Total', 'Status', 'Payment', 'Cashier', 'Actions']"
            :rows="$transactions"
            id="transactions-table">
            
            @foreach($transactions as $transaction)
                <x-shared.components.features.transaction-row :transaction="$transaction" type="sale" />
            @endforeach
        </x-shared.components.tables.data-table>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div>
                <p class="text-muted mb-0">Showing {{ count($transactions) }} of {{ count($transactions) }} transactions</p>
            </div>
            <nav>
                <ul class="pagination mb-0">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </x-shared.components.cards.content-card>
</div>

<!-- Delete Confirmation Modal -->
<x-shared.components.modals.delete-modal 
    message="Are you sure you want to delete this transaction? This action cannot be undone." />

<script>
function deleteItem(id) {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    const form = document.getElementById('delete-form');
    form.action = `/transactions/${id}`;
    modal.show();
}

// Filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const statusFilter = document.getElementById('status-filter');
    const paymentFilter = document.getElementById('payment-filter');
    const dateFrom = document.getElementById('date-from');
    const dateTo = document.getElementById('date-to');
    const searchInput = document.getElementById('search-input');
    const resetBtn = document.getElementById('reset-filters');
    const table = document.getElementById('transactions-table');
    const rows = table.querySelectorAll('tbody tr');

    function filterTable() {
        const status = statusFilter.value.toLowerCase();
        const payment = paymentFilter.value;
        const fromDate = dateFrom.value;
        const toDate = dateTo.value;
        const search = searchInput.value.toLowerCase();

        rows.forEach(row => {
            const statusCell = row.querySelector('td:nth-child(7)').textContent.toLowerCase();
            const paymentCell = row.querySelector('td:nth-child(8)').textContent;
            const dateCell = row.querySelector('td:nth-child(2)').textContent;
            const customerCell = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            const medicineCell = row.querySelector('td:nth-child(4)').textContent.toLowerCase();

            const statusMatch = !status || statusCell.includes(status);
            const paymentMatch = !payment || paymentCell === payment;
            const dateMatch = !fromDate || dateCell >= fromDate;
            const dateMatch2 = !toDate || dateCell <= toDate;
            const searchMatch = !search || customerCell.includes(search) || medicineCell.includes(search);

            if (statusMatch && paymentMatch && dateMatch && dateMatch2 && searchMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    statusFilter.addEventListener('change', filterTable);
    paymentFilter.addEventListener('change', filterTable);
    dateFrom.addEventListener('change', filterTable);
    dateTo.addEventListener('change', filterTable);
    searchInput.addEventListener('input', filterTable);

    resetBtn.addEventListener('click', function() {
        statusFilter.value = '';
        paymentFilter.value = '';
        dateFrom.value = '';
        dateTo.value = '';
        searchInput.value = '';
        filterTable();
    });
});
</script>
@endsection 