<?php

namespace App\View\Components;

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
        $ids = array_reverse(array_unique(session()->get('products.recently_viewed', [])));
        if (count($ids)) {
            $recentlyViewed = Product::query()
                    ->forProductCard()
                    ->whereIn('id', $ids)
                    ->orderByRaw('FIELD(id, '.implode(', ', $ids).')')
                    ->take(4)
                    ->get();
        } else {
            $recentlyViewed = collect();
        }

        return view('layouts.app', compact('recentlyViewed'));
    }
}
