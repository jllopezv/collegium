<?php

namespace App\Models\Traits;


/**
 * HasActive
 */
trait HasActive
{

    public $hasactive=true;

    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function setActive()
    {
        if ($this->active) return false;
        $this->active=1;
        return $this->save();
    }

    public function setInactive()
    {
        if (!$this->active) return false;
        $this->active=0;
        return $this->save();
    }

    public function lock()
    {
        return $this->setInactive();
    }

    public function unlock()
    {
        return $this->setActive();
    }
}
