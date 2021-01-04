<?php

namespace App\Models\Setting;

use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\Setting\AppSetting;
use App\Models\Traits\HasPriority;
use App\Models\Traits\HasAbilities;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;

class AppSettingPage extends Model
{
    use HasAbilities;
    use HasCommon;
    use HasAllowedActions;
    use HasActive;
    use HasPriority;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'settingpage', 'priority', 'description', 'onlysuperadmin'
    ];

    public function setSettingpageAttribute($value)
    {
        $this->attributes['settingpage']=mb_strtoupper($value);
    }

    public function getSettingpageAttribute($value)
    {
        return mb_strtoupper($value);
    }

    /*******************************************/
    /* Relationships
    /*******************************************/

    /**
     * Get Settings
     */
    public function settings()
    {
        return $this->hasMany(AppSetting::class,  'page_id' ,'id')->where('active',1);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('settingpage', 'like', '%'.$search.'%' );
    }

    public function canDeleteRecordCustom()
    {
        return ($this->canBeDeleted());
    }

    public function canBeDeleted()
    {
        //TODO: chequear si tiene settings asociados
    }

}
