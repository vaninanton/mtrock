<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        $products = Product::query()
            // ->whereNotNull('category_id')
            ->where('flag_hit', '=', 1)
            ->inStock()
            ->forProductCard()
            // ->ordered()
            ->paginate(100);

        return view('welcome', compact('products'));
    }
}
