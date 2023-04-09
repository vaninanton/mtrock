<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Delivery
 *
 * @property int $id
 * @property string $title
 * @property string|null $short_name
 * @property string|null $description
 * @property string|null $price
 * @property string|null $free_from
 * @property string|null $available_from
 * @property int $flag_separate_payment
 * @property int $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Delivery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Delivery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Delivery query()
 *
 * @mixin \Eloquent
 */
class Delivery extends Model
{
    use HasFactory;
}
