<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __invoke(Category $category, Product $product): View
    {
        return view('product', [
            'category' => $category,
            'product' => $product,
        ]);
    }
}
