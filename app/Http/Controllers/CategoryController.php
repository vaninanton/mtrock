<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\ProductFilter\ProductFilterService;
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
    public function __invoke(Category $category, Request $request, ProductFilterService $productFilterService): Response
    {
        $categoryIds = [$category->id];
        if ($request->exists('all')) {
            $category->load('children');
            $categoryIds += $category->children->pluck('id')->toArray();
        }

        sort($categoryIds);
        $productIds = Product::select('products.id')->whereIn('products.category_id', $categoryIds);

        $productFilterService->setProductsQueryBuilder($productIds);
        $filters = $productFilterService->handle();

        $products = Product::query()
            ->forProductCard()
            ->ordered()
            ->whereIn('id', $productIds)
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
            ->when($request->filled('params_option'), function (Builder $query) use ($request) {
                foreach ($request->input('params_option') as $param_id => $params_option_id) {
                    $query->whereHas(
                        'params',
                        fn (Builder $query) => $query->where('param_id', '=', $param_id)->where('params_option_id', '=', $params_option_id)
                    );
                }
            })
            ->when($request->filled('params_value'), function (Builder $query) use ($request) {
                foreach ($request->input('params_value') as $param_id => $value) {
                    $query->whereHas(
                        'params',
                        fn (Builder $query) => $query->where('param_id', '=', $param_id)->where('value', '=', $value)
                    );
                }
            })
            ->when($request->filled('params_checkbox'), function (Builder $query) use ($request) {
                foreach ($request->input('params_checkbox') as $param_id => $value) {
                    $value = ($value === 'true') ? 1 : 0;
                    $query->whereHas(
                        'params',
                        fn (Builder $query) => $query->where('param_id', '=', $param_id)->where('value', '=', (int) $value)
                    );
                }
            })
            ->paginate()
            ->withQueryString();

        return response()->view('category', [
            'category' => $category,
            'products' => $products,
            'filters' => $filters,
        ]);
    }
}
