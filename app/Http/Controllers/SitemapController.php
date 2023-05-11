<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $products = Product::latest()->get();

        return response()->view('sitemap', [
            'products' => $products,
        ])->header('Content-Type', 'text/xml');
    }
}
