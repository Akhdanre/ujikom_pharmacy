@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-5 fw-bold mb-2" style="color: var(--color-text-primary);">New Purchase Order</h1>
            <p class="lead" style="color: var(--color-text-secondary);">Create a new medicine purchase order from supplier</p>
        </div>
        <a href="{{ route('buy-transactions.index') }}" class="btn btn-outline-secondary btn-lg">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-2">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Buy Transactions
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card-custom p-4">
                <form action="{{ route('buy-transactions.store') }}" method="POST">
                    @csrf
                    
                    <!-- Supplier Information -->
                    <h3 class="h5 fw-bold mb-3" style="color: var(--color-text-primary);">Supplier Information</h3>
                    <div class="row g-3 mb-4">
                        <div class="col-md-12">
                            <label for="supplier_id" class="form-label">Select Supplier *</label>
                            <select class="form-select @error('supplier_id') is-invalid @enderror" 
                                    id="supplier_id" name="supplier_id" required>
                                <option value="">Choose supplier...</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier['id'] }}" 
                                            data-phone="{{ $supplier['phone'] }}"
                                            data-email="{{ $supplier['email'] }}"
                                            {{ old('supplier_id') == $supplier['id'] ? 'selected' : '' }}>
                                        {{ $supplier['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Supplier Phone</label>
                            <input type="text" class="form-control" id="supplier_phone" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Supplier Email</label>
                            <input type="text" class="form-control" id="supplier_email" readonly>
                        </div>
                    </div>

                    <!-- Medicine Details -->
                    <h3 class="h5 fw-bold mb-3" style="color: var(--color-text-primary);">Medicine Details</h3>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="medicine_id" class="form-label">Select Medicine *</label>
                            <select class="form-select @error('medicine_id') is-invalid @enderror" 
                                    id="medicine_id" name="medicine_id" required>
                                <option value="">Choose medicine...</option>
                                @foreach($medicines as $medicine)
                                    <option value="{{ $medicine['id'] }}" 
                                            data-suggested-price="{{ $medicine['suggested_price'] }}"
                                            data-current-stock="{{ $medicine['current_stock'] }}"
                                            {{ old('medicine_id') == $medicine['id'] ? 'selected' : '' }}>
                                        {{ $medicine['name'] }} (Current Stock: {{ $medicine['current_stock'] }})
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
                            <label for="unit_price" class="form-label">Unit Price (Rp) *</label>
                            <input type="number" class="form-control @error('unit_price') is-invalid @enderror" 
                                   id="unit_price" name="unit_price" value="{{ old('unit_price') }}" min="0" step="100" required>
                            @error('unit_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Payment and Delivery Information -->
                    <h3 class="h5 fw-bold mb-3" style="color: var(--color-text-primary);">Payment & Delivery</h3>
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
                            <label for="delivery_date" class="form-label">Expected Delivery Date *</label>
                            <input type="date" class="form-control @error('delivery_date') is-invalid @enderror" 
                                   id="delivery_date" name="delivery_date" value="{{ old('delivery_date') }}" required>
                            @error('delivery_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" name="notes" rows="3" placeholder="Additional notes about this purchase order...">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-2">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Create Purchase Order
                        </button>
                        <a href="{{ route('buy-transactions.index') }}" class="btn btn-outline-secondary btn-lg">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Summary Card -->
        <div class="col-lg-4">
            <div class="card-custom p-4">
                <h3 class="h5 fw-bold mb-3" style="color: var(--color-text-primary);">Purchase Order Summary</h3>
                
                <div class="mb-3">
                    <label class="form-label">Selected Supplier</label>
                    <div id="summary-supplier" class="text-muted">No supplier selected</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Selected Medicine</label>
                    <div id="summary-medicine" class="text-muted">No medicine selected</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Current Stock</label>
                    <div id="summary-current-stock" class="text-muted">-</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Suggested Price</label>
                    <div id="summary-suggested-price" class="text-muted">Rp 0</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Quantity</label>
                    <div id="summary-quantity" class="text-muted">0</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Unit Price</label>
                    <div id="summary-unit-price" class="text-muted">Rp 0</div>
                </div>

                <hr>

                <div class="mb-3">
                    <label class="form-label fw-bold">Total Amount</label>
                    <div id="summary-total" class="h4 fw-bold" style="color: var(--color-success);">Rp 0</div>
                </div>

                <div class="alert alert-info">
                    <small>
                        <strong>Note:</strong> Please ensure all information is correct before creating the purchase order.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const supplierSelect = document.getElementById('supplier_id');
    const medicineSelect = document.getElementById('medicine_id');
    const quantityInput = document.getElementById('quantity');
    const unitPriceInput = document.getElementById('unit_price');
    
    // Summary elements
    const summarySupplier = document.getElementById('summary-supplier');
    const summaryMedicine = document.getElementById('summary-medicine');
    const summaryCurrentStock = document.getElementById('summary-current-stock');
    const summarySuggestedPrice = document.getElementById('summary-suggested-price');
    const summaryQuantity = document.getElementById('summary-quantity');
    const summaryUnitPrice = document.getElementById('summary-unit-price');
    const summaryTotal = document.getElementById('summary-total');

    // Supplier info elements
    const supplierPhone = document.getElementById('supplier_phone');
    const supplierEmail = document.getElementById('supplier_email');

    function updateSummary() {
        const selectedSupplierOption = supplierSelect.options[supplierSelect.selectedIndex];
        const selectedMedicineOption = medicineSelect.options[medicineSelect.selectedIndex];
        const quantity = parseInt(quantityInput.value) || 0;
        const unitPrice = parseInt(unitPriceInput.value) || 0;

        // Update supplier info
        if (selectedSupplierOption && selectedSupplierOption.value) {
            const supplierName = selectedSupplierOption.text;
            const supplierPhoneValue = selectedSupplierOption.dataset.phone;
            const supplierEmailValue = selectedSupplierOption.dataset.email;

            summarySupplier.textContent = supplierName;
            supplierPhone.value = supplierPhoneValue;
            supplierEmail.value = supplierEmailValue;
        } else {
            summarySupplier.textContent = 'No supplier selected';
            supplierPhone.value = '';
            supplierEmail.value = '';
        }

        // Update medicine info
        if (selectedMedicineOption && selectedMedicineOption.value) {
            const medicineName = selectedMedicineOption.text.split(' (')[0];
            const suggestedPrice = parseInt(selectedMedicineOption.dataset.suggestedPrice);
            const currentStock = parseInt(selectedMedicineOption.dataset.currentStock);

            summaryMedicine.textContent = medicineName;
            summaryCurrentStock.textContent = currentStock + ' units';
            summarySuggestedPrice.textContent = 'Rp ' + suggestedPrice.toLocaleString('id-ID');
            
            // Auto-fill unit price if empty
            if (!unitPriceInput.value) {
                unitPriceInput.value = suggestedPrice;
            }
        } else {
            summaryMedicine.textContent = 'No medicine selected';
            summaryCurrentStock.textContent = '-';
            summarySuggestedPrice.textContent = 'Rp 0';
        }

        // Update quantity and pricing
        summaryQuantity.textContent = quantity;
        summaryUnitPrice.textContent = 'Rp ' + unitPrice.toLocaleString('id-ID');
        summaryTotal.textContent = 'Rp ' + (quantity * unitPrice).toLocaleString('id-ID');
    }

    supplierSelect.addEventListener('change', updateSummary);
    medicineSelect.addEventListener('change', updateSummary);
    quantityInput.addEventListener('input', updateSummary);
    unitPriceInput.addEventListener('input', updateSummary);

    // Initial update
    updateSummary();
});
</script>
@endsection 