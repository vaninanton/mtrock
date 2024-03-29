<?php

declare(strict_types=1);

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
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

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
 * @property bool $in_stock
 * @property bool $availability_preorder
 * @property bool $status
 * @property string $price
 * @property string|null $old_price
 * @property string|null $type_prefix
 * @property string|null $model
 * @property string|null $image
 * @property string|null $short_description
 * @property string|null $description
 * @property string|null $sales_notes
 * @property string|null $video1
 * @property string|null $video2
 * @property string|null $video3
 * @property bool $flag_special
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
 * @property-read string $image_size
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductImage> $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Product> $linked
 * @property-read int|null $linked_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ParamsProduct> $params
 * @property-read int|null $params_count
 * @property-read array $params_parsed
 * @property-read string $route
 * @property-read \App\Models\Type|null $type
 *
 * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
 * @method static Builder|Product forProductCard()
 * @method static Builder|Product inStock()
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product onlyTrashed()
 * @method static Builder|Product ordered()
 * @method static Builder|Product query()
 * @method static Builder|Product withTrashed()
 * @method static Builder|Product withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Product extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, HasSlug, InteractsWithMedia;

    protected $fillable = ['*'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity' => 'int',
        'in_stock' => 'boolean',
        'availability_preorder' => 'boolean',
        'status' => 'boolean',
        'price' => 'decimal:2',
        'old_price' => 'decimal:2',
        'flag_special' => 'boolean',
        'flag_new' => 'boolean',
        'flag_hit' => 'boolean',
        'length' => 'double',
        'width' => 'double',
        'height' => 'double',
        'weight' => 'double',
        'position' => 'int',
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

    public function params(): HasMany
    {
        return $this->hasMany(ParamsProduct::class);
    }

    public function linked(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, null, 'product_id', 'linked_product_id')->using(ProductProduct::class);
    }

    public function scopeForProductCard(Builder $query): Builder
    {
        return $query->with([
            'brand',
            'category',
            'type',
            'params' => [
                'param',
                'paramsOption',
            ],
        ]);
    }

    public function scopeInStock($query)
    {
        return $query
            ->where('in_stock', '=', 1)
            ->where('price', '>', 0);
    }

    public function scopeOrdered($query)
    {
        return $query
            ->orderBy('availability_preorder', 'asc')
            ->orderBy('in_stock', 'desc')
            ->orderBy('price', 'desc')
            ->orderBy('position', 'asc');
    }

    // public function title(): Attribute
    // {
    //     return Attribute::make(
    //         get: function (): string {
    //             if (empty($this->type_prefix) || empty($this->brand) || empty($this->model)) {
    //                 return $this->attributes['title'];
    //             }

    //             return $this->type_prefix . ' ' . $this->brand->title . ' ' . $this->model;
    //         }
    //     )->shouldCache();
    // }

    public function imageSize(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes): string {
                try {
                    [$width, $height, $type, $attr] = getimagesize(Storage::disk('uploads')->path('store/product/'.$attributes['image']));

                    return $attr;
                } catch (\Throwable $th) {
                    return '';
                }
            }
        )->shouldCache();
    }

    public function route(): Attribute
    {
        return Attribute::make(
            get: fn (): string => route('product', $this)
        )->shouldCache();
    }

    public function paramsParsed(): Attribute
    {
        return Attribute::make(
            get: function (): array {
                $values = [];

                $paramGrouped = $this->params->groupBy('param.title');
                foreach ($paramGrouped as $key => $params) {
                    $val = $params->pluck('valueParsed')->join(', ');
                    $replace = [
                        'Область применения' => 'Подходит для',
                        'Зима, Весна, Лето, Осень' => 'Всесезонная',
                        'Тип рюкзака' => 'Тип',
                        'Для сноуборда, Для горных лыж' => 'Горнолыжный',
                        'Для ноутбука' => 'с отделением для ноутбука',
                        'Назначение самоката' => 'Назначение',
                        'Городской самокат' => 'городской',
                        'Самокат для взрослых' => 'для взрослых',
                        'Самокат для трюков' => 'для трюков',
                        'Детский самокат' => 'детский',
                        'Тип крепления кошки' => 'Тип крепления',
                        'Вид сумки' => 'Вид',
                        'Тип деки' => 'Дека',
                        'Назначение горных лыж' => 'Тип',
                        'мм водяного столба' => 'мм',
                    ];
                    $key = str_replace(array_keys($replace), array_values($replace), $key);
                    $val = str_replace(array_keys($replace), array_values($replace), $val);
                    $values[$key] = $val;
                }

                return $values;
            }
        )->shouldCache();
    }

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
