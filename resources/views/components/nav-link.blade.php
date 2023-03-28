@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex-inline p-2 bg-primary text-white hover:bg-primary-dark'
            : 'flex-inline p-2 text-white hover:bg-primary-dark';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
