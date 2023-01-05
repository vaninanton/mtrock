<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Param;
use App\Models\ParamsProduct;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Category $category, Request $request): Response
    {
        $categoryIds = [$category->id];
        if ($request->exists('all')) {
            $category->load('children');
            $categoryIds += $category->children->pluck('id')->toArray();
        }

        $products = Product::query()
            ->forProductCard()
            ->ordered()
            ->whereIn('category_id', $categoryIds)
            ->when(
                $request->filled('category_id'),
                fn (Builder $query) => $query->where('category_id', '=', $request->input('category_id'))
            )
            ->when(
                $request->filled('brand_id'),
                fn (Builder $query) => $query->where('brand_id', '=', $request->input('brand_id'))
            )
            ->when(
                $request->filled('type_id'),
                fn (Builder $query) => $query->where('type_id', '=', $request->input('type_id'))
            )
            // ->when(
            //     $request->filled('params_7'),
            //     fn (Builder $query) => $query->where('params_7', '=', $request->input('params_7'))
            // )
            ->paginate()
            ->withQueryString();

        $productIds = Product::select('products.id')->whereIn('products.category_id', $categoryIds);
        $filters = $this->getFilterData($productIds);

        return response()->view('category', [
            'category' => $category,
            'products' => $products,
            'filters' => $filters,
        ]);
    }

    private function getFilterData(Builder $productIds): array
    {
        $filter = [
            [
                'title' => 'Категория',
                'param' => 'category_id',
                'options' => Category::whereHas('products', fn (Builder $query) => $query->whereIn('id', $productIds))->pluck('title', 'id'),
            ],
            [
                'title' => 'Бренд',
                'param' => 'brand_id',
                'options' => Brand::whereHas('products', fn (Builder $query) => $query->whereIn('id', $productIds))->pluck('title', 'id'),
            ],
            [
                'title' => 'Тип',
                'param' => 'type_id',
                'options' => Type::whereHas('products', fn (Builder $query) => $query->whereIn('id', $productIds))->pluck('title', 'id'),
            ],
        ];

        $params = Param::query()
            ->whereHas('products', fn (Builder $query) => $query->whereIn('products.id', $productIds))
            ->get();

        foreach ($params as $param) {
            $options = [];
            if ($param->type == 1) {
                $options = ParamsProduct::query()
                    ->where('param_id', '=', $param->id)
                    ->whereHas('product', fn (Builder $query) => $query->whereIn('id', $productIds))
                    ->pluck('value', 'id')
                    ->filter()
                    ->unique();
            } elseif ($param->type == 2 || $param->type == 4) {
                $options = ParamsProduct::query()
                    ->where('param_id', '=', $param->id)
                    ->whereHas('product', fn (Builder $query) => $query->whereIn('id', $productIds))
                    ->with('paramsOption')
                    ->get()
                    ->pluck('paramsOption.value', 'id')
                    ->unique();
            } elseif ($param->type == 3) {
                $options['true'] = 'Да';
                $options['false'] = 'Нет';
            }
            $filter[] = [
                'title' => $param->title,
                'param' => 'param_'.$param->slug,
                'options' => $options,
            ];
        }

        return $filter;
    }
}
