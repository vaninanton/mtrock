<!DOCTYPE html>
<html lang="ru_RU" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('meta_title', config('app.name')) | Mountain-Rock.ru</title>
    <meta name="description" content="@yield('meta_description')">
    <link rel="canonical" href="@yield('canonical', URL::current())">
    <meta name="theme-color" content="#0350b1">

    <meta name="robots" content="index,follow">
    <meta name="google" content="nositelinkssearchbox">
    <meta name="google" content="notranslate">
    <meta name="format-detection" content="telephone=no">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased" itemscope itemtype="http://schema.org/WebPage">
    <div class="bg-slate-800 text-white">
        <div class="container px-4 mx-auto flex justify-between items-center">
            <div>
                <div>+7 (499) 391-80-19 <button type="button" data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example" data-drawer-placement="right" aria-controls="drawer-right-example">Перезвоните мне!</button></div>
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
                    <button data-collapse-toggle="mega-menu-full" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="mega-menu-full" aria-expanded="false">
                        <span class="sr-only">Открыть меню</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div id="mega-menu-full" class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1">
                        <ul class="flex flex-col mt-4 text-sm font-medium md:flex-row md:space-x-8 md:mt-0">
                            <li>
                                <button id="mega-menu-full-dropdown-button" data-collapse-toggle="mega-menu-full-dropdown" class="flex justify-between items-center py-2 pr-4 pl-3 w-full font-medium text-gray-700 border-b border-gray-100 md:w-auto hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0">Товары для&nbsp;спорта и&nbsp;туризма
                                    <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
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
                                <a href="{{ route('page', 'contact') }}" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Контакты</a>
                            </li>
                            <li>
                                <a href="{{ route('cart.index') }}" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Корзина</a>
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
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </nav>

            @isset($header)
            {{ $header }}
            @endisset

            <main class="container mx-auto px-4 py-8 grid grid-cols-12">
                <div class="hidden lg:block lg:col-span-3">
                    <x-category-menu class="bg-white border rounded-xl shadow p-8 sticky -top-4 mb-20 z-20" :hasHeader="isset($header)"></x-category-menu>
                </div>
                <div class="col-span-12 lg:col-span-9 lg:pl-10 bg-white">
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

    <div id="drawer-right-example" class="fixed z-40 h-screen p-4 overflow-y-auto bg-white w-80 dark:bg-gray-800 transition-transform right-0 top-0 translate-x-full" tabindex="-1" aria-labelledby="drawer-right-label" aria-hidden="true">
        <h5 id="drawer-right-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"><svg class="w-5 h-5 mr-2" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>Right drawer</h5>
        <button type="button" data-drawer-dismiss="drawer-right-example" aria-controls="drawer-right-example" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        <p class="mb-6 text-sm text-gray-500 dark:text-gray-400">Supercharge your hiring by taking advantage of our <a href="#" class="text-blue-600 underline dark:text-blue-500 hover:no-underline">limited-time sale</a> for Flowbite Docs + Job Board. Unlimited access to over 190K top-ranked candidates and the #1 design job board.</p>
        <div class="grid grid-cols-2 gap-4">
            <a href="#" class="px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Learn more</a>
            <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Get access <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg></a>
        </div>
    </div>

</body>

</html>
