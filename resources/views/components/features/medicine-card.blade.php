@props(['medicine'])

<div class="card-custom p-3 h-100">
    <div class="d-flex justify-content-between align-items-start mb-2">
        <h5 class="card-title mb-0" style="color: var(--color-text-primary);">{{ $medicine['name'] ?? $medicine->name }}</h5>
        <x-ui.status-badge :status="$medicine['stock_status'] ?? ($medicine->stock <= 10 ? 'low' : 'active')" />
    </div>
    
    <div class="mb-3">
        <small class="text-muted">Stock: {{ $medicine['stock'] ?? $medicine->stock }} units</small>
    </div>
    
    <div class="d-flex justify-content-between align-items-center">
        <x-ui.price-display :amount="$medicine['price'] ?? $medicine->price" size="large" />
        
        <div class="btn-group" role="group">
            <a href="{{ route('medicines.show', $medicine['id'] ?? $medicine->id) }}" 
               class="btn btn-outline-primary btn-sm" title="View">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </a>
            <a href="{{ route('medicines.edit', $medicine['id'] ?? $medicine->id) }}" 
               class="btn btn-outline-warning btn-sm" title="Edit">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </a>
        </div>
    </div>
</div> 