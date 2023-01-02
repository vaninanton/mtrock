@props(['h1' => 'Заголовок', 'subheading' => ''])

<div {!! $attributes->merge(['class' => 'bg-[#0350b1] text-white py-8']) !!}>
    <div class="container mx-auto px-4">
        <div class="lg:flex justify-between items-center">
            <div class="lg:order-2">
                {{ $breadcrumbs }}
            </div>

            <div class="flex-0 lg:w-1/2 lg:order-1">
                <h1 class="text-3xl font-bold">{{ $h1 }}</h1>
            </div>
        </div>
        @if ($subheading)
        <div class="text-sm mt-3">{!! $subheading !!}</div>
        @endif
    </div>
</div>
