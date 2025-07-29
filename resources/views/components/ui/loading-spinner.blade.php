@props(['size' => 'md', 'text' => 'Loading...'])

@php
    $sizeClasses = [
        'sm' => 'spinner-border-sm',
        'md' => 'spinner-border',
        'lg' => 'spinner-border'
    ];
    
    $sizeClass = $sizeClasses[$size] ?? 'spinner-border';
@endphp

<div class="d-flex align-items-center justify-content-center">
    <div class="{{ $sizeClass }}" role="status" style="color: var(--color-primary);">
        <span class="visually-hidden">{{ $text }}</span>
    </div>
    @if($text)
        <span class="ms-2" style="color: var(--color-text-secondary);">{{ $text }}</span>
    @endif
</div> 