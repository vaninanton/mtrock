@section('meta_title', $product->title.' купить')
@section('meta_description', $product->title.' - '.strip_tags($product->short_description))

<x-app-layout>
    <x-top-header :h1="$product->title">
        <x-slot:breadcrumbs>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 lg:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="/" class="inline-flex items-center text-sm font-medium text-white hover:text-gray-200">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Главная
                        </a>
                    </li>
                    @if ($product->category)
                    <li class="inline-flex items-center">
                        <a href="{{ route('category', $product->category) }}" class="inline-flex items-center text-sm font-medium text-white hover:text-gray-200">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $product->category->title }}
                        </a>
                    </li>
                    @endif
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-100 lg:ml-2 cursor-default">{{ $product->title }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </x-slot>
    </x-top-header>

    <div class="container mx-auto">
        <div class="grid md:grid-cols-3">
            <div class="p-4 md:order-3">
                <div class="flex gap-4">
                    <div class="flex-1 text-right">
                        @if($product->old_price && $product->old_price > $product->price)
                        <del class="block line-through decoration-red-300">@money($product->old_price)</del>
                        @endif
                        <div class="text-2xl font-bold text-blue-900">@money($product->price)</div>
                    </div>
                    <div class="flex-0 text-right">
                        @if ($product->quantity > 0)
                        <form action="{{ route('cart.put') }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="text-2xl px-6 py-3.5 bg-blue-700 addtocart">
                                Купить
                            </button>
                        </form>
                        <div><small>Товар в наличии</small></div>
                        @else
                        <button class="text-slate-800 bg-slate-300 hover:bg-slate-300 font-medium rounded-lg text-2xl px-6 py-3.5 text-center">
                            Купить
                        </button>
                        <div><small>Нет в наличии</small></div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="p-4 md:order-2">
                <h1 class="h1">
                    {{ $product->title }}
                </h1>
                @if ($product->brand)
                <a href="{{ route('brand.show', $product->brand) }}" class="text-blue-600 hover:text-blue-800">
                    <img src="https://mountain-rock.ru/uploads/thumbs/store/producer/300x300_{{ $product->brand->image }}" alt="{{ $product->brand->title }}" class="inline h-4" loading="lazy">
                    {{ $product->brand->title }}
                </a>
                @endif
                <div class="text-lg pb-4 mb-6 border-b">{{ strip_tags($product->short_description) }}</div>
                <div>Артикул: {{ $product->sku }}</div>
                @if ($product->weight)
                <div>Вес: {{ $product->humanWeight }}</div>
                @endif
                @if ($product->length || $product->width || $product->height)
                <div>Размер: {{ $product->humanSize }}</div>
                @endif
            </div>
            <div class="bg-white md:order-1 p-4">
                <img src="https://mountain-rock.ru/uploads/store/product/{{ $product->image }}" alt="" class="block h-auto w-full" loading="lazy">
                <div class="flex justify-center items-center gap-4 mt-4">
                    <a href="#">
                        <img src="https://picsum.photos/40/30?random=12345" alt="" class="transition-transform transform-gpu hover:scale-150" loading="lazy">
                    </a>
                    <a href="#">
                        <img src="https://picsum.photos/30/30?random=12345" alt="" class="transition-transform transform-gpu hover:scale-150" loading="lazy">
                    </a>
                    <a href="#">
                        <img src="https://picsum.photos/30/40?random=12345" alt="" class="transition-transform transform-gpu hover:scale-150" loading="lazy">
                    </a>
                    <a href="#">
                        <img src="https://picsum.photos/30/10?random=12345" alt="" class="transition-transform transform-gpu hover:scale-150" loading="lazy">
                    </a>
                </div>
            </div>
        </div>
        <div class="grid md:grid-cols-3 bg-blue-900 text-white">
            <a href="/contact" target="_blank" rel="nofollow" class="py-8 px-8">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-auto w-1/4 w-sm-25 fill-white transition-all hover:-rotate-12">
                    <path d="M116 412c-16.543 0-30 13.457-30 30s13.457 30 30 30 30-13.457 30-30-13.457-30-30-30zm0 40c-5.516 0-10-4.484-10-10s4.484-10 10-10 10 4.484 10 10-4.484 10-10 10zm0 0"></path>
                    <path d="M482 412h-16V196c0-5.523-4.477-10-10-10h-50V50c0-5.523-4.477-10-10-10H196c-5.523 0-10 4.477-10 10v362h-6.746A69.582 69.582 0 0 0 146 378.746V30c0-16.543-13.457-30-30-30H30C13.457 0 0 13.457 0 30s13.457 30 30 30h56v318.746C61.812 390.23 46 414.81 46 442c0 38.598 31.402 70 70 70 27.191 0 51.77-15.813 63.254-40H482c16.543 0 30-13.457 30-30s-13.457-30-30-30zm-36 0H206V206h70v106a9.997 9.997 0 1 0 16 8l34-25.5 34 25.5a9.998 9.998 0 0 0 16-8V206h70zM296 206h60v86l-24-18a9.997 9.997 0 0 0-12 0l-24 18zM276 60h40v57.313l-14.453-9.633c-1.68-1.121-3.613-1.68-5.547-1.68s-3.867.559-5.547 1.68L276 117.312zm-20 0v76a10.001 10.001 0 0 0 15.547 8.32L296 128.02l24.453 16.3A10 10 0 0 0 336 136V60h50v126H206V60zM30 40c-5.516 0-10-4.484-10-10s4.484-10 10-10h86c5.516 0 10 4.484 10 10v342.723c-3.297-.473-6.633-.723-10-.723s-6.703.25-10 .723V50c0-5.523-4.477-10-10-10zm86 452c-27.57 0-50-22.43-50-50 0-27.273 22.063-50 50-50 27.93 0 50 22.75 50 50 0 27.938-22.727 50-50 50zm366-40H185.277c.473-3.297.723-6.633.723-10s-.254-6.703-.723-10H482c5.516 0 10 4.484 10 10s-4.484 10-10 10zm0 0"></path>
                    <path d="M416 392c5.523 0 10-4.477 10-10v-20c0-5.523-4.477-10-10-10s-10 4.477-10 10v20c0 5.523 4.477 10 10 10zm0 0M416 312c5.52 0 10 4.48 10 10s-4.48 10-10 10-10-4.48-10-10 4.48-10 10-10zm0 0M376 352c-5.523 0-10 4.477-10 10v20c0 5.523 4.477 10 10 10s10-4.477 10-10v-20c0-5.523-4.477-10-10-10zm0 0"></path>
                </svg>
                <div class="advantage__item__title">Самовывоз</div>
                <div class="advantage__item__descr">
                    Пункт выдачи заказов находится в&nbsp;9&nbsp;минутах от&nbsp;м.&nbsp;Пражская
                </div>
            </a>
            <a href="/oplata-i-dostavka" target="_blank" rel="nofollow" class="py-8 px-8">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -36 512 512" class="h-auto w-1/4 w-sm-25 fill-white transition-all hover:-rotate-12">
                    <path d="M432 360c-11.05 0-20 8.95-20 20s8.95 20 20 20 20-8.95 20-20-8.95-20-20-20zm0 0M422 280c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10zm0 0M126 360c-11.05 0-20 8.95-20 20s8.95 20 20 20 20-8.95 20-20-8.95-20-20-20zm0 0"></path>
                    <path d="M469.969 240.64l-17.242-68.968C458.875 165.785 462 158.008 462 150c0-16.543-13.457-30-30-30h-70c-16.543 0-30 13.457-30 30v131.719A29.86 29.86 0 0 0 322 280h-30V160h10c5.523 0 10-4.477 10-10V90c0-5.523-4.477-10-10-10h-46.027C262.266 71.637 266 61.246 266 50c0-27.57-22.43-50-50-50-24.168 0-44.383 17.238-49.004 40.063A9.47 9.47 0 0 0 166 40c-.336 0-.668.023-1 .031C160.367 17.223 140.156 0 116 0 88.43 0 66 22.43 66 50c0 11.246 3.734 21.637 10.027 30H30c-5.523 0-10 4.477-10 10v60c0 5.523 4.477 10 10 10h10v120H30c-16.543 0-30 13.457-30 30v40c0 16.543 13.457 30 30 30h36c0 33.086 26.914 60 60 60s60-26.914 60-60h186c0 33.086 26.914 60 60 60s60-26.914 60-60c0-.57-.027-1.137-.043-1.707C503.617 374.18 512 363.051 512 350v-60c0-24.86-18.234-45.531-42.031-49.36zM434.19 180l15 60h-83.05l22.93-22.93c3.906-3.906 3.906-10.234 0-14.14s-10.235-3.907-14.141 0L352 225.855V180zM362 140h70c5.516 0 10 4.484 10 10 0 5.523-4.48 10-10 10h-80v-10c0-5.516 4.484-10 10-10zm-90 140h-56V160h56zM136 160h60v120h-60zm29.418-99.996l8.656 1.094c9.25 2.578 16.918 9.593 20.215 18.902h-56.547c4.13-11.57 14.973-19.754 27.676-19.996zM196 100v40h-60v-40zm96 40h-76v-40h76zM216 20c16.543 0 30 13.457 30 30s-13.457 30-30 30c-.344 0-.68-.02-1.023-.031-3.13-15.36-13.415-28.75-28.45-35.54C189.145 30.54 201.363 20 216 20zM86 50c0-16.543 13.457-30 30-30 14.633 0 26.848 10.535 29.473 24.418-14.536 6.578-25.188 19.89-28.434 35.55-.348.012-.691.032-1.039.032-16.543 0-30-13.457-30-30zm-46 50h76v40H40zm76 60v120H60V160zm10 260c-22.055 0-40-17.945-40-40 0-22.355 18.27-40 40-40 21.781 0 40 17.691 40 40 0 22.055-17.945 40-40 40zm56.566-60c-8.351-23.602-30.953-40-56.566-40-25.621 0-48.234 16.414-56.57 40H30c-5.516 0-10-4.484-10-10v-40c0-5.516 4.484-10 10-10h292c5.516 0 10 4.484 10 10v50zM432 420c-22.055 0-40-17.945-40-40 0-22.355 18.27-40 40-40 21.781 0 40 17.691 40 40 0 22.055-17.945 40-40 40zm55.855-61.91C478.985 335.52 456.915 320 432 320c-25.621 0-48.234 16.414-56.57 40H352V260h110c13.035 0 24.152 8.36 28.281 20H462c-5.523 0-10 4.477-10 10s4.477 10 10 10h30v50c0 3.324-1.64 6.27-4.145 8.09zm0 0"></path>
                </svg>

                <div class="advantage__item__title">Доставка по&nbsp;Москве</div>
                <div class="advantage__item__descr">
                    Бесплатная курьерская доставка (в&nbsp;пределах&nbsp;МКАД)
                </div>
            </a>
            <a href="/dostavka-dostavka-turisticheskih-tovarov-i-snaryazheniya-po-rossii-i-stranam-sng" target="_blank" rel="nofollow" class="py-8 px-8">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -66 512 512" class="h-auto w-1/4 w-sm-25 fill-white transition-all hover:-rotate-12">
                    <path d="M432 300c-11.05 0-20 8.95-20 20s8.95 20 20 20 20-8.95 20-20-8.95-20-20-20zm0 0M422 220c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10zm0 0M126 300c-11.05 0-20 8.95-20 20s8.95 20 20 20 20-8.95 20-20-8.95-20-20-20zm0 0"></path>
                    <path d="M469.969 180.64l-17.242-68.968C458.855 105.809 462 98.032 462 90c0-16.543-13.457-30-30-30h-80V30c0-16.543-13.457-30-30-30H30C13.457 0 0 13.457 0 30v260c0 16.543 13.457 30 30 30h36c0 33.086 26.914 60 60 60s60-26.914 60-60h186c0 33.086 26.914 60 60 60s60-26.914 60-60c0-.57-.027-1.137-.043-1.707C503.617 314.18 512 303.051 512 290v-60c0-24.86-18.234-45.531-42.031-49.36zM434.19 120l15 60h-83.05l22.93-22.93c3.906-3.906 3.906-10.234 0-14.14s-10.235-3.907-14.141 0L352 165.855V120zM442 90c0 5.52-4.48 10-10 10h-80V80h80c5.516 0 10 4.484 10 10zM126 360c-22.055 0-40-17.945-40-40 0-22.355 18.27-40 40-40 21.781 0 40 17.691 40 40 0 22.055-17.945 40-40 40zm56.566-60c-8.351-23.598-30.957-40-56.566-40-25.621 0-48.234 16.414-56.57 40H30c-5.516 0-10-4.484-10-10V30c0-5.516 4.484-10 10-10h292c5.516 0 10 4.484 10 10v270zM432 360c-22.055 0-40-17.945-40-40 0-22.355 18.27-40 40-40 21.781 0 40 17.691 40 40 0 22.055-17.945 40-40 40zm55.855-61.91C478.985 275.52 456.915 260 432 260c-25.621 0-48.234 16.414-56.57 40H352V200h110c13.035 0 24.152 8.36 28.281 20H462c-5.523 0-10 4.477-10 10s4.477 10 10 10h30v50c0 3.324-1.64 6.27-4.145 8.09zm0 0"></path>
                    <path d="M176 60c-49.625 0-90 40.375-90 90s40.375 90 90 90 90-40.375 90-90-40.375-90-90-90zm0 160c-38.598 0-70-31.402-70-70s31.402-70 70-70 70 31.402 70 70-31.402 70-70 70zm0 0"></path>
                    <path d="M216 140h-30v-30c0-5.523-4.477-10-10-10s-10 4.477-10 10v40c0 5.523 4.477 10 10 10h40c5.523 0 10-4.477 10-10s-4.477-10-10-10zm0 0"></path>
                </svg>

                <div class="advantage__item__title">Доставка по&nbsp;РФ</div>
                <div class="advantage__item__descr">Отправим любым удобным для&nbsp;Вас&nbsp;способом!</div>
            </a>
        </div>
        <div class="content py-8 mx-auto max-w-xl">
            {!! $product->description !!}
        </div>

        <hr class="my-8">
        <h2 class="h2">SET:</h2>
        <div class="grid grid-cols-4 gap-8 px-4">
            @foreach($product->linked as $product)
            <x-product-card :product="$product" />
            @endforeach
        </div>

        <hr class="my-8">
        <h2 class="h2">Просмотренные товары:</h2>
        <div class="grid grid-cols-4 gap-8 px-4">
            @foreach($recentlyViewed as $product)
            <x-product-card :product="$product" />
            @endforeach
        </div>
    </div>
</x-app-layout>
