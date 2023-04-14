<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Propaganistas\LaravelPhone\Casts\RawPhoneNumberCast;

/**
 * App\Models\Client
 *
 * @property int $id
 * @property string|null $name
 * @property Propaganistas\LaravelPhone\PhoneNumber $phone
 * @property string|null $phone_country
 * @property string|null $email
 * @property string|null $country
 * @property string|null $city
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Callback> $callbacks
 * @property-read int|null $callbacks_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Callback> $orders
 * @property-read int|null $orders_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 *
 * @mixin \Eloquent
 */
class Client extends Model
{
    use HasFactory;

    protected $casts = [
        'phone' => RawPhoneNumberCast::class,
    ];

    public function callbacks(): HasMany
    {
        return $this->hasMany(Callback::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Callback::class);
    }
}
