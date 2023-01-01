<?php

namespace App\Models;

use App\Models\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Brand
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property string|null $image
 * @property string|null $short_description
 * @property string|null $description
 * @property int|null $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 *
 * @method static \Database\Factories\BrandFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand query()
 *
 * @mixin \Eloquent
 */
class Brand extends Model
{
    use HasFactory, HasSlug;

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
