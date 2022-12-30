<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @foreach($category->products as $product)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2">
                    <div class="p-6 text-gray-900">
                        <a href="{{ route('product', [$product->category, $product]) }}">
                            <div class="font-bold">{{ $product->title }}</div>
                            <div>{{ $product->short_description }}</div>
                        </a>
                    </div>
                </div>
                @endforeach
        </div>
    </div>
</x-app-layout>
