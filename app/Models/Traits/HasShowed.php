<?php

namespace App\Models\Traits;


/**
 * HasActive
 */
trait HasShowed
{
    public $hasshowed=true;

    public function addShowed()
    {
        $this->showed++;
        return $this->save();
    }

    public function subShowed()
    {
        $this->showed--;
        return $this->save();
    }

}
