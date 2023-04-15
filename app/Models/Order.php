<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Propaganistas\LaravelPhone\Casts\E164PhoneNumberCast;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int|null $client_id
 * @property string|null $slug
 * @property int|null $delivery_id
 * @property string|null $delivery_price
 * @property string|null $pay_method
 * @property string|null $total_price
 * @property string|null $coupon_discount
 * @property bool|null $separate_delivery
 * @property OrderStatus|null $status
 * @property string|null $name
 * @property string|null $country
 * @property string|null $city
 * @property string|null $street
 * @property string|null $house
 * @property string|null $apartment
 * @property Propaganistas\LaravelPhone\PhoneNumber $phone
 * @property string|null $phone_country
 * @property string|null $email
 * @property string|null $comment
 * @property string|null $note
 * @property string|null $payment_link
 * @property string|null $ip_address
 * @property \Illuminate\Support\Carbon|null $paid_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Client|null $client
 * @property-read \App\Models\Delivery|null $delivery
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrderProduct> $products
 * @property-read int|null $products_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Order withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Order extends Model
{
    use SoftDeletes;

    protected $casts = [
        'delivery_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'coupon_discount' => 'decimal:2',
        'separate_delivery' => 'boolean',
        'paid_at' => 'datetime',
        'status' => OrderStatus::class,
        'phone' => E164PhoneNumberCast::class,
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function delivery(): BelongsTo
    {
        return $this->belongsTo(Delivery::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }
}
