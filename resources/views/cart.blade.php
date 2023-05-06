@section('meta_title', 'Корзина')

<x-app-layout>
    <x-slot:header>
        <x-top-header h1="Корзина">
            <x-slot:breadcrumbs>
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 lg:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="/"
                               class="inline-flex items-center text-sm font-medium text-white hover:text-gray-100">
                                <svg class="mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                          d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                    </path>
                                </svg>
                                Mountain-Rock.ru
                            </a>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="h-6 w-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                <span
                                      class="ml-1 cursor-default text-sm font-medium text-gray-100 lg:ml-2">Корзина</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </x-slot:breadcrumbs>
        </x-top-header>
    </x-slot:header>

    <div class="container mx-auto p-4">
        <div id="cart">
            <cart></cart>
        </div>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <x-auth-session-status :status="$errors" class="mt-2" />

        <table class="w-full table-auto border-collapse border border-slate-500 bg-white">
            <thead class="thead-inverse">
                <tr>
                    <th class="hidden border border-slate-400 p-1 md:table-cell"></th>
                    <th class="border border-slate-400 p-1">Товар</th>
                    <th class="border border-slate-400 p-1 text-center">Количество</th>
                    <th class="border border-slate-400 p-1 text-center">Сумма</th>
                </tr>
            </thead>
            <tbody class="cart__list">
                @php
                    $basketCost = 0;
                @endphp
                @foreach ($cart->products as $product)
                    @php
                        $itemPrice = $product->price;
                        $itemQuantity = $product->pivot->quantity;
                        $itemCost = $itemPrice * $itemQuantity;
                        $basketCost = $basketCost + $itemCost;
                    @endphp
                    <tr class="">
                        <td class="hidden border border-slate-400 p-1 md:table-cell">
                            <a href="{{ Storage::url($product->image) }}">
                                <img src="{{ Storage::url($product->image) }}" alt="" loading="lazy"
                                     class="h-4">
                            </a>
                        </td>
                        <td class="border border-slate-400 p-1">
                            <a href="{{ $product->route }}" class="">
                                {{ $product->title }}
                            </a>
                            <div class="text-sm">
                                @money($itemPrice)
                            </div>
                        </td>
                        <td class="border border-slate-400 p-1 text-center">
                            <div class="mb-2 hidden">
                                @money($itemCost)
                            </div>
                            <div class="grid grid-cols-3" role="group" aria-label="Количество товара в корзине">
                                <form action="{{ route('cart.minus', $product) }}" method="post">
                                    @csrf
                                    @method('post')
                                    <button type="submit"><i class="fas fa-minus" aria-hidden="true"></i> -</button>
                                </form>
                                <span>{{ $itemQuantity }}</span>
                                <form action="{{ route('cart.plus', $product) }}" method="post">
                                    @csrf
                                    @method('post')
                                    <button type="submit"><i class="fas fa-plus" aria-hidden="true"></i> +</button>
                                </form>
                            </div>
                        </td>
                        <td class="border border-slate-400 p-1 text-center">
                            @money($itemCost)
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-right">
            <div>Итого: @money($basketCost)</div>
        </div>

        <form action="{{ route('cart.checkout') }}" method="post">
            @csrf
            @method('put')

            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="group relative z-0 mb-6 w-full">
                    <input id="floating_email" type="email" name="email"
                           class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent py-2.5 px-0 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                           placeholder=" " autocomplete="email" value="{{ old('email') }}" required />
                    <label for="floating_email"
                           class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">E-mail</label>
                </div>
                <div class="group relative z-0 mb-6 w-full">
                    <input id="floating_phone" type="tel" name="phone"
                           class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent py-2.5 px-0 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                           placeholder=" " autocomplete="tel" value="{{ old('phone') }}" required />
                    <label for="floating_phone"
                           class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">Номер
                        телефона</label>
                </div>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="group relative z-0 mb-6 w-full">
                    <input id="floating_last_name" type="text" name="last_name"
                           class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent py-2.5 px-0 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                           placeholder=" " autocomplete="family-name" value="{{ old('last_name') }}" required />
                    <label for="floating_last_name"
                           class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">Фамилия</label>
                </div>
                <div class="group relative z-0 mb-6 w-full">
                    <input id="floating_first_name" type="text" name="first_name"
                           class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent py-2.5 px-0 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                           placeholder=" " autocomplete="given-name" value="{{ old('first_name') }}" required />
                    <label for="floating_first_name"
                           class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">Имя</label>
                </div>
            </div>
            <div class="group relative z-0 mb-6 w-full">
                <label for="countries"
                       class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Страна</label>
                <select id="countries" name="country"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                    <option value="Россия" selected>Россия</option>
                    <option value="Другая">Другая</option>
                </select>
            </div>
            <div class="grid md:grid-cols-3 md:gap-6">
                <div class="group relative z-0 mb-6 w-full">
                    <input id="floating_city" type="text" name="city"
                           class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent py-2.5 px-0 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                           placeholder=" " autocomplete="city" value="{{ old('city') }}" required />
                    <label for="floating_city"
                           class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">Город</label>
                </div>
                <div class="group relative z-0 mb-6 w-full">
                    <input id="floating_street" type="text" name="street"
                           class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent py-2.5 px-0 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                           placeholder=" " autocomplete="street" value="{{ old('street') }}" required />
                    <label for="floating_street"
                           class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">Улица</label>
                </div>
                <div class="group relative z-0 mb-6 w-full">
                    <input id="floating_house" type="text" name="house"
                           class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent py-2.5 px-0 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                           placeholder=" " autocomplete="text" value="{{ old('house') }}" required />
                    <label for="floating_house"
                           class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">Улица</label>
                </div>
                <div class="group relative z-0 mb-6 w-full">
                    <input id="floating_apartment" type="text" name="apartment"
                           class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent py-2.5 px-0 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                           placeholder=" " autocomplete="text" value="{{ old('apartment') }}" required />
                    <label for="floating_apartment"
                           class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">Улица</label>
                </div>
            </div>

            <button type="submit"
                    class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 sm:w-auto">Submit</button>

        </form>
    </div>
</x-app-layout>
