<?php

namespace App\Services\ProductFilter;

use App\Enums\ParamType;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Param;
use App\Models\ParamsProduct;
use App\Models\Type;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class ProductFilterService
{
    private Builder $productsQueryBuilder;

    public function handle(): array
    {
        $key = 'productFilter::'.md5(json_encode($this->productsQueryBuilder->getBindings()));
        return Cache::remember($key, 10, fn () => $this->getFilterData());
    }

    public function setProductsQueryBuilder(Builder $builder): void
    {
        $this->productsQueryBuilder = $builder;
    }

    private function getCategoryFilter(): ProductFilterItem
    {
        return (new ProductFilterItem())
            ->setTitle('Категория')
            ->setName('category_id')
            ->setParam('category_id')
            ->setOptions(Category::whereHas('products', fn (Builder $query) => $query->whereIn('id', $this->productsQueryBuilder))->orderBy('title')->pluck('title', 'id'));
    }

    private function getBrandFilter(): ProductFilterItem
    {
        return (new ProductFilterItem())
            ->setTitle('Бренд')
            ->setName('brand_id')
            ->setParam('brand_id')
            ->setOptions(Brand::whereHas('products', fn (Builder $query) => $query->whereIn('id', $this->productsQueryBuilder))->orderBy('title')->pluck('title', 'id'));
    }

    private function getTypeFilter(): ProductFilterItem
    {
        return (new ProductFilterItem())
            ->setTitle('Тип')
            ->setName('type_id')
            ->setParam('type_id')
            ->setOptions(Type::whereHas('products', fn (Builder $query) => $query->whereIn('id', $this->productsQueryBuilder))->orderBy('title')->pluck('title', 'id'));
    }

    private function getFilterData(): array
    {
        $filter = [
            $this->getCategoryFilter(),
            $this->getBrandFilter(),
            $this->getTypeFilter(),
        ];

        $params = Param::query()
            ->whereHas('products', fn (Builder $query) => $query->whereIn('products.id', $this->productsQueryBuilder))
            ->get();

        foreach ($params as $param) {
            $filter[] = match ($param->type) {
                ParamType::TYPE_TEXT, ParamType::TYPE_SHORT_TEXT, ParamType::TYPE_NUMBER => (new ProductFilterItem())
                    ->setTitle($param->title)
                    ->setName('params_value['.$param->id.']')
                    ->setParam('params_value.'.$param->id)
                    ->setOptions(ParamsProduct::query()
                        ->where('param_id', '=', $param->id)
                        ->whereHas('product', fn (Builder $query) => $query->whereIn('id', $this->productsQueryBuilder))
                        ->pluck('value', 'value')
                        ->filter()
                        ->unique()
                        ->sort()),
                ParamType::TYPE_DROPDOWN, ParamType::TYPE_CHECKBOX_LIST => (new ProductFilterItem())
                    ->setTitle($param->title)
                    ->setName('params_option['.$param->id.']')
                    ->setParam('params_option.'.$param->id)
                    ->setOptions(ParamsProduct::query()
                        ->where('param_id', '=', $param->id)
                        ->whereHas('product', fn (Builder $query) => $query->whereIn('id', $this->productsQueryBuilder))
                        ->with('paramsOption')
                        ->get()
                        ->pluck('paramsOption.value', 'paramsOption.id')
                        ->unique()
                        ->sort()),
                ParamType::TYPE_CHECKBOX => (new ProductFilterItem())
                    ->setTitle($param->title)
                    ->setName('params_checkbox['.$param->id.']')
                    ->setParam('params_checkbox.'.$param->id)
                    ->setOptions(collect([
                        'true' => 'Да',
                        'false' => 'Нет',
                    ])),
            };
        }

        return $filter;
    }
}
