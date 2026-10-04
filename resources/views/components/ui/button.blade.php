@props([
    'type' => 'button',
    'variant' => 'primary', // primary, secondary, danger, etc.
    'icon' => null,
    'size' => '', // sm, lg
    'href' => null
])

@php
    $classes = "btn btn-{$variant}";
    if ($size) {
        $classes .= " btn-{$size}";
    }
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)
            <i class="{{ $icon }}"></i>
        @endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)
            <i class="{{ $icon }}"></i>
        @endif
        {{ $slot }}
    </button>
@endif
