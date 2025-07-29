@props(['title' => null, 'class' => ''])

<div class="card-custom p-4 {{ $class }}">
    @if($title)
        <h2 class="h4 fw-bold mb-4" style="color: var(--color-text-primary);">{{ $title }}</h2>
    @endif
    {{ $slot }}
</div> 