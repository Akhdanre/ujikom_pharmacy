@props(['date', 'format' => 'Y-m-d', 'showTime' => false])

@php
    $dateObj = \Carbon\Carbon::parse($date);
    
    $formats = [
        'short' => 'd/m/Y',
        'long' => 'd F Y',
        'full' => 'l, d F Y',
        'time' => 'd/m/Y H:i',
        'datetime' => 'd/m/Y H:i:s'
    ];
    
    $displayFormat = $formats[$format] ?? $format;
    $displayDate = $showTime ? $dateObj->format($displayFormat) : $dateObj->format($displayFormat);
@endphp

<span style="color: var(--color-text-primary);">{{ $displayDate }}</span> 