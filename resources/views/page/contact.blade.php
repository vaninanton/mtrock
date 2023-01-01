@section('meta_title', 'Контакты и пункт выдачи')

<x-app-layout>
    <div class="grid md:grid-cols-2">
        <div class="px-2">
            <div class="border-b p-2">
                <h1>Пункт самовывоза:</h1>
                <div class="bg-slate-200 -mx-4 px-4 py-2 text-sm mb-4">ВНИМАНИЕ! В пункте самовывоза находится только предварительно забронированный товар!</div>
                <p>г.&nbsp;Москва, ул.&nbsp;Подольских курсантов, д.&nbsp;3, стр.&nbsp;7А</p>
                <p>м.&nbsp;Пражская</p>
            </div>
            <div class="border-bottom p-4">
                <h3>Время работы:</h3>
                <div>
                    <div>понедельник - пятница: с&nbsp;09:00 до&nbsp;19:00</div>
                    <div>суббота - воскресенье: выходной</div>
                </div>
            </div>
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
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
        <div id="contact_us_map" class="h-80 md:h-full w-full -mx-0"></div>
    </div>
    <div class="p-4">
        <p>О наличии товара на складе можно узнать по телефону: <a href="tel:+74993918019">8(499)391-80-19</a> или e-mail: <a href="mailto:admin@mountain-rock.ru">admin@mountain-rock.ru</a></p>
        <p>Большая просьба, перед тем как приезжать в пункт самовывоза, уточняйте о наличии товара у менеджера по телефону или по электронной почте <a href="mailto:admin@mountain-rock.ru">admin@mountain-rock.ru</a>. Оплатить товар в ПВЗ возможно только наличными. В пункте самовывоза выдается только тот товар, который предварительно был заказан через интернет или по телефону. </p>

        <h2>О фирме:</h2>
        <p>ИП «Волков Сергей Владимирович»</p>
        <p>ОГРНИП: 318774600603932</p>
        <p>Банк «Финансовая Корпорация Открытие» счёт № 40802810701500025796 RUB.</p>
        <p>Обращаем ваше внимание на то, что данный Интернет-сайт носит исключительно информационный характер и ни при каких условиях не является публичной офертой, определяемой положением Статьи 437 Гражданского кодекса Российской Федерации. Для получения информации о наличии товара обращайтесь к менеджерам по телефону: <a href="tel:+74993918019">8(499)391-80-19</a></p>
        <p>Генеральный директор: Волков С. В. <a href="https://tochka.com/my/mountain-rock" target="_blank">https://tochka.com/my/mountain-rock</a></p>
    </div>

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
</x-app-layout>
