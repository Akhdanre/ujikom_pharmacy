@props(['title', 'subtitle', 'action' => null, 'actionText' => null, 'actionIcon' => null])

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="display-5 fw-bold mb-2" style="color: var(--color-text-primary);">{{ $title }}</h1>
        <p class="lead" style="color: var(--color-text-secondary);">{{ $subtitle }}</p>
    </div>
    @if($action)
        <a href="{{ $action }}" class="btn btn-primary btn-lg">
            @if($actionIcon)
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-2">
                    {!! $actionIcon !!}
                </svg>
            @endif
            {{ $actionText }}
        </a>
    @endif
</div> 