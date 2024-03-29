@section('meta_title', $news->title)
@section('meta_description', $news->short_description)

<x-app-layout>
    <x-slot:header>
        <x-top-header :h1="$news->title">
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
                            <a href="{{ route('news.index') }}" class="inline-flex items-center text-sm font-medium text-white hover:text-gray-200">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Новости
                            </a>
                        </li>
                    </ol>
                </nav>
            </x-slot:breadcrumbs>
            <x-slot:subheading>
                {{ $news->short_description }}
            </x-slot:subheading>
        </x-top-header>
    </x-slot:header>

    <div class="container mx-auto p-4 max-w-3xl prose dark:prose-invert prose-img:rounded-xl prose-headings:underline prose-a:text-blue-600 bg-white shadow">
        <div class="h1">
            {{ $news->title }}
            <time class="small float-right text-sm" datetime="{{ $news->created_at->format('Y-m-d') }}" pubdate>{{ $news->created_at->locale('ru_RU')->translatedFormat('d F Y') }}</time>
        </div>
        <img src="{{ Storage::url($news->image) }}" alt="" class="float-right ml-4 max-w-xs" loading="lazy">
        <div>{!! $news->short_description !!}</div>
        <div>{!! $news->description !!}</div>
    </div>
    @if ($news->products->count())
    <hr class="my-8">
    <div class="grid grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($news->products as $product)
        <x-product-card :product="$product" hideparams />
        @endforeach
    </div>
    @endif
</x-app-layout>