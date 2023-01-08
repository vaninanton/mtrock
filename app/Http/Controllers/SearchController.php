<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  SearchRequest  $request
     * @return View
     */
    public function __invoke(SearchRequest $request): View
    {
        $products = Product::query()
            ->where('model', 'like', '%'.$request->get('query').'%')
            ->paginate();

        return view('search', compact('products'));
    }
}
