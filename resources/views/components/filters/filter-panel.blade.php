@props(['title' => 'Filters'])

<div class="card-custom p-4 mb-4">
    <div class="row g-3">
        {{ $slot }}
    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            {{ $search ?? '' }}
        </div>
        <div class="col-md-6 text-end">
            <button class="btn btn-outline-secondary" id="reset-filters">
                Reset Filters
            </button>
        </div>
    </div>
</div> 