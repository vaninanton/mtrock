@section('meta_title', 'Новости')

<x-app-layout>
    <x-slot:header>
        <x-top-header h1="Новости">
            <x-slot:breadcrumbs>
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 lg:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="/" class="inline-flex items-center text-sm font-medium text-white hover:text-gray-100">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                </svg>
                                Mountain-Rock.ru
                            </a>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-100 lg:ml-2 cursor-default">Новости</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </x-slot:breadcrumbs>
        </x-top-header>
    </x-slot:header>

    <div class="container mx-auto py-4 px-6">
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-2 lg:gap-4">
            @foreach($news as $item)
            <div class="bg-white border rounded shadow-sm mb-2 flex flex-col justify-between pt-4">
                <div>
                    <a href="{{ route('news.show', $item) }}" class="block">
                        <img src="{{ Storage::url($item->image) }}" alt="" class="mx-auto">
                        <div class="font-bold px-4">{{ $item->title }}</div>
                    </a>
                    <div class="text-xs p-4">{{ strip_tags($item->short_text) }}</div>
                </div>
                <div class="text-sm p-4 text-right">
                    <time class="small" datetime="{{ $item->created_at->format('Y-m-d') }}" pubdate>{{ $item->created_at->locale('ru_RU')->translatedFormat('d F Y') }}</time>
                </div>
            </div>
            @endforeach
        </div>
        {{ $news->links() }}
    </div>
</x-app-layout>