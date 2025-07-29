@props(['title', 'description', 'icon' => null, 'action' => null, 'actionText' => null])

<div class="text-center py-5">
    @if($icon)
        <div class="mb-3">
            <svg width="64" height="64" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text-secondary);">
                {!! $icon !!}
            </svg>
        </div>
    @endif
    
    <h3 class="h5 fw-bold mb-2" style="color: var(--color-text-primary);">{{ $title }}</h3>
    <p class="text-muted mb-4">{{ $description }}</p>
    
    @if($action)
        <a href="{{ $action }}" class="btn btn-primary">
            {{ $actionText }}
        </a>
    @endif
</div> 