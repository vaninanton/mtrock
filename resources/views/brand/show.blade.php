@section('meta_title', $brand->title)

<x-app-layout>
    <x-slot:header>
        <x-top-header :h1="$brand->title">
            <x-slot:subheading>{{ strip_tags($brand->short_description) }}</x-slot:subheading>
            <x-slot:breadcrumbs>
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 lg:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="/" class="inline-flex items-center text-sm font-medium text-white hover:text-gray-200">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                </svg>
                                Mountain-Rock.ru
                            </a>
                        </li>
                        <li class="inline-flex items-center">
                            <a href="{{ route('brand.index') }}" class="inline-flex items-center text-sm font-medium text-white hover:text-gray-200">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Бренды
                            </a>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-100 lg:ml-2 cursor-default">{{ $brand->title }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </x-slot:breadcrumbs>
        </x-top-header>
    </x-slot:header>

    <div class="container mx-auto p-4">
        @if ($brand->description)
        <div class="content max-w-4xl mx-auto">
            <img src="{{ config('app.uploads_url') }}/store/brand/{{ $brand->image }}" alt="" class="float-right" loading="lazy">
            {!! $brand->description !!}
        </div>
        @endif

        <div class="grid lg:grid-cols-12 mt-4 gap-4">
            <div class="lg:col-span-10 relative">
                @foreach($brand->products->groupBy('type') as $type)
                <div class="mb-8">
                    <h2 class="h2" id="{{ Str::slug($type->first()->type?->title_plural) }}">{{ $type->first()->type?->title_plural }}</h2>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-2 lg:gap-4">
                        @foreach ($type as $product)
                        <x-product-card :product="$product" />
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <div class="lg:col-span-2">
                <div class="sticky top-4 pt-6">
                    @foreach ($brand->products->pluck('type.title_plural')->unique() as $type)
                    <div><a href="#{{ Str::slug($type) }}">{{ $type }}</a></div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
