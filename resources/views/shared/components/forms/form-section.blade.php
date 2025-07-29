@props(['title'])

<h3 class="h5 fw-bold mb-3" style="color: var(--color-text-primary);">{{ $title }}</h3>
<div class="row g-3 mb-4">
    {{ $slot }}
</div> 