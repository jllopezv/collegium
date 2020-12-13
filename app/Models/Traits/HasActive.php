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
        $this->customLocking();
        $ret=$this->setInactive();
        $this->customLocked();
        return $ret;
    }

    public function unlock()
    {
        $this->customUnlocking();
        $ret=$this->setActive();
        $this->customUnLocked();
        return $ret;
    }

    public function customLocking()
    {

    }

    public function customUnLocking()
    {

    }

    public function customLocked()
    {

    }

    public function customUnLocked()
    {

    }
}
