<?php

namespace App\Models\Traits;

use App\Models\Auth\AllowAction;
use Illuminate\Support\Facades\Auth;

trait HasAllowedActions
{
    /**
     *  Global Show Action
     */
    public function allowShow()
    {
        if (Auth::user()->isSuperadmin()) return(true);
        return($this->allowedActions->allowShow ?? true);
    }

    /**
     *  Global Edit Action
     */
    public function allowEdit()
    {
        if (Auth::user()->isSuperadmin()) return(true);
        return($this->allowedActions->allowEdit ?? true);
    }

    /**
     *  Global Delete Action
     */
    public function allowDelete()
    {
        if (Auth::user()->isSuperadmin()) return(true);
        return($this->allowedActions->allowDelete ?? true);
    }

    /**
     *  Global Lock Action
     */
    public function allowLock()
    {
        if (Auth::user()->isSuperadmin()) return(true);
        return($this->allowedActions->allowLock ?? true);
    }

    /**
     * Get all of the model's allow actions.
     */
    public function allowedActions()
    {
        return $this->morphOne(AllowAction::class, 'allowable');
    }
}
