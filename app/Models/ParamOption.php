<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ParamOption
 *
 * @property int $id
 * @property int $param_id
 * @property string $value
 * @property int $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Param $param
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ParamOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParamOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParamOption query()
 *
 * @mixin \Eloquent
 */
class ParamOption extends Model
{
    public function param(): BelongsTo
    {
        return $this->belongsTo(Param::class);
    }
}
