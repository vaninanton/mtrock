<!DOCTYPE html>
<html lang="ru" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('meta_title', config('app.name')) | Mountain-Rock.ru</title>
    <meta name="description" content="@yield('meta_description')">
    <link rel="canonical" href="@yield('canonical', URL::current())">
    <meta name="theme-color" content="#0350b1">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#0350b1">
    <meta name="msapplication-TileColor" content="#2d89ef">

    <meta name="robots" content="index,follow">
    <meta name="google" content="nositelinkssearchbox">
    <meta name="google" content="notranslate">
    <meta name="format-detection" content="telephone=no">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased" itemscope itemtype="http://schema.org/WebPage">
    <div class="bg-slate-800 text-white">
        <div class="container px-4 mx-auto flex justify-between items-center">
            <div>
                <div>+7 (499) 391-80-19 <button type="button">Перезвоните мне!</button></div>
            </div>
            <div class="hidden md:flex">
                <x-nav-link href="{{ route('news.index') }}" :active="request()->routeIs('news.*')">Новости</x-nav-link>
                <x-nav-link href="{{ route('brand.index') }}" :active="request()->routeIs('brand.*')">Бренды</x-nav-link>
                <x-nav-link href="{{ route('page', 'oplata-i-dostavka-po-moskve-i-rossii') }}" :active="request()->routeIs('page') && request()->route('page.slug') === 'oplata-i-dostavka-po-moskve-i-rossii'">Оплата и доставка</x-nav-link>
                <x-nav-link href="{{ route('page', 'obmen-i-vozvrat') }}" :active="request()->routeIs('page') && request()->route('page.slug') === 'obmen-i-vozvrat'">Обмен и возврат</x-nav-link>
                <x-nav-link href="{{ route('page', 'contact') }}" :active="request()->routeIs('page') && request()->route('page.slug') === 'contact'">Контакты</x-nav-link>
            </div>
        </div>
    </div>
    <div class="flex flex-col bg-gray-50 min-h-screen justify-between">
        <div>
            <nav class="bg-white border-gray-200">
                <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl px-4 md:px-6 py-2.5">
                    <a href="/" class="flex items-center">
                        <img src="/img/logo.svg" class="mr-3 h-6 sm:h-10" alt="" />
                        Mountain-Rock.ru
                    </a>
                    <button type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" data-drawer-target="drawer-navigation" data-drawer-toggle="drawer-navigation" aria-controls="drawer-navigation">
                        <span class="sr-only">Open main menu</span>
                        <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
            </nav>

            @isset($header)
            {{ $header }}
            @endisset

            <main class="container mx-auto py-8 grid grid-cols-12">
                <x-category-menu class="bg-white border rounded-xl shadow p-8 sticky -top-4 mb-20 z-20" :hasHeader="isset($header)"></x-category-menu>
                <div class="col-span-12 lg:col-span-9 lg:pl-10">
                    {{ $slot }}
                </div>
            </main>

            @if ($recentlyViewed->count())
            <div class="container mx-auto px-4 py-8 border-t">
                <h2 class="h2">Просмотренные товары:</h2>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($recentlyViewed as $product)
                    <x-product-card :product="$product" />
                    @endforeach
                </div>
            </div>
            @endif
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
                                <a href="{{ route('page', 'contact') }}" target="_blank">График работы</a>
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
