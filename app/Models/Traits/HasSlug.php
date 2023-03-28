<?php

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
