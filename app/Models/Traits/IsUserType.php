<?php

namespace App\Models\Traits;

use App\Models\User;

/**
 *   Models with user_id references to users
 */
trait IsUserType
{

    public $canLogin=true;

    public function user()
    {
        return $this->morphOne(User::class,'profile');
    }


}
