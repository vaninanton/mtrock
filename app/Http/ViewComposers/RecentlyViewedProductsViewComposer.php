<?php

namespace App\Http\ViewComposers;

use App\Models\Product;
use Illuminate\Contracts\View\View;

class RecentlyViewedProductsViewComposer
{
    public function compose(View $view)
    {
        $products = session()->get('products.recently_viewed');

        $view->with([
            'recentlyViewed' => Product::query()
                ->with([
                    'brand',
                    'category',
                ])
                ->whereIn('id', array_unique($products))
                ->take(4)
                ->get(),
        ]);
    }
}
