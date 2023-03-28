<?php

declare(strict_types=1);

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
     */
    public function render(): View
    {
        /** @var Collection<Category> */
        $categories = Cache::remember('categorymenu', now()->addMinutes(10), fn () => $this->loadCategories());

        /** @var \Illuminate\Contracts\View\View */
        return view('components.category-menu', [
            'categories' => $categories,
        ]);
    }

    /**
     * Получает дерево категорий для меню
     *
     * @return Collection<Category>
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
