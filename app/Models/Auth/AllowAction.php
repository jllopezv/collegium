<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class AllowAction extends Model
{
    protected $fillable=[ 'allowShow', 'allowEdit', 'allowDelete', 'allowLock '];
    /**
     * Get the owning commentable model.
     */
    public function allowable()
    {
        return $this->morphTo();
    }
}
