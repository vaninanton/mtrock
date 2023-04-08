<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Cart
 *
 * @property string $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Cart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart query()
 *
 * @mixin \Eloquent
 */
class Cart extends Model
{
    use HasFactory;
    use HasUuids;
    use Prunable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->using(CartProduct::class)
            ->withPivot(['quantity'])
            ->withTimestamps();
    }

    public function prunable(): Builder
    {
        return static::where('updated_at', '<=', now()->subDays(7));
    }

    protected function pruning(): bool
    {
        return $this->products()->delete();
    }
}
