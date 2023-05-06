<template>
    <div class="table-responsive">
        <table class="w-full table-auto border-collapse border border-slate-500 bg-white">
            <thead class="thead-inverse">
                <tr>
                    <th class="hidden border border-slate-400 p-1 md:table-cell"></th>
                    <th class="border border-slate-400 p-1 ">Товар</th>
                    <th class="border border-slate-400 p-1 hidden md:table-cell text-center">Цена</th>
                    <th class="border border-slate-400 p-1 text-center">Количество</th>
                    <th class="border border-slate-400 p-1 text-center">Сумма</th>
                    <th class="border border-slate-400 p-1 hidden md:table-cell"></th>
                </tr>
            </thead>
            <tbody class="cart__list">
                <tr class="cart__list__item">
                    <td class="hidden md:table-cell">
                        <a href="https://mountain-rock.ru/uploads/store/product/84f5b58b16d8461d24d0c310b38f893e.jpg">
                            <img src="https://mountain-rock.ru/uploads/thumbs/store/product/180x50_84f5b58b16d8461d24d0c310b38f893e.jpg" class="img-fluid img-thumbnail rounded mx-auto d-block" alt="Alexika Indiana 4">
                        </a>
                    </td>
                    <td class="">
                        <div class="">
                            <a href="/store/palatki/palatki-alexika/palatka-alexika-indiana-4.html" class="">
                                Палатка Alexika Indiana 4
                            </a>
                        </div>
                    </td>
                    <td class="text-center hidden md:table-cell">
                        <span>50&nbsp;999&nbsp;руб.</span>
                    </td>
                    <td class="text-center">
                        <div class="d-mhidden mb-2">
                            <span>50&nbsp;999&nbsp;руб.</span>
                        </div>
                        <div class="btn-group btn-group-sm" role="group" aria-label="Количество товара в корзине">
                            <div class="btn btn-light btn-sm disabled">
                                <svg class="svg-inline--fa fa-minus fa-w-14" aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path fill="currentColor" d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
                                </svg>
                            </div>
                            <span class="btn btn-light js-cart-qty-text" style="pointer-events: none;">1</span>
                            <div class="btn btn-light btn-sm">
                                <svg class="svg-inline--fa fa-plus fa-w-14" aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
                                </svg>
                            </div>
                        </div>
                        <input class="js-cart-qty-val" type="hidden" value="1" name="OrderProduct[product_679_][quantity]" id="OrderProduct_product_679__quantity"> <input type="hidden" value="679" name="OrderProduct[product_679_][product_id]" id="OrderProduct_product_679__product_id">
                    </td>
                    <td class="text-center cart__list__item__summ">
                        50&nbsp;999&nbsp;руб.
                        <div class="mt-2 hidden">
                            <div class="btn btn-light btn-sm text-red-600">
                                <svg class="svg-inline--fa fa-trash-alt fa-w-14" aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path fill="currentColor" d="M268 416h24a12 12 0 0 0 12-12V188a12 12 0 0 0-12-12h-24a12 12 0 0 0-12 12v216a12 12 0 0 0 12 12zM432 80h-82.41l-34-56.7A48 48 0 0 0 274.41 0H173.59a48 48 0 0 0-41.16 23.3L98.41 80H16A16 16 0 0 0 0 96v16a16 16 0 0 0 16 16h16v336a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128h16a16 16 0 0 0 16-16V96a16 16 0 0 0-16-16zM171.84 50.91A6 6 0 0 1 177 48h94a6 6 0 0 1 5.15 2.91L293.61 80H154.39zM368 464H80V128h288zm-212-48h24a12 12 0 0 0 12-12V188a12 12 0 0 0-12-12h-24a12 12 0 0 0-12 12v216a12 12 0 0 0 12 12z"></path>
                                </svg>
                            </div>
                        </div>
                    </td>
                    <td class="text-center hidden md:table-cell cart__list__item__delete">
                        <div class="btn btn-light btn-sm text-red-600">
                            <svg class="svg-inline--fa fa-trash-alt fa-w-14" aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="currentColor" d="M268 416h24a12 12 0 0 0 12-12V188a12 12 0 0 0-12-12h-24a12 12 0 0 0-12 12v216a12 12 0 0 0 12 12zM432 80h-82.41l-34-56.7A48 48 0 0 0 274.41 0H173.59a48 48 0 0 0-41.16 23.3L98.41 80H16A16 16 0 0 0 0 96v16a16 16 0 0 0 16 16h16v336a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128h16a16 16 0 0 0 16-16V96a16 16 0 0 0-16-16zM171.84 50.91A6 6 0 0 1 177 48h94a6 6 0 0 1 5.15 2.91L293.61 80H154.39zM368 464H80V128h288zm-212-48h24a12 12 0 0 0 12-12V188a12 12 0 0 0-12-12h-24a12 12 0 0 0-12 12v216a12 12 0 0 0 12 12z"></path>
                            </svg>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    name: "ProductList",
};
</script>
