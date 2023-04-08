<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\CallbackProduct
 *
 * @property int $id
 * @property int $callback_id
 * @property int $product_id
 * @property string|null $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Callback|null $callback
 * @property-read \App\Models\Product|null $product
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CallbackProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CallbackProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CallbackProduct query()
 *
 * @mixin \Eloquent
 */
class CallbackProduct extends Pivot
{
    public function callback(): BelongsTo
    {
        return $this->belongsTo(Callback::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
