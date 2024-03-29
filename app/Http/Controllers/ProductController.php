<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __invoke(Product $product): View
    {
        session()->push('products.recently_viewed', $product->getKey());

        $product->load([
            'category',
            'brand',
            'type',
            'images',
            'params' => [
                'param',
                'paramsOption',
            ],
            'linked' => fn ($query) => $query->forProductCard(),
        ]);

        return view('product', [
            'product' => $product,
        ]);
    }
}
