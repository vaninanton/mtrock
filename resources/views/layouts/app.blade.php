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
        <div class="bg-amber-300 text-center">
            <p><strong>Уважаемые покупатели, пункт выдачи заказов на м. Пражская не работает по выходным дням!</span></strong></p>
            <p><strong>Пункт выдачи заказов работает с 9.00 до 19.00 в будни.</strong></p>
        </div>
        <nav class="bg-gray-900 text-white">
            <ul class="flex justify-center">
                <li class="flex">
                    <a href="/news" class="p-2 transition-colors hover:bg-blue-800">Новости</a>
                </li>
                <li class="flex">
                    <a href="/oplata-i-dostavka-po-moskve-i-rossii" class="p-2 transition-colors hover:bg-blue-800">Оплата и&nbsp;доставка</a>
                </li>
                <li class="flex">
                    <a href="/contact" class="p-2 transition-colors hover:bg-blue-800">Контакты и&nbsp;Пункт выдачи</a>
                </li>
                <li class="hidden sm:flex">
                    <a href="/obmen-i-vozvrat" class="p-2 transition-colors hover:bg-blue-800">Обмен и&nbsp;возврат</a>
                </li>
            </ul>
        </nav>
        <div class="container mx-auto px-4">
            <header class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div>
                    <img src="https://mountain-rock.ru/img/logo.svg" alt="">
                </div>
                <div>
                    <div>
                        <div>
                            <a href="tel:+74993918019" class="text-xl font-bold">+7 (499) 391-80-19</a>
                            <a href="https://api.whatsapp.com/send?phone=79253918019" target="_blank" rel="noopener" aria-hidden="true">whatsapp</a>
                        </div>
                        <div>
                            <a href="#" class="btn btn-sm btn-primary">Перезвоните мне!</a>
                        </div>
                        <div>
                            <a href="/news/grafik-raboty-magazina.html" target="_blank">График работы</a>
                        </div>
                    </div>
                </div>
                <div>
                    <form>
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="search" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search Mockups, Logos..." required>
                            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
                        </div>
                    </form>
                    <div class="flex">
                        <a href="https://vk.com/mountain_rock" class="" target="_blank" rel="noopener" aria-hidden="true">
                            <i class="fab fa-vk"></i>
                        </a>
                        <a href="https://www.youtube.com/channel/UChOd0Q9idSkU2U2TIp0yTlQ" class="" target="_blank" rel="noopener" aria-hidden="true">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="https://api.whatsapp.com/send?phone=79253918019" class="" target="_blank" rel="noopener" aria-hidden="true">
                            <i class="fab fa-whatsapp-square"></i>
                        </a>
                        <a href="https://market.yandex.ru/shop/126772/reviews" target="_blank" rel="nofollow noopener noreferrer" title="Читайте отзывы на Яндекс.Маркете">
                            <img width="88" height="31" alt="Читайте отзывы покупателей и оценивайте качество магазина на Яндекс.Маркете" class="" src="https://mountain-rock.ru/img/rating_5_0.png">
                        </a>
                    </div>
                </div>
                <div>
                    Корзина
                </div>
            </header>
        </div>
        <div class="bg-gray-50 py-8">
            <div class="container max-w-4xl mx-auto px-4 flex">
                <main class="border bg-white">
                    {{ $slot }}
                </main>
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
                        <div class="footer__link"><a href="/oplata-i-dostavka-po-moskve-i-rossii">Доставка и оплата</a></div>
                        <div class="footer__link"><a href="/obmen-i-vozvrat">Обмен и возврат</a></div>
                        <div class="footer__link"><a href="/contact">Контакты</a></div>
                        <div class="footer__link"><a href="/usloviya-ispolzovaniya-sayta">Условия использования сайта</a></div>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
