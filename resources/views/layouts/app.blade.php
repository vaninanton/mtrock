<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased" itemscope itemtype="http://schema.org/WebPage">
    <div class="flex flex-col bg-gray-50 min-h-screen justify-between">
        <div>
            <nav class="bg-white border-gray-200">
                <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl px-4 md:px-6 py-2.5">
                    <a href="/" class="flex items-center">
                        <img src="/img/logo.svg" class="mr-3 h-6 sm:h-10" alt="" />
                        Mountain-Rock.ru
                    </a>
                    <button data-collapse-toggle="mega-menu-full" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="mega-menu-full" aria-expanded="false">
                        <span class="sr-only">Открыть меню</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div id="mega-menu-full" class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1">
                        <ul class="flex flex-col mt-4 text-sm font-medium md:flex-row md:space-x-8 md:mt-0">
                            <li>
                                <button id="mega-menu-full-dropdown-button" data-collapse-toggle="mega-menu-full-dropdown" class="flex justify-between items-center py-2 pr-4 pl-3 w-full font-medium text-gray-700 border-b border-gray-100 md:w-auto hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0">Товары для&nbsp;спорта и&nbsp;туризма <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg></button>
                            </li>
                            <li>
                                <a href="{{ route('news.index') }}" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0" aria-current="page">Новости</a>
                            </li>
                            <li>
                                <a href="{{ route('page', 'oplata-i-dostavka-po-moskve-i-rossii') }}" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Оплата и&nbsp;доставка</a>
                            </li>
                            <li>
                                <a href="{{ route('page', 'obmen-i-vozvrat') }}" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Обмен и&nbsp;возврат</a>
                            </li>
                            <li>
                                <a href="{{ route('contact') }}" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Контакты</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="mega-menu-full-dropdown" class="mt-1 bg-white border-gray-200 shadow-sm border-y hidden">
                    <ul aria-labelledby="mega-menu-full-dropdown-button" class="grid py-5 px-4 mx-auto max-w-screen-xl text-gray-900 sm:grid-cols-2 md:grid-cols-3 md:px-6">
                        @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('category', $category) }}" class="block p-3 rounded-lg hover:bg-gray-50">
                                <div class="font-semibold">{{ $category->title }}</div>
                                {{-- <span class="text-sm font-light text-gray-500">{{ $category->short_description }}</span> --}}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
            <div class="py-8">
                <div class="container mx-auto px-4">
                    <main class="border bg-white shadow-2xl">
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>

        <footer class="footer bg-black text-white border-t-4 border-t-blue-600">
            <div class="container mx-auto p-4">
                <div class="grid grid-cols-2">
                    <div class="">
                        <div class="footer__copyright">
                            © 2009—2023 Mountain-Rock.ru
                        </div>
                        <div class="footer__contact">
                            <div class="footer__contact__tel">
                                <i class="fas fa-phone fa-fw"></i>
                                <a href="tel:+74993918019">+7 (499) 391-80-19</a>
                            </div>
                            <div class="footer__contact__time">
                                <i class="far fa-clock fa-fw"></i>
                                <a href="/news/grafik-raboty-magazina.html" target="_blank">График работы</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="footer__caption"></div>
                        <div class="footer__link"><a href="{{ route('page', 'oplata-i-dostavka-po-moskve-i-rossii') }}">Доставка и оплата</a></div>
                        <div class="footer__link"><a href="{{ route('page', 'obmen-i-vozvrat') }}">Обмен и возврат</a></div>
                        <div class="footer__link"><a href="{{ route('page', 'contact') }}">Контакты</a></div>
                        <div class="footer__link"><a href="{{ route('page', 'usloviya-ispolzovaniya-sayta') }}">Условия использования сайта</a></div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
