@props(['product', 'hideparams'])
<div {{ $attributes->merge(['class' => 'bg-white border rounded shadow-lg mb-2 flex flex-col justify-between']) }}>
    <div>
        <a href="{{ $product->route }}">
            <img src="{{ Storage::disk('uploads')->url('store/product/'.$product->image) }}" alt="{{ $product->brand?->title }} {{ $product->model }}" class="m-auto object-contain h-32 transition-transform lg:mix-blend-multiply lg:hover:scale-110 lg:origin-bottom" loading="lazy" {!! $product->imageSize !!}
            >
            <div class="px-4">{{ $product->type_prefix }} {{ $product->brand?->title }} <span class="font-bold">{{ $product->model }}</span></div>
        </a>
        <div class="text-xs px-4 mb-2">{{ strip_tags($product->short_description) }}</div>
        {{--
        @if ($product->relationLoaded('type') && $product->type?->title)
        <div class="text-xs px-4">Тип: {{ strip_tags($product->type?->title) }}</div>
        @endif
        --}}
        @if (!isset($hideparams))
        @if ($product->weight)
        <div class="text-xs px-4">Вес: {{ $product->humanWeight }}</div>
        @endif
        @if ($product->length || $product->width || $product->height)
        <div class="text-xs px-4">Размер: {{ $product->humanSize }}</div>
        @endif
        @if ($product->relationLoaded('params'))
        <x-product-params :$product class="hidden sm:block text-xs px-4" />
        @endif
        @endif
    </div>
    <div class="p-4 flex justify-between items-center bg-gray-100">
        <div class="text-xs">
            @if($product->quantity > 0 && $product->old_price && $product->old_price > $product->price)
            <del class="block line-through leading-none mb-1">@money($product->old_price)</del>
            @endif
            <div class="text-base font-bold text-blue-900 leading-none">@money($product->price)</div>
        </div>
        @if ($product->price > 0 && $product->in_stock && $product->quantity > 0)
        <form action="{{ route('cart.add', $product) }}" method="post">
            @csrf
            @method('put')
            <button type="submit" class="addtocart">
                <i class="fas fa-shopping-cart" aria-hidden="true"></i>
                Купить
            </button>
        </form>
        @else
        @if ($product->availability_preorder)
        <button type="button" class="addtocart">
            <i class="fas fa-shopping-cart" aria-hidden="true"></i>
            Предзаказ
        </button>
        @else
        <button type="button" class="addtocart-not-in-stock">Нет в наличии</button>
        @endif
        @endif
    </div>
</div>