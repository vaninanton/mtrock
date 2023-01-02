@props(['product'])
<div class="bg-white border rounded shadow-lg mb-2 flex flex-col justify-between">
    <div>
        <a href="{{ $product->route }}">
            <img src="https://mountain-rock.ru/uploads/thumbs/store/product/250x250_{{ $product->image }}" alt="{{ $product->brand?->title }} {{ $product->model }}" class="m-auto object-contain h-32" loading="lazy">
            <div class="px-4">{{ $product->type_prefix }} {{ $product->brand?->title }} <span class="font-bold">{{ $product->model }}</span></div>
        </a>
        <div class="text-xs px-4">{{ strip_tags($product->short_description) }}</div>
    </div>
    <div class="p-4 flex justify-between items-center bg-gray-100">
        <div class="text-xs">
            @if($product->quantity > 0 && $product->old_price && $product->old_price > $product->price)
            <del class="block line-through leading-none mb-1">@money($product->old_price)</del>
            @endif
            <div class="text-base font-bold text-blue-900 leading-none">@money($product->price)</div>
        </div>
        @if ($product->quantity > 0)
        <form action="{{ route('cart.put') }}" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="1">
            <button type="submit" class="addtocart">
                <i class="fas fa-shopping-cart" aria-hidden="true"></i>
                Купить
            </button>
        </form>
        @else
        <button class="addtocart-not-in-stock">Нет в наличии</button>
        @endif
    </div>
</div>
