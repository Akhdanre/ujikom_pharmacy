@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-5 fw-bold mb-2" style="color: var(--color-text-primary);">New Transaction</h1>
            <p class="lead" style="color: var(--color-text-secondary);">Create a new pharmacy transaction</p>
        </div>
        <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary btn-lg">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-2">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Transactions
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card-custom p-4">
                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf
                    
                    <!-- Customer Information -->
                    <h3 class="h5 fw-bold mb-3" style="color: var(--color-text-primary);">Customer Information</h3>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="customer_name" class="form-label">Customer Name *</label>
                            <input type="text" class="form-control @error('customer_name') is-invalid @enderror" 
                                   id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
                            @error('customer_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="customer_phone" class="form-label">Phone Number *</label>
                            <input type="text" class="form-control @error('customer_phone') is-invalid @enderror" 
                                   id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}" required>
                            @error('customer_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Medicine Selection -->
                    <h3 class="h5 fw-bold mb-3" style="color: var(--color-text-primary);">Medicine Details</h3>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="medicine_id" class="form-label">Select Medicine *</label>
                            <select class="form-select @error('medicine_id') is-invalid @enderror" 
                                    id="medicine_id" name="medicine_id" required>
                                <option value="">Choose medicine...</option>
                                @foreach($medicines as $medicine)
                                    <option value="{{ $medicine['id'] }}" 
                                            data-price="{{ $medicine['price'] }}"
                                            data-stock="{{ $medicine['stock'] }}"
                                            {{ old('medicine_id') == $medicine['id'] ? 'selected' : '' }}>
                                        {{ $medicine['name'] }} (Stock: {{ $medicine['stock'] }})
                                    </option>
                                @endforeach
                            </select>
                            @error('medicine_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="quantity" class="form-label">Quantity *</label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                                   id="quantity" name="quantity" value="{{ old('quantity', 1) }}" min="1" required>
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="unit_price" class="form-label">Unit Price</label>
                            <input type="text" class="form-control" id="unit_price" readonly>
                        </div>
                    </div>

                    <!-- Payment Information -->
                    <h3 class="h5 fw-bold mb-3" style="color: var(--color-text-primary);">Payment Information</h3>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="payment_method" class="form-label">Payment Method *</label>
                            <select class="form-select @error('payment_method') is-invalid @enderror" 
                                    id="payment_method" name="payment_method" required>
                                <option value="">Select payment method...</option>
                                <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="transfer" {{ old('payment_method') == 'transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="card" {{ old('payment_method') == 'card' ? 'selected' : '' }}>Credit/Debit Card</option>
                            </select>
                            @error('payment_method')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="total_amount" class="form-label">Total Amount</label>
                            <input type="text" class="form-control" id="total_amount" readonly>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-2">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Create Transaction
                        </button>
                        <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary btn-lg">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Summary Card -->
        <div class="col-lg-4">
            <div class="card-custom p-4">
                <h3 class="h5 fw-bold mb-3" style="color: var(--color-text-primary);">Transaction Summary</h3>
                
                <div class="mb-3">
                    <label class="form-label">Selected Medicine</label>
                    <div id="summary-medicine" class="text-muted">No medicine selected</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Available Stock</label>
                    <div id="summary-stock" class="text-muted">-</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Unit Price</label>
                    <div id="summary-unit-price" class="text-muted">Rp 0</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Quantity</label>
                    <div id="summary-quantity" class="text-muted">0</div>
                </div>

                <hr>

                <div class="mb-3">
                    <label class="form-label fw-bold">Total Amount</label>
                    <div id="summary-total" class="h4 fw-bold" style="color: var(--color-success);">Rp 0</div>
                </div>

                <div class="alert alert-info">
                    <small>
                        <strong>Note:</strong> Please ensure all information is correct before creating the transaction.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const medicineSelect = document.getElementById('medicine_id');
    const quantityInput = document.getElementById('quantity');
    const unitPriceInput = document.getElementById('unit_price');
    const totalAmountInput = document.getElementById('total_amount');
    
    // Summary elements
    const summaryMedicine = document.getElementById('summary-medicine');
    const summaryStock = document.getElementById('summary-stock');
    const summaryUnitPrice = document.getElementById('summary-unit-price');
    const summaryQuantity = document.getElementById('summary-quantity');
    const summaryTotal = document.getElementById('summary-total');

    function updateSummary() {
        const selectedOption = medicineSelect.options[medicineSelect.selectedIndex];
        const quantity = parseInt(quantityInput.value) || 0;

        if (selectedOption && selectedOption.value) {
            const medicineName = selectedOption.text.split(' (')[0];
            const price = parseInt(selectedOption.dataset.price);
            const stock = parseInt(selectedOption.dataset.stock);

            summaryMedicine.textContent = medicineName;
            summaryStock.textContent = stock + ' units';
            summaryUnitPrice.textContent = 'Rp ' + price.toLocaleString('id-ID');
            summaryQuantity.textContent = quantity;
            summaryTotal.textContent = 'Rp ' + (price * quantity).toLocaleString('id-ID');

            unitPriceInput.value = 'Rp ' + price.toLocaleString('id-ID');
            totalAmountInput.value = 'Rp ' + (price * quantity).toLocaleString('id-ID');

            // Check stock availability
            if (quantity > stock) {
                quantityInput.classList.add('is-invalid');
                summaryTotal.style.color = 'var(--color-error)';
            } else {
                quantityInput.classList.remove('is-invalid');
                summaryTotal.style.color = 'var(--color-success)';
            }
        } else {
            summaryMedicine.textContent = 'No medicine selected';
            summaryStock.textContent = '-';
            summaryUnitPrice.textContent = 'Rp 0';
            summaryQuantity.textContent = '0';
            summaryTotal.textContent = 'Rp 0';
            
            unitPriceInput.value = '';
            totalAmountInput.value = '';
        }
    }

    medicineSelect.addEventListener('change', updateSummary);
    quantityInput.addEventListener('input', updateSummary);

    // Initial update
    updateSummary();
});
</script>
@endsection 