@section('meta_title', 'Контакты и пункт выдачи')

<x-app-layout>
    <x-slot:header>
        <x-top-header h1="Контакты и пункт самовывоза" subheading="<strong>ВНИМАНИЕ!</strong><br>В пункте самовывоза находится только предварительно заказанный товар!">
            <x-slot:breadcrumbs>
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 lg:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="/" class="inline-flex items-center text-sm font-medium text-white hover:text-gray-100">
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
                                <span class="ml-1 text-sm font-medium text-gray-100 lg:ml-2 cursor-default">Контакты</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                </x-slot>
        </x-top-header>
    </x-slot:header>

    <div class="container mx-auto -mt-16">
        <div class="grid lg:grid-cols-2">
            <div class="px-2">
                <div class="border-b p-2 pt-16">
                    <h2>Пункт самовывоза:</h2>
                    <p>г.&nbsp;Москва, ул.&nbsp;Подольских курсантов, д.&nbsp;3, стр.&nbsp;7А</p>
                    <p>м.&nbsp;Пражская</p>
                </div>
                <div class="border-bottom p-4 mb-8">
                    <h2>Время работы:</h2>
                    <div>
                        <div>понедельник - пятница: с&nbsp;09:00 до&nbsp;19:00</div>
                        <div>суббота - воскресенье: выходной</div>
                    </div>
                </div>
                <div class="mb-4 border-b border-gray-200">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" data-tabs-toggle="#contactWayContent" role="tablist">
                        <li class="mr-2" role="presentation">
                            <button class="inline-block p-4 rounded-t-lg border-b-2" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Пешком</button>
                        </li>
                        <li role="presentation">
                            <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">На автомобиле</button>
                        </li>
                    </ul>
                </div>
                <div id="contactWayContent" class="mb-4">
                    <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Станция метро «Пражская», первый вагон из центра. Из стеклянных дверей налево, выход из метро №2 (прямо), далее вдоль ТЦ «Колумбус». Перейдите Варшавское Шоссе, двигайтесь прямо на улицу Подольских Курсантов, через 400 метров слева будет двухэтажное синее здание автомойки. Вход на территорию осуществляется через шлагбаум, слева на здании вывеска «MOBIUS» и коричневые ворота, Вам сюда.
                        </p>
                    </div>
                    <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Перед тоннелем на&nbsp;ул. Подольских Курсантов съезжаете направо, затем поворачиваете налево, проезжаете над Варшавским шоссе. Далее двигаетесь по&nbsp;ул. Подольских Курсантов до&nbsp;первого светофора. Производите разворот в&nbsp;обратную сторону и&nbsp;сворачиваете в&nbsp;первый заезд на&nbsp;территорию (к&nbsp;шлагбауму). Из&nbsp;области: С&nbsp;Варшавского шоссе повернуть направо на&nbsp;ул. Подольских Курсантов. На&nbsp;первом светофоре развернуться в&nbsp;обратную сторону и&nbsp;свернуть в&nbsp;первый заезд на&nbsp;территорию к&nbsp;шлагбауму.
                        </p>
                    </div>
                </div>
            </div>
            <div class="h-80 md:h-full w-full -mx-0 rounded-t-xl overflow-hidden shadow-lg">
            </div>
        </div>
        <div class="p-4">
            <div id="contact_us_map" class="h-96 w-full"></div>
            <p>О наличии товара на складе можно узнать по телефону: <a href="tel:+74993918019">8(499)391-80-19</a> или e-mail: <a href="mailto:admin@mountain-rock.ru">admin@mountain-rock.ru</a></p>
            <p>Большая просьба, перед тем как приезжать в пункт самовывоза, уточняйте о наличии товара у менеджера по телефону или по электронной почте <a href="mailto:admin@mountain-rock.ru">admin@mountain-rock.ru</a>. Оплатить товар в ПВЗ возможно только наличными. В пункте самовывоза выдается только тот товар, который предварительно был заказан через интернет или по телефону. </p>

            <h2>О фирме:</h2>
            <p>ИП «Волков Сергей Владимирович»</p>
            <p>ОГРНИП: 318774600603932</p>
            <p>Банк «Финансовая Корпорация Открытие» счёт № 40802810701500025796 RUB.</p>
            <p>Обращаем ваше внимание на то, что данный Интернет-сайт носит исключительно информационный характер и ни при каких условиях не является публичной офертой, определяемой положением Статьи 437 Гражданского кодекса Российской Федерации. Для получения информации о наличии товара обращайтесь к менеджерам по телефону: <a href="tel:+74993918019">8(499)391-80-19</a></p>
            <p>Генеральный директор: Волков С. В. <a href="https://tochka.com/my/mountain-rock" target="_blank">https://tochka.com/my/mountain-rock</a></p>
        </div>
    </div>
    <script src="https://api-maps.yandex.ru/3.0/?apikey=3cd5d586-6560-42fe-a387-74906dfc84b2&lang=ru_RU"></script>
    <script>
        ymaps3.ready.then(init);

        function init() {
            const map = new ymaps3.YMap(document.getElementById('contact_us_map'), {
                location: {
                center: [55.61026100966122, 37.60977549999999],
                zoom: 15.5
                }
            });
        }
    </script>
    {{--
    <script>
        window.ymapsonload = () => {
        const ways = {
            wayPedestrian() {
                window.map.geoObjects.removeAll();
                window.multiRoute = new ymaps.multiRouter.MultiRoute({
                    referencePoints: [
                        'Москва, метро Пражская, 2 выход',
                        [55.60955753229176, 37.615418721563714],
                        [55.60967174487069, 37.61473255753445],
                        window.pointB,
                    ],
                    params: {
                        routingMode: 'pedestrian',
                    },
                }, {
                    wayPointVisible: false,
                    routeActiveMarkerVisible: false,
                    routeOpenBalloonOnClick: false,
                    boundsAutoApply: true,
                });

                // multiRoute.editor.start({
                //     addWayPoints: true,
                //     removeWayPoints: true
                // });

                window.map.geoObjects.add(window.pointB).add(window.multiRoute);
            },
            wayCar() {
                window.map.geoObjects.removeAll();
                window.multiRoute = new ymaps.multiRouter.MultiRoute({
                    referencePoints: [
                        [55.61306805825558, 37.61034845353013],
                        // [55.60955753229176, 37.615418721563714],
                        // [55.60967174487069, 37.61473255753445],
                        [55.60935408789969, 37.615306068786225],
                    ],
                    params: {
                        // routingMode: 'pedestrian'
                    },
                }, {
                    wayPointVisible: false,
                    routeActiveMarkerVisible: false,
                    routeOpenBalloonOnClick: false,
                    boundsAutoApply: true,
                });

                // multiRoute.editor.start({
                //     addWayPoints: true,
                //     removeWayPoints: true
                // });

                window.map.geoObjects.add(window.pointB).add(window.multiRoute);
            },
        };

        ymaps.ready(() => {
            // if ($('#contact_us_map').length) {
                window.map = new ymaps.Map('contact_us_map', {
                    center: [55.61026100966122, 37.60977549999999],
                    zoom: 15.5,
                    controls: [],
                });

                // if (window.map) {
                    // $('a[data-toggle="list"]').on('shown.bs.tab', (event) => {
                    //     window.map.container.fitToViewport();
                    //     const setRoute = $(event.target).data('setRoute');
                    //     ways[setRoute]();
                    // });

                    window.pointB = new ymaps.Placemark([55.609846, 37.614834], {
                        balloonContentHeader: 'Пункт самовывоза',
                        balloonContent: '<strong>Mountain-Rock.ru</strong><br>ул.&nbsp;Подольских курсантов, д.&nbsp;3, стр.&nbsp;7',
                        balloonContentFooter: 'ВНИМАНИЕ! В пункте самовывоза находится только предварительно забронированный товар.',
                        hintContent: 'Пункт самовывоза Mountain-Rock.ru',
                    }, {
                        iconColor: '#0450b1',
                    });

                    ways.wayPedestrian();
                // }
            // }
        });
    };
    </script>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=3cd5d586-6560-42fe-a387-74906dfc84b2&onload=ymapsonload" async></script>
    --}}
</x-app-layout>
