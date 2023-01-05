<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Param
 *
 * @property int $id
 * @property string $type
 * @property string $title
 * @property string $slug
 * @property string|null $unit
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Param newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Param newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Param query()
 *
 * @mixin \Eloquent
 */
class Param extends Model
{
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'params_product', 'param_id', 'product_id', 'params.id', 'products.id');
    }
}
