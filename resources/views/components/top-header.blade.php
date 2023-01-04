@props(['h1' => 'Заголовок'])

<div {!! $attributes->merge(['class' => 'bg-primary text-white py-8']) !!}>
    <div class="container mx-auto px-4">
        <div class="lg:flex justify-between items-center">
            @isset($breadcrumbs)
            <div class="lg:order-2">
                {{ $breadcrumbs }}
            </div>
            @endisset

            <div class="flex-0 lg:w-1/2 lg:order-1">
                <h1 class="text-xl lg:text-3xl font-bold">{{ $h1 }}</h1>
            </div>
        </div>
        @isset ($subheading)
        <div class="text-sm mt-3">{!! $subheading !!}</div>
        @endisset
    </div>
</div>
