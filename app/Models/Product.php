<?php

namespace App\Models;

use App\Models\Traits\HasSlug;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'flag_new' => 'boolean',
        'flag_hit' => 'boolean',
    ];

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
                        $txtsize[] = round($this->$field, 0);
                    }
                }

                return implode('×', $txtsize).' '.$sizes_unit;
            }
        )->shouldCache();
    }
}
