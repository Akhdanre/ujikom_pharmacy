@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <x-layout.page-header 
        title="Buy Transactions"
        subtitle="Manage medicine purchases from suppliers"
        :action="route('buy-transactions.create')"
        actionText="New Purchase Order"
        actionIcon="<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 6v6m0 0v6m0-6h6m-6 0H6'/>" />

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filters and Search -->
    <x-filters.filter-panel>
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
            <label for="payment-filter" class="form-label">Payment Status</label>
            <select class="form-select" id="payment-filter">
                <option value="">All Payment Status</option>
                <option value="Paid">Paid</option>
                <option value="Pending">Pending</option>
                <option value="Refunded">Refunded</option>
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
            <x-filters.search-filter 
                placeholder="Search by supplier name, medicine, or notes..." 
                id="search-input" />
        </x-slot>
    </x-filters.filter-panel>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <x-cards.stat-card 
                title="Total Orders"
                :value="count($buyTransactions)"
                color="success" />
        </div>
        <div class="col-md-3">
            <x-cards.stat-card 
                title="Completed"
                :value="count(array_filter($buyTransactions, fn($t) => $t['status'] === 'completed'))"
                color="success" />
        </div>
        <div class="col-md-3">
            <x-cards.stat-card 
                title="Pending"
                :value="count(array_filter($buyTransactions, fn($t) => $t['status'] === 'pending'))"
                color="warning" />
        </div>
        <div class="col-md-3">
            <x-cards.stat-card 
                title="Cancelled"
                :value="count(array_filter($buyTransactions, fn($t) => $t['status'] === 'cancelled'))"
                color="error" />
        </div>
    </div>

    <!-- Buy Transactions Table -->
    <x-cards.content-card>
        <x-tables.data-table 
            :headers="['ID', 'Date', 'Supplier', 'Medicine', 'Qty', 'Total', 'Status', 'Payment', 'Delivery', 'Actions']"
            :rows="$buyTransactions"
            id="buy-transactions-table">
            
            @foreach($buyTransactions as $transaction)
            <tr>
                <td style="color: var(--color-text-primary);">#{{ $transaction['id'] }}</td>
                <td style="color: var(--color-text-primary);">{{ $transaction['date'] }}</td>
                <td>
                    <div>
                        <div style="color: var(--color-text-primary); font-weight: 500;">{{ $transaction['supplier_name'] }}</div>
                        <small style="color: var(--color-text-secondary);">{{ $transaction['supplier_phone'] }}</small>
                    </div>
                </td>
                <td style="color: var(--color-text-primary);">{{ $transaction['medicine_name'] }}</td>
                <td style="color: var(--color-text-primary);">{{ $transaction['quantity'] }}</td>
                <td style="color: var(--color-text-primary); font-weight: 500;">Rp {{ number_format($transaction['total_price'], 0, ',', '.') }}</td>
                <td>
                    @if($transaction['status'] === 'completed')
                        <span class="badge-custom badge-success">{{ ucfirst($transaction['status']) }}</span>
                    @elseif($transaction['status'] === 'pending')
                        <span class="badge-custom badge-warning">{{ ucfirst($transaction['status']) }}</span>
                    @else
                        <span class="badge-custom badge-error">{{ ucfirst($transaction['status']) }}</span>
                    @endif
                </td>
                <td>
                    <div>
                        <div style="color: var(--color-text-primary);">{{ $transaction['payment_method'] }}</div>
                        <small style="color: var(--color-text-secondary);">{{ $transaction['payment_status'] }}</small>
                    </div>
                </td>
                <td style="color: var(--color-text-primary);">{{ $transaction['delivery_date'] }}</td>
                <td>
                    <x-tables.action-buttons 
                        :viewUrl="route('buy-transactions.show', $transaction['id'])"
                        :editUrl="route('buy-transactions.edit', $transaction['id'])"
                        :deleteId="$transaction['id']" />
                </td>
            </tr>
            @endforeach
        </x-tables.data-table>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div>
                <p class="text-muted mb-0">Showing {{ count($buyTransactions) }} of {{ count($buyTransactions) }} buy transactions</p>
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
    </x-cards.content-card>
</div>

<!-- Delete Confirmation Modal -->
<x-modals.delete-modal 
    message="Are you sure you want to delete this buy transaction? This action cannot be undone." />

<script>
function deleteItem(id) {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    const form = document.getElementById('delete-form');
    form.action = `/buy-transactions/${id}`;
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
    const table = document.getElementById('buy-transactions-table');
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
            const supplierCell = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            const medicineCell = row.querySelector('td:nth-child(4)').textContent.toLowerCase();

            const statusMatch = !status || statusCell.includes(status);
            const paymentMatch = !payment || paymentCell.includes(payment);
            const dateMatch = !fromDate || dateCell >= fromDate;
            const dateMatch2 = !toDate || dateCell <= toDate;
            const searchMatch = !search || supplierCell.includes(search) || medicineCell.includes(search);

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