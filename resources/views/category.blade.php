@section('meta_title', $category->title)

<x-app-layout>
    <x-top-header :h1="$category->title">
        <x-slot:breadcrumbs>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 lg:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="/" class="inline-flex items-center text-sm font-medium text-white hover:text-gray-200">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Главная
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-100 lg:ml-2 cursor-default">{{ $category->title }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </x-slot>
    </x-top-header>

    <div class="p-4">
        <div class="content max-w-2xl mx-auto">
            <h1 class="h1">{{ $category->title }}</h1>
            {!! $category->short_description !!}
        </div>
        @foreach ($category->childrenRecursive as $child)
            <div>
                <h2 class="h2"><a href="{{ route('category', $child) }}">{{ $child->title }}</a></h2>
                <div class="grid grid-cols-4 gap-8 px-4">
                    @foreach($child->products as $product)
                    <x-product-card :product="$product" />
                    @endforeach
                </div>
            </div>
        @endforeach
        <div class="content max-w-2xl mx-auto">{!! $category->description !!}</div>
    </div>

    <div class="grid grid-cols-4 gap-8 px-4">
        @foreach($category->products as $product)
        <x-product-card :product="$product" />
        @endforeach
    </div>
</x-app-layout>
