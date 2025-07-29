@props(['title', 'id', 'height' => '300px', 'periodSelector' => false])

<div class="card-custom p-4">
    @if($periodSelector)
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 fw-bold mb-0" style="color: var(--color-text-primary);">{{ $title }}</h2>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-primary btn-sm active" data-period="week">Week</button>
                <button type="button" class="btn btn-outline-primary btn-sm" data-period="month">Month</button>
                <button type="button" class="btn btn-outline-primary btn-sm" data-period="year">Year</button>
            </div>
        </div>
    @else
        <h2 class="h4 fw-bold mb-4" style="color: var(--color-text-primary);">{{ $title }}</h2>
    @endif
    <div style="position: relative; height: {{ $height }};">
        <canvas id="{{ $id }}"></canvas>
    </div>
</div> 