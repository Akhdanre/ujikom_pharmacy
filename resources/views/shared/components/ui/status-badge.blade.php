@props(['status', 'type' => 'default'])

@php
    $statusConfig = [
        'completed' => ['class' => 'badge-success', 'text' => 'Completed'],
        'pending' => ['class' => 'badge-warning', 'text' => 'Pending'],
        'cancelled' => ['class' => 'badge-error', 'text' => 'Cancelled'],
        'active' => ['class' => 'badge-success', 'text' => 'Active'],
        'inactive' => ['class' => 'badge-error', 'text' => 'Inactive'],
        'low' => ['class' => 'badge-warning', 'text' => 'Low Stock'],
        'out' => ['class' => 'badge-error', 'text' => 'Out of Stock'],
        'expired' => ['class' => 'badge-error', 'text' => 'Expired'],
        'expiring' => ['class' => 'badge-warning', 'text' => 'Expiring Soon'],
        'paid' => ['class' => 'badge-success', 'text' => 'Paid'],
        'refunded' => ['class' => 'badge-error', 'text' => 'Refunded'],
    ];
    
    $config = $statusConfig[strtolower($status)] ?? ['class' => 'badge-secondary', 'text' => ucfirst($status)];
@endphp

<span class="badge-custom {{ $config['class'] }}">{{ $config['text'] }}</span> 