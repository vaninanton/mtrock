<x-app-layout>
    <div class="content p-8">
        <img src="/img/logo.svg" alt="" class="block mx-auto mt-4 max-w-xs">
        <h1 class="h1 text-center">Интернет-магазин туристического и спортивного снаряжения</h1>
        <p>Палатку купить в интернет магазине непросто, туристические магазины предлагают большой выбор всевозможных типов и конструкция - кемпинговые, треккинговые и экстремальные палатки.</p>
        <p>Из огромного перечня брендов трудно выбрать какой лучше - <a href="/store/brand/alexika">Alexika</a> или <a href="/store/brand/tramp">Tramp</a>, <a href="/store/palatki/palatki-red-fox">палатки Red Fox</a> или <a href="/store/palatki/palatki-normal">Normal</a> зарекомендовавшие себя у любителей экстремальных походов, может <a href="/store/palatki/palatki-indiana">Indiana</a> или <a href="/store/palatki/palatki-canadian-camper">Canadian Camper</a> хорошо известных у любителей кемпингов? Без хорошей консультации специалиста разобраться непросто!</p>
        <p>В нашем интернет магазине мы постарались собрать максимальное количество информации по туристическому снаряжению, у многих товаров есть видео обзоры, а так же Вас ждет профессиональная консультация по телефону или электронной почте, на всю продукцию в нашем магазине есть гарантия, предусмотренная производителем, пункт выдачи заказов находится недалеко от станции метро Пражская, большая бесплатная стоянка.</p>
    </div>
    <div class="grid grid-cols-4 gap-8 px-4">
        @foreach($products as $product)
        <x-product-card :product="$product" />
        @endforeach
        {{ $products->links() }}
    </div>
</x-app-layout>
