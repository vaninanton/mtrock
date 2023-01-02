<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\ProductProduct
 *
 * @property int $id
 * @property string $type
 * @property int $product_id
 * @property int $linked_product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProduct query()
 *
 * @mixin \Eloquent
 */
class ProductProduct extends Pivot
{
    //
}
