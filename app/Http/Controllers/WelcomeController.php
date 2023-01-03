<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WelcomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $products = Product::query()
            ->whereNull('category_id')
            ->forProductCard()
            ->ordered()
            ->paginate(100);

        return response()->view('welcome', compact('products'));
    }
}
