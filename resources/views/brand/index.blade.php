@section('meta_title', 'Бренды')

<x-app-layout>
    <nav class="flex bg-gray-100 py-2 px-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">
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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Бренды</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="py-4 px-6">
        <h1 class="h1">Бренды</h1>
        <div class="grid grid-cols-3 gap-4">
            @foreach($brands as $item)
            <div class="bg-white border rounded shadow-sm mb-2 flex flex-col">
                <a href="{{ route('brand.show', $item) }}" class="block">
                    <img src="https://mountain-rock.ru/uploads/thumbs/producer/348x174_{{ $item->image }}" alt="" class="mx-auto">
                    <div class="font-bold px-4">{{ $item->title }}</div>
                </a>
                <div class="text-sm p-4">{{ strip_tags($item->short_description) }}</div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
