<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\ParamProduct
 *
 * @property int $id
 * @property int $product_id
 * @property int $param_id
 * @property string|null $value
 * @property int $param_option_id
 * @property-read \App\Models\Param $param
 * @property-read \App\Models\ParamOption $paramOption
 * @property-read \App\Models\Product $product
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ParamProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParamProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParamProduct query()
 *
 * @mixin \Eloquent
 */
class ParamProduct extends Pivot
{
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function param(): BelongsTo
    {
        return $this->belongsTo(Param::class);
    }

    public function paramOption(): BelongsTo
    {
        return $this->belongsTo(ParamOption::class);
    }
}
