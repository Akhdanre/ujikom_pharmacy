@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <x-shared.components.layout.page-header 
        title="Medicines"
        subtitle="Manage all pharmacy medicines"
        :action="route('medicines.create')"
        actionText="Add Medicine"
        actionIcon="<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 6v6m0 0v6m0-6h6m-6 0H6'/>" />

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Search and Filters -->
    <x-shared.components.filters.filter-panel>
        <div class="col-md-3">
            <label for="category-filter" class="form-label">Category</label>
            <select class="form-select" id="category-filter">
                <option value="">All Categories</option>
                <option value="Pain Relief">Pain Relief</option>
                <option value="Antibiotics">Antibiotics</option>
                <option value="Vitamins">Vitamins</option>
                <option value="Supplements">Supplements</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="stock-filter" class="form-label">Stock Status</label>
            <select class="form-select" id="stock-filter">
                <option value="">All Stock</option>
                <option value="in-stock">In Stock</option>
                <option value="low-stock">Low Stock</option>
                <option value="out-of-stock">Out of Stock</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="expiry-filter" class="form-label">Expiry Status</label>
            <select class="form-select" id="expiry-filter">
                <option value="">All</option>
                <option value="valid">Valid</option>
                <option value="expiring-soon">Expiring Soon</option>
                <option value="expired">Expired</option>
            </select>
        </div>
        
        <x-slot name="search">
            <x-shared.components.filters.search-filter 
                placeholder="Search by name, category, or description..." 
                id="search-input" />
        </x-slot>
    </x-shared.components.filters.filter-panel>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <x-shared.components.cards.stat-card 
                title="Total Medicines"
                value="128"
                color="success" />
        </div>
        <div class="col-md-3">
            <x-shared.components.cards.stat-card 
                title="Low Stock"
                value="7"
                color="warning" />
        </div>
        <div class="col-md-3">
            <x-shared.components.cards.stat-card 
                title="Out of Stock"
                value="3"
                color="error" />
        </div>
        <div class="col-md-3">
            <x-shared.components.cards.stat-card 
                title="Expiring Soon"
                value="5"
                color="warning" />
        </div>
    </div>

    <!-- Medicines Table -->
    <x-shared.components.cards.content-card>
        <x-shared.components.tables.data-table 
            :headers="['Name', 'Category', 'Stock', 'Price', 'Expiry Date', 'Status', 'Actions']"
            :rows="$medicines"
            id="medicines-table">
            
            @foreach($medicines as $medicine)
            <tr>
                <td>
                    <div>
                        <div style="color: var(--color-text-primary); font-weight: 500;">{{ $medicine['name'] }}</div>
                        <small style="color: var(--color-text-secondary);">{{ $medicine['description'] }}</small>
                    </div>
                </td>
                <td style="color: var(--color-text-primary);">{{ $medicine['category'] }}</td>
                <td>
                    <div>
                        <span style="color: var(--color-text-primary);">{{ $medicine['stock'] }} units</span>
                        @if($medicine['stock'] <= 10)
                            <x-shared.components.ui.status-badge status="low" />
                        @endif
                    </div>
                </td>
                <td><x-shared.components.ui.price-display :amount="$medicine['price']" /></td>
                <td><x-shared.components.ui.date-display :date="$medicine['expiry_date']" format="short" /></td>
                <td>
                    @if($medicine['stock'] == 0)
                        <x-shared.components.ui.status-badge status="out" />
                    @elseif($medicine['stock'] <= 10)
                        <x-shared.components.ui.status-badge status="low" />
                    @else
                        <x-shared.components.ui.status-badge status="active" />
                    @endif
                </td>
                <td>
                    <x-shared.components.tables.action-buttons 
                        :viewUrl="route('medicines.show', $medicine['id'])"
                        :editUrl="route('medicines.edit', $medicine['id'])"
                        :deleteId="$medicine['id']" />
                </td>
            </tr>
            @endforeach
        </x-shared.components.tables.data-table>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div>
                <p class="text-muted mb-0">Showing {{ count($medicines) }} of {{ count($medicines) }} medicines</p>
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
    message="Are you sure you want to delete this medicine? This action cannot be undone." />

<script>
function deleteItem(id) {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    const form = document.getElementById('delete-form');
    form.action = `/medicines/${id}`;
    modal.show();
}

// Filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const categoryFilter = document.getElementById('category-filter');
    const stockFilter = document.getElementById('stock-filter');
    const expiryFilter = document.getElementById('expiry-filter');
    const searchInput = document.getElementById('search-input');
    const resetBtn = document.getElementById('reset-filters');
    const table = document.getElementById('medicines-table');
    const rows = table.querySelectorAll('tbody tr');

    function filterTable() {
        const category = categoryFilter.value.toLowerCase();
        const stock = stockFilter.value;
        const expiry = expiryFilter.value;
        const search = searchInput.value.toLowerCase();

        rows.forEach(row => {
            const categoryCell = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const stockCell = row.querySelector('td:nth-child(3)').textContent;
            const expiryCell = row.querySelector('td:nth-child(5)').textContent;
            const nameCell = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
            const descriptionCell = row.querySelector('td:nth-child(1) small').textContent.toLowerCase();

            const categoryMatch = !category || categoryCell.includes(category);
            const stockMatch = !stock || (stock === 'low-stock' && stockCell.includes('≤ 10')) || 
                              (stock === 'out-of-stock' && stockCell.includes('0')) ||
                              (stock === 'in-stock' && !stockCell.includes('≤ 10') && !stockCell.includes('0'));
            const expiryMatch = !expiry || (expiry === 'expired' && expiryCell.includes('2023')) ||
                               (expiry === 'expiring-soon' && expiryCell.includes('2024-01')) ||
                               (expiry === 'valid' && !expiryCell.includes('2023') && !expiryCell.includes('2024-01'));
            const searchMatch = !search || nameCell.includes(search) || descriptionCell.includes(search);

            if (categoryMatch && stockMatch && expiryMatch && searchMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    categoryFilter.addEventListener('change', filterTable);
    stockFilter.addEventListener('change', filterTable);
    expiryFilter.addEventListener('change', filterTable);
    searchInput.addEventListener('input', filterTable);

    resetBtn.addEventListener('click', function() {
        categoryFilter.value = '';
        stockFilter.value = '';
        expiryFilter.value = '';
        searchInput.value = '';
        filterTable();
    });
});
</script>
@endsection 