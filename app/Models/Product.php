<?php

namespace App\Models;

use App\Models\Traits\HasSlug;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
 * @property int $availability_preorder
 * @property int $status
 * @property float $price
 * @property float|null $old_price
 * @property string|null $type_prefix
 * @property string|null $model
 * @property string|null $image
 * @property string|null $short_description
 * @property string|null $description
 * @property string|null $sales_notes
 * @property string|null $video1
 * @property string|null $video2
 * @property string|null $video3
 * @property int $flag_special
 * @property bool $flag_new
 * @property bool $flag_hit
 * @property float|null $length
 * @property float|null $width
 * @property float|null $height
 * @property float|null $weight
 * @property int $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Brand|null $brand
 * @property-read \App\Models\Category|null $category
 * @property-read string $human_size
 * @property-read string $human_weight
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Product[] $linked
 * @property-read int|null $linked_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Param[] $params
 * @property-read int|null $params_count
 * @property-read array $params_parsed
 * @property-read string $route
 * @property-read \App\Models\Type|null $type
 *
 * @method static \Database\Factories\ProductFactory factory(...$parameters)
 * @method static Builder|Product forProductCard()
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static \Illuminate\Database\Query\Builder|Product onlyTrashed()
 * @method static Builder|Product ordered()
 * @method static Builder|Product query()
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

    protected $perPage = 51;

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

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function params(): BelongsToMany
    {
        return $this->belongsToMany(Param::class)->withPivot('value', 'param_option_id')->using(ParamProduct::class);
    }

    public function linked(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, null, 'product_id', 'linked_product_id')->using(ProductProduct::class);
    }

    public function scopeForProductCard(Builder $query): Builder
    {
        return $query->with(['brand', 'category', 'type', 'params']);
    }

    public function scopeOrdered($query)
    {
        return $query
            ->orderBy('availability_preorder', 'asc')
            ->orderBy('in_stock', 'desc')
            ->orderBy('position', 'asc');
    }

    /**
     * @return Attribute
     */
    public function title(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                if (empty($this->type_prefix) || empty($this->brand) || empty($this->model)) {
                    return $this->attributes['title'];
                }

                return $this->type_prefix.' '.$this->brand->title.' '.$this->model;
            }
        )->shouldCache();
    }

    /**
     * @return Attribute
     */
    public function route(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                return route('product', $this);
            }
        )->shouldCache();
    }

    /**
     * @return Attribute
     */
    public function paramsParsed(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes): array {
                $values = [];
                $attributeGroups = $this->params->groupBy('title');
                foreach ($attributeGroups as $attributeGroup) {
                    $key = $attributeGroup->first()->title;
                    $value = [];
                    foreach ($attributeGroup as $attribute) {
                        // @phpstan-ignore-next-line
                        $value[] = $attribute->pivot->paramOption?->value ?? $attribute->pivot->value;
                    }
                    $values[$key] = implode(', ', $value);
                    if ($values[$key] === 'Зима, Весна, Лето, Осень') {
                        $values[$key] = 'Всесезонная';
                    } elseif ($values[$key] === 'Весна, Лето, Осень') {
                        $values[$key] = 'Весна-осень';
                    }
                }

                return $values;
            }
        )->shouldCache();
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
