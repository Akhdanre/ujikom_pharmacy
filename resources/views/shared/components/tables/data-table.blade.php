@props(['headers', 'rows', 'id' => 'data-table'])

<div class="table-responsive">
    <table class="table table-hover" id="{{ $id }}">
        <thead>
            <tr>
                @foreach($headers as $header)
                    <th scope="col" style="color: var(--color-text-secondary);">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div> 