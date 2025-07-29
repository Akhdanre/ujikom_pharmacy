@props(['amount', 'currency' => 'Rp', 'size' => 'normal'])

@php
    $sizeClasses = [
        'small' => 'text-sm',
        'normal' => 'text-base',
        'large' => 'text-lg',
        'xl' => 'text-xl',
        '2xl' => 'text-2xl'
    ];
    
    $sizeClass = $sizeClasses[$size] ?? 'text-base';
@endphp

<span class="{{ $sizeClass }} font-weight-500" style="color: var(--color-text-primary);">
    {{ $currency }} {{ number_format($amount, 0, ',', '.') }}
</span> 