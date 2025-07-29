@props(['href', 'text' => 'Back'])

<a href="{{ $href }}" class="btn btn-outline-secondary btn-lg">
    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-2">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
    </svg>
    {{ $text }}
</a> 