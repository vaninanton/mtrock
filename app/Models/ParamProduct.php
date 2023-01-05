<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ParamsProduct
 *
 * @property int $id
 * @property int $product_id
 * @property int $param_id
 * @property string|null $value
 * @property int $params_option_id
 * @property-read \App\Models\Param $param
 * @property-read \App\Models\ParamsOption $paramsOption
 * @property-read \App\Models\Product $product
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ParamsProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParamsProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParamsProduct query()
 *
 * @mixin \Eloquent
 */
class ParamsProduct extends Model
{
    protected $table = 'params_product';

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function param(): BelongsTo
    {
        return $this->belongsTo(Param::class);
    }

    public function paramsOption(): BelongsTo
    {
        return $this->belongsTo(ParamsOption::class);
    }
}
