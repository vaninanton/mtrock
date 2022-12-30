<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Category $category)
    {
        $category->load('childrenRecursive.products');
        $category->load('products');

        return view('category', [
            'category' => $category,
        ]);
    }
}
