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
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Category $category): Response
    {
        $category->load([
            'childrenRecursive' => [
                'products' => fn ($query) => $query->with(['brand', 'category'])->ordered()->paginate(4)
            ],
            'products' => fn ($query) => $query->with(['brand', 'category'])->ordered()->get()
        ]);

        return response()->view('category', [
            'category' => $category,
        ]);
    }
}
