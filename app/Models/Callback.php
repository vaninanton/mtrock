<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Propaganistas\LaravelPhone\Casts\E164PhoneNumberCast;

/**
 * App\Models\Callback
 *
 * @property int $id
 * @property int|null $client_id
 * @property string $name
 * @property Propaganistas\LaravelPhone\PhoneNumber $phone
 * @property string|null $timezone
 * @property string|null $url
 * @property string|null $comment
 * @property int|null $telegram_message_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $answered_at
 * @property-read \App\Models\Client|null $client
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
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
        'phone' => E164PhoneNumberCast::class,
        'price' => 'float',
        'answered_at' => 'datetime',
    ];

    protected $fillable = [
        'name',
        'phone',
        'answered_at',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('price')
            ->using(CallbackProduct::class);
    }

    public function answer(): void
    {
        $this->answered_at = now();
        $this->save();
    }
}
