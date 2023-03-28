<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ParamsOption
 *
 * @property int $id
 * @property int $param_id
 * @property string $value
 * @property int $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Param $param
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ParamsOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParamsOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParamsOption query()
 *
 * @mixin \Eloquent
 */
class ParamsOption extends Model
{
    public function param(): BelongsTo
    {
        return $this->belongsTo(Param::class);
    }
}
