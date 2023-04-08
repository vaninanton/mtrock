<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 *
 * @method static \Database\Factories\BrandFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand query()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Brand extends Model
{
    use HasFactory, HasSlug, SoftDeletes;

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
