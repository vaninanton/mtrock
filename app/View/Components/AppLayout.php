<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $categories = Category::query()
            ->whereNull('parent_id')
            ->get();

        $ids = array_reverse(array_unique(session()->get('products.recently_viewed', [])));
        $recentlyViewed = Product::query()
                ->forProductCard()
                ->whereIn('id', $ids)
                ->orderByRaw('FIELD(id, '.implode(', ', $ids).')')
                ->take(4)
                ->get();

        return view('layouts.app', compact('categories', 'recentlyViewed'));
    }
}
