<?php

namespace App\Models\Traits;

use App\Models\Auth\AllowAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

trait HasAllowedActions
{

    /**
     *  Global Show Action
     */
    public function allowShow()
    {
        if (Auth::user()->isSuperadmin()) return(true);
        return($this->allowedActionsCached()->allowShow ?? true);
    }

    /**
     *  Global Edit Action
     */
    public function allowEdit()
    {
        if (Auth::user()->isSuperadmin()) return(true);
        return($this->allowedActionsCached()->allowEdit ?? true);
    }

    /**
     *  Global Delete Action
     */
    public function allowDelete()
    {
        if (Auth::user()->isSuperadmin()) return(true);
        if ( property_exists($this, 'hasAnno') && !Auth::user()->isAdmin()) return false; // Only Available
        return($this->allowedActionsCached()->allowDelete ?? true);
    }

    /**
     *  Global Lock Action
     */
    public function allowLock()
    {
        if (Auth::user()->isSuperadmin()) return(true);
        return($this->allowedActionsCached()->allowLock ?? true);
    }

    /**
     * Get all of the model's allow actions.
     */
    public function allowedActions()
    {
        return $this->morphOne(AllowAction::class, 'allowable');
    }

    /**
     * Get all of the model's allow actions.
     */
    public function allowedActionsCached()
    {
        $allowactions=Cache::remember('allowedactions', 60*60*24, function() {
            return AllowAction::all();
        });
        return $allowactions->where( 'allowable_type',get_class($this->getModel()) )
                ->where('allowable_id', $this->id)->first();
    }

}
