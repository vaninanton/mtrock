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

<body class="font-sans antialiased">
    <div class="bg-slate-800 text-white">
        <div class="container px-4 mx-auto flex justify-between items-center">
            <div>
                <div>+7 (499) 391-80-19 <button type="button" data-drawer-target="drawer-contact" data-drawer-show="drawer-contact" aria-controls="drawer-contact">Обратный звонок</button></div>
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
            <nav class="container flex justify-between items-center mx-auto px-4 py-2.5">
                <div>
                    <a href="/" class="flex items-center min-w-[200px]">
                        <img src="/img/logo.svg" class="mr-3 h-6 sm:h-10" alt="Mountain-Rock.ru" />
                        <div class="inline-flex whitespace-nowrap">Mountain-Rock.ru</div>
                    </a>
                </div>
                <div class="hidden sm:block">
                    <form action="{{ route('search') }}" method="get">
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Поиск</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="search" name="query" id="default-search" class="block w-full min-w-[300px] p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary focus:border-primary" placeholder="Поиск по сайту" required>
                            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-primary hover:bg-primary-dark focus:ring-4 focus:outline-none focus:ring-primary-light font-medium rounded-lg text-sm px-4 py-2">Найти</button>
                        </div>
                    </form>
                </div>
                <button type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" data-drawer-target="drawer-navigation" data-drawer-toggle="drawer-navigation" aria-controls="drawer-navigation">
                    <span class="sr-only">Open main menu</span>
                    <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </button>
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

    <div id="drawer-contact" class="fixed z-40 h-screen p-4 overflow-y-auto bg-white w-80 dark:bg-gray-800 transition-transform left-0 top-0 -translate-x-full" tabindex="-1" aria-labelledby="drawer-contact-label" aria-hidden="true">
        <h5 id="drawer-label" class="inline-flex items-center mb-6 text-base font-semibold text-gray-500 uppercase dark:text-gray-400">
            <svg class="w-5 h-5 mr-2" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            Обратный звонок
        </h5>
        <button type="button" data-drawer-toggle="drawer-contact" aria-controls="drawer-contact" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        <form action="#" class="mb-6">
            <div class="mb-6">
                <label for="tel" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ваш телефон</label>
                <input type="tel" id="tel" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="+7 (___) ___-__-__" required>
            </div>
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ваше имя</label>
                <input type="text" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ваше имя" required>
            </div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 w-full focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 block">Перезвоните мне!</button>
        </form>
        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
            <a href="mailto:admin@mountain-rock.ru" class="hover:underline">admin@mountain-rock.ru</a>
        </p>
        <p class="text-sm text-gray-500 dark:text-gray-400">
            <a href="tel:+74993918019" class="hover:underline">+7 (499) 391-80-19</a>
        </p>
    </div>

</body>

</html>
