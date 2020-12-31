<?php

namespace App\Models\Setting;

use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\Traits\HasAbilities;
use App\Models\Traits\HasFilemanager;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;

class AppSetting extends Model
{
    use HasAbilities;
    use HasCommon;
    use HasAllowedActions;
    use HasActive;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'settingkey', 'settingdesc', 'settingvalue', 'type', 'page_id'
    ];

    /*******************************************/
    /* Accessor / Mutators
    /*******************************************/

    public function setSettingkeyAttribute($value)
    {
        $this->attributes['settingkey']=str_replace(' ','_',mb_strtoupper($value));
    }

    public function getSettingkeyAttribute($value)
    {
        return str_replace(' ','_',mb_strtoupper($value));
    }

    /*******************************************/
    /* Relationships
    /*******************************************/

    /**
     * Get Settings
     */
    public function page()
    {
        return $this->hasOne(AppSettingPage::class, 'page_id' ,'id')->where('active',1);
    }



    public function scopeSearch($query, $search)
    {
        return $query->where('settingkey', 'like', '%'.$search.'%' )
            ->whereOr('settingdesc', 'like', '%'.$search.'%' )
            ->whereOr('settingvalue', 'like', '%'.$search.'%' );
    }

}
