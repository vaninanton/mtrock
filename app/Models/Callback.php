<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Propaganistas\LaravelPhone\Casts\E164PhoneNumberCast;

/**
 * App\Models\Callback
 *
 * @property int $id
 * @property string $name
 * @property Propaganistas\LaravelPhone\PhoneNumber $phone
 * @property string|null $timezone
 * @property string|null $url
 * @property string|null $comment
 * @property int|null $telegram_message_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $answered_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $viewedProducts
 * @property-read int|null $viewed_products_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Callback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Callback newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Callback query()
 *
 * @mixin \Eloquent
 */
class Callback extends Model
{
    protected $casts = [
        'phone' => E164PhoneNumberCast::class . ':RU',
        'price' => 'float',
    ];

    protected $fillable = [
        'name',
        'phone',
        'answered_at',
    ];

    public function viewedProducts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withTimestamps()
            ->withPivot('price')
            ->using(CallbackProduct::class);
    }
}
