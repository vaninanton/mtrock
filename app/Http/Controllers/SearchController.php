<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(SearchRequest $request): View
    {
        $products = Product::query()
            ->forProductCard()
            ->where('type_prefix', 'like', '%'.$request->get('query').'%')
            ->orWhere('model', 'like', '%'.$request->get('query').'%')
            ->paginate();

        return view('search', compact('products'));
    }
}
