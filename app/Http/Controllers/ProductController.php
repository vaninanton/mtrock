<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __invoke(?Category $category=null, Product $product): View
    {
        session()->push('products.recently_viewed', $product->getKey());

        return view('product', [
            'product' => $product,
        ]);
    }
}
