<?php

namespace App\Models\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait HasCommon
{

    public function getCreatedAgedAttribute($value)
    {
        return $this->created_at->diffForHumans()??'';
    }

    public function postDelete()
    {

    }

    public function postLock()
    {

    }

    public function postUnlock()
    {

    }

}
