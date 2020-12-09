<?php

namespace App\Models\Auth;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class AllowAction extends Model
{
    protected $fillable=[ 'allowShow', 'allowEdit', 'allowDelete', 'allowLock '];

    public static function boot()
    {
        parent::boot();

        static::created(function($model){
            Cache::forget('allowedactions');
        });

        static::deleted(function($model){
            Cache::forget('allowedactions');
        });

        static::updated(function($model){
            Cache::forget('allowedactions');
        });

        static::saved(function($model){
            Cache::forget('allowedactions');
        });
    }


    /**
     * Get the owning commentable model.
     */
    public function allowable()
    {
        return $this->morphTo();
    }
}
