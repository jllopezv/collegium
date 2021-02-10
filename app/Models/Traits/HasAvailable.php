<?php

namespace App\Models\Traits;

/**
 * HasAvailable
 */
trait HasAvailable
{
    protected $hasAvailable=true;

    /**
     * Scope a query to only include available rows from relationship
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query)
    {
        return $query->where('available', 1);
    }
}
