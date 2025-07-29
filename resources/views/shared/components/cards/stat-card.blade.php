@props(['title', 'value', 'color' => 'success', 'icon' => null])

<div class="card-custom card-{{ $color }} text-center p-4">
    @if($icon)
        <div class="mb-3" style="color: var(--color-{{ $color }});">
            <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                {!! $icon !!}
            </svg>
        </div>
    @endif
    <h2 class="display-6 fw-bold" style="color: var(--color-text-primary);">{{ $value }}</h2>
    <p class="text-muted mb-0">{{ $title }}</p>
</div> 