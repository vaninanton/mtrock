<?php

declare(strict_types=1);

namespace App\Models\Traits;

trait HasSlug
{
    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
