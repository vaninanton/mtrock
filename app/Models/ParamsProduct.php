<?php

namespace App\Models;

use App\Enums\ParamType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\ParamsProduct
 *
 * @property int $id
 * @property int $product_id
 * @property int $param_id
 * @property string|null $value
 * @property int|null $params_option_id
 * @property-read \App\Models\Param $param
 * @property-read \App\Models\ParamsOption|null $paramsOption
 * @property-read \App\Models\Product $product
 * @property-read string $value_parsed
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ParamsProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParamsProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParamsProduct query()
 *
 * @mixin \Eloquent
 */
class ParamsProduct extends Pivot
{
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

    /**
     * @return Attribute
     */
    public function valueParsed(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                $result = match ($this->param->type) {
                    ParamType::TYPE_TEXT => (string) $this->value,
                    ParamType::TYPE_SHORT_TEXT => (string) $this->value,
                    ParamType::TYPE_DROPDOWN => (string) $this->paramsOption->value,
                    ParamType::TYPE_CHECKBOX => ($this->value == 1) ? 'Да' : 'Нет',
                    ParamType::TYPE_CHECKBOX_LIST => (string) $this->paramsOption->value,
                    ParamType::TYPE_NUMBER => $this->value,
                };

                if ($this->param->unit) {
                    return $result.' '.$this->param->unit;
                }

                return $result;
            }
        )->shouldCache();
    }
}
