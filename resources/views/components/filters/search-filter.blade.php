@props(['placeholder' => 'Search...', 'id' => 'search-input'])

<div class="input-group">
    <input type="text" 
           class="form-control" 
           placeholder="{{ $placeholder }}" 
           id="{{ $id }}">
    <button class="btn btn-outline-primary" type="button">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
    </button>
</div> 