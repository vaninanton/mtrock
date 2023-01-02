<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\View\Component;

class CategoryMenu extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $categories = Category::query()
            ->whereNull('parent_id')
            ->withCount('products')
            ->with([
                'children' => function (HasMany $query) {
                    return $query->withCount('products');
                },
            ])
            ->get();

        return view('components.category-menu', [
            'categories' => $categories,
        ]);
    }
}
