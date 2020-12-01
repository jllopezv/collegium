<?php

namespace App\Models\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait HasOwner
{
    public static function bootHasOwner()
    {
        static::creating(function($model){
            self::setOwner($model);
        });

        static::updating(function($model){
            self::setUpdatedBy($model);
        });
    }

    public static function setOwner($model)
    {
        $model->owner()->associate( Auth::user() );
    }

    public static function setUpdatedBy($model)
    {
        $model->updatedByUser()->associate( Auth::user() );
    }

    /**
     * Get created_by user
     *
     * @return void
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get updated_by user
     *
     * @return void
     */
    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

}
