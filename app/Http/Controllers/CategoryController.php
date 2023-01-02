<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Category $category): Response
    {
        $products = Product::query()
            ->whereIn('category_id', [$category->id])
            ->ordered()
            ->with(['brand', 'category', 'type'])
            ->paginate();

        return response()->view('category', [
            'category' => $category,
            'products' => $products,
        ]);
    }
}
