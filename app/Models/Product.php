<?php

namespace App\Models;

use App\Models\Traits\HasSlug;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $sku
 * @property int|null $category_id
 * @property int|null $brand_id
 * @property int|null $type_id
 * @property int $quantity
 * @property int $in_stock
 * @property float $price
 * @property float|null $old_price
 * @property string|null $type_prefix
 * @property string|null $model
 * @property string|null $image
 * @property string|null $short_description
 * @property string|null $description
 * @property bool $flag_new
 * @property bool $flag_hit
 * @property float|null $length
 * @property float|null $width
 * @property float|null $height
 * @property float|null $weight
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Brand|null $brand
 * @property-read \App\Models\Category|null $category
 * @property-read string $human_size
 * @property-read string $human_weight
 * @property-read \App\Models\Type|null $type
 *
 * @method static \Database\Factories\ProductFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Query\Builder|Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product ordered()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Query\Builder|Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Product withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'double',
        'old_price' => 'double',
        'length' => 'double',
        'width' => 'double',
        'height' => 'double',
        'weight' => 'double',
        'flag_new' => 'boolean',
        'flag_hit' => 'boolean',
    ];

    protected $perPage = 50;

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function scopeOrdered($query)
    {
        return $query
            // ->orderBy('availability_preorder', 'asc')
            ->orderBy('in_stock', 'desc');
        // ->orderBy('position', 'asc');
    }

    /**
     * @return Attribute
     */
    public function humanWeight(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                $weight_unit = 'кг';
                $weight = round($this->weight, 2);
                if ($weight < 1) {
                    $weight_unit = 'гр';
                    $weight = $weight * 1000;
                }

                return $weight.' '.$weight_unit;
            }
        )->shouldCache();
    }

    /**
     * @return Attribute
     */
    public function humanSize(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                $fields = ['length', 'width', 'height'];
                $sizes_unit = 'м';
                if ($this->length < 10 && $this->width < 10 && $this->height < 10) {
                    $sizes_unit = 'см';
                    $this->length = $this->length * 100;
                    $this->width = $this->width * 100;
                    $this->height = $this->height * 100;
                }

                $txtsize = [];
                foreach ($fields as $field) {
                    if ($this->$field > 0) {
                        $txtsize[] = round($this->$field, 0, PHP_ROUND_HALF_UP);
                    }
                }

                return implode('×', $txtsize).' '.$sizes_unit;
            }
        )->shouldCache();
    }
}
