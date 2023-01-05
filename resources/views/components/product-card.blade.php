@props(['product'])
<div {{ $attributes->merge(['class' => 'bg-white border rounded shadow-lg mb-2 flex flex-col justify-between']) }}>
    <div>
        <a href="{{ $product->route }}">
            <img src="{{ config('app.uploads_url') }}/thumbs/store/product/250x250_{{ $product->image }}" alt="{{ $product->brand?->title }} {{ $product->model }}" class="m-auto object-contain h-32" loading="lazy">
            <div class="px-4">{{ $product->type_prefix }} {{ $product->brand?->title }} <span class="font-bold">{{ $product->model }}</span></div>
        </a>
        <div class="text-xs px-4 mb-2">{{ strip_tags($product->short_description) }}</div>
        @if ($product->relationLoaded('type'))
        <div class="text-xs px-4">Тип: {{ strip_tags($product->type?->title) }}</div>
        @endif
        <x-product-params :$product class="text-xs px-4" />
    </div>
    <div class="p-2 md:p-4 flex justify-between items-center bg-gray-100">
        <div class="text-xs">
            @if($product->quantity > 0 && $product->old_price && $product->old_price > $product->price)
            <del class="block line-through leading-none mb-1">@money($product->old_price)</del>
            @endif
            <div class="text-base font-bold text-blue-900 leading-none">@money($product->price)</div>
        </div>
        @if ($product->price > 0 && $product->in_stock && $product->quantity > 0)
        @if ($product->availability_preorder = 1)
            <button type="button" class="addtocart">
                <i class="fas fa-shopping-cart" aria-hidden="true"></i>
                Предзаказ
            </button>
        @else
        <form action="{{ route('cart.add', $product) }}" method="post">
            @csrf
            @method('put')
            <button type="submit" class="addtocart">
                <i class="fas fa-shopping-cart" aria-hidden="true"></i>
                Купить
            </button>
        </form>
        @endif
        @else
        <button class="addtocart-not-in-stock text-sm">Нет в наличии</button>
        @endif
    </div>
</div>
