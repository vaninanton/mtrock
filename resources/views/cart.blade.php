@section('meta_title', 'Корзина')

<x-app-layout>
    <x-slot:header>
        <x-top-header h1="Корзина">
            <x-slot:breadcrumbs>
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 lg:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="/" class="inline-flex items-center text-sm font-medium text-white hover:text-gray-100">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                </svg>
                                Mountain-Rock.ru
                            </a>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-100 lg:ml-2 cursor-default">Корзина</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </x-slot:breadcrumbs>
        </x-top-header>
    </x-slot:header>

    <div class="container mx-auto p-4">
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <x-auth-session-status :status="$errors" class="mt-2" />

        <table class="border-collapse border border-slate-500 bg-white table-auto w-full">
            <thead class="thead-inverse">
                <tr>
                    <th class="border border-slate-400 p-1 hidden md:table-cell"></th>
                    <th class="border border-slate-400 p-1 ">Товар</th>
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
                    <td class="border border-slate-400 p-1 hidden md:table-cell">
                        <a href="{{ Storage::url($product->image) }}">
                            <img src="{{ Storage::url($product->image) }}" alt="" loading="lazy" class="h-4">
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
                        <div class="hidden mb-2">
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
                <div class="relative z-0 mb-6 w-full group">
                    <input type="email" name="email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " autocomplete="email" value="{{ old('email')}}" required />
                    <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">E-mail</label>
                </div>
                <div class="relative z-0 mb-6 w-full group">
                    <input type="tel" name="phone" id="floating_phone" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " autocomplete="tel" value="{{ old('phone')}}" required />
                    <label for="floating_phone" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Номер телефона</label>
                </div>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 mb-6 w-full group">
                    <input type="text" name="last_name" id="floating_last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " autocomplete="family-name" value="{{ old('last_name')}}" required />
                    <label for="floating_last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Фамилия</label>
                </div>
                <div class="relative z-0 mb-6 w-full group">
                    <input type="text" name="first_name" id="floating_first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " autocomplete="given-name" value="{{ old('first_name')}}" required />
                    <label for="floating_first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Имя</label>
                </div>
            </div>
            <div class="relative z-0 mb-6 w-full group">
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Страна</label>
                <select name="country" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="Россия" selected>Россия</option>
                    <option value="Другая">Другая</option>
                </select>
            </div>
            <div class="grid md:grid-cols-3 md:gap-6">
                <div class="relative z-0 mb-6 w-full group">
                    <input type="text" name="city" id="floating_city" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " autocomplete="city" value="{{ old('city')}}" required />
                    <label for="floating_city" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Город</label>
                </div>
                <div class="relative z-0 mb-6 w-full group">
                    <input type="text" name="street" id="floating_street" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " autocomplete="street" value="{{ old('street')}}" required />
                    <label for="floating_street" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Улица</label>
                </div>
                <div class="relative z-0 mb-6 w-full group">
                    <input type="text" name="house" id="floating_house" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " autocomplete="text" value="{{ old('house')}}" required />
                    <label for="floating_house" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Улица</label>
                </div>
                <div class="relative z-0 mb-6 w-full group">
                    <input type="text" name="apartment" id="floating_apartment" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " autocomplete="text" value="{{ old('apartment')}}" required />
                    <label for="floating_apartment" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Улица</label>
                </div>
            </div>

            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

        </form>
    </div>
</x-app-layout>