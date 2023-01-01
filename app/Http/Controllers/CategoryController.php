<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Category $category): Response
    {
        $category->load([
            'childrenRecursive' => [
                'products' => function (HasMany $query) {
                    return $query->with([
                        'brand',
                        'category',
                    ])->paginate(4);
                },
            ],
            'products' => [
                'brand',
                'category',
            ],
        ]);

        return response()->view('category', [
            'category' => $category,
        ]);
    }
}
