<?php

namespace App\Http\Controllers;

use App\Enums\ParamType;
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

        $productIds = Product::select('products.id')->whereIn('products.category_id', $categoryIds);
        $filters = $this->getFilterData($productIds);

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

    private function getFilterData(Builder $productIds): array
    {
        $filter = [
            [
                'title' => 'Категория',
                'name' => 'category_id',
                'param' => 'category_id',
                'options' => Category::whereHas('products', fn (Builder $query) => $query->whereIn('id', $productIds))->orderBy('title')->pluck('title', 'id'),
            ],
            [
                'title' => 'Бренд',
                'name' => 'brand_id',
                'param' => 'brand_id',
                'options' => Brand::whereHas('products', fn (Builder $query) => $query->whereIn('id', $productIds))->orderBy('title')->pluck('title', 'id'),
            ],
            [
                'title' => 'Тип',
                'name' => 'type_id',
                'param' => 'type_id',
                'options' => Type::whereHas('products', fn (Builder $query) => $query->whereIn('id', $productIds))->orderBy('title')->pluck('title', 'id'),
            ],
        ];

        $params = Param::query()
            ->whereHas('products', fn (Builder $query) => $query->whereIn('products.id', $productIds))
            ->get();

        foreach ($params as $param) {
            if ($param->type == ParamType::TYPE_SHORT_TEXT) {
                $filter[] = [
                    'title' => $param->title,
                    'name' => 'params_value['.$param->id.']',
                    'param' => 'params_value.'.$param->id,
                    'options' => ParamsProduct::query()
                        ->where('param_id', '=', $param->id)
                        ->whereHas('product', fn (Builder $query) => $query->whereIn('id', $productIds))
                        ->pluck('value', 'value')
                        ->filter()
                        ->unique()
                        ->sort(),
                ];
            } elseif ($param->type == ParamType::TYPE_DROPDOWN || $param->type == ParamType::TYPE_CHECKBOX_LIST) {
                $filter[] = [
                    'title' => $param->title,
                    'name' => 'params_option['.$param->id.']',
                    'param' => 'params_option.'.$param->id,
                    'options' => ParamsProduct::query()
                        ->where('param_id', '=', $param->id)
                        ->whereHas('product', fn (Builder $query) => $query->whereIn('id', $productIds))
                        ->with('paramsOption')
                        ->get()
                        ->pluck('paramsOption.value', 'paramsOption.id')
                        ->unique()
                        ->sort(),
                ];
            } elseif ($param->type == ParamType::TYPE_CHECKBOX) {
                $filter[] = [
                    'title' => $param->title,
                    'name' => 'params_checkbox['.$param->id.']',
                    'param' => 'params_checkbox.'.$param->id,
                    'options' => [
                        'true' => 'Да',
                        'false' => 'Нет',
                    ],
                ];
            }
        }

        return $filter;
    }
}
