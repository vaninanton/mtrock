<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class CategoryMenu extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): View
    {
        /** @var Collection<Category>|Category[] */
        $categories = Cache::remember('categorymenu', now()->addMinutes(10), fn () => $this->loadCategories());

        return view('components.category-menu', [
            'categories' => $categories,
        ]);
    }

    /**
     * Получает дерево категорий для меню
     *
     * @return Collection<Category>|Category[]
     */
    private function loadCategories(): Collection
    {
        return Category::query()
            ->select(['id', 'parent_id', 'slug', 'title'])
            ->whereNull('parent_id')
            ->withCount('products')
            ->with([
                'children' => function (HasMany $query) {
                    return $query->select(['id', 'parent_id', 'slug', 'title'])->withCount('products');
                },
            ])
            ->get();
    }
}
