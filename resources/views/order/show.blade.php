@section('meta_title', 'Заказ №'.$order->id)

<x-app-layout>
    <x-slot:header>
        <x-top-header :h1="'Заказ №'.$order->id">
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
                <time class="small" datetime="{{ $order->created_at->format('Y-m-d') }}" pubdate>{{ $order->created_at->locale('ru_RU')->translatedFormat('d F Y') }}</time>
            </x-slot:subheading>
        </x-top-header>
    </x-slot:header>

    <div class="container mx-auto p-4 max-w-3xl">
        <h1 class="h1">
            Заказ №{{$order->id}}
            <span class="bg-{{$order->status->getColor()}}-100 text-{{$order->status->getColor()}}-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{ $order->status->toLocalizedString() }}</span>
        </h1>
        <div><strong>Создан:</strong> <time class="small" datetime="{{ $order->created_at->format('Y-m-d') }}" pubdate>{{ $order->created_at->locale('ru_RU')->translatedFormat('d F Y') }}</time></div>

        <div><strong>Получатель:</strong> {{ $order->name }}</div>
        <div><strong>Метод оплаты:</strong> {{ $order->pay_method->toLocalizedString() }}</div>
        <div><strong>Способ доставки:</strong> {{ $order->delivery->title }}</div>
        <div><strong>Комментарий:</strong> {{ $order->comment }}</div>
        <div>
            <strong>Адрес доставки:</strong>
            {{ $order->country }},
            {{ $order->city }},
            {{ $order->street }},
            {{ $order->house }},
            кв/офис {{ $order->apartment }}
        </div>

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead>
                    <tr class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <th scope="col" class="px-6 py-3">Наименование</th>
                        <th scope="col" class="px-6 py-3">Цена</th>
                        <th scope="col" class="px-6 py-3">Количество</th>
                        <th scope="col" class="px-6 py-3">Стоимость</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->products as $product)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $product->product_name }}</th>
                        <td class="px-6 py-4">@money($product->price)</td>
                        <td class="px-6 py-4">{{ $product->quantity }}</td>
                        <td class="px-6 py-4">@money($product->price * $product->quantity)</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>