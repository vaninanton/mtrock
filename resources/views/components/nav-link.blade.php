@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex-inline p-2 bg-blue-600 text-white'
            : 'flex-inline p-2 text-white';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
