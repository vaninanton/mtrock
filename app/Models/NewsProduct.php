<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\NewsProduct
 *
 * @property int $id
 * @property int $news_id
 * @property int $product_id
 *
 * @method static \Illuminate\Database\Eloquent\Builder|NewsProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsProduct query()
 *
 * @mixin \Eloquent
 */
class NewsProduct extends Pivot
{
    //
}
