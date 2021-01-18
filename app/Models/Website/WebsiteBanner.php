<?php

namespace App\Models\Website;

use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\Traits\HasAbilities;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WebsiteBanner extends Model
{
    use HasActive;
    use HasOwner;
    use HasCommon;
    use HasAbilities;
    use HasAllowedActions;

    /*******************************************/
    /* Properties
    /*******************************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'banner', 'width', 'height',
    ];

    /*******************************************/
    /* Relationships
    /*******************************************/

    /**
     * Set Banner
     *
     * @param  String $value
     * @return void
     */
    public function setBannerAttribute($value)
    {
        $this->attributes['banner']=mb_strtoupper($value);
    }

    /**
     * Get Banner
     *
     * @param  String $value
     * @return String
     */
    public function getBannerAttribute($value)
    {
        return mb_strtoupper($value);
    }


    /*******************************************/
    /* Accessors and mutators
    /*******************************************/

    /*******************************************/
    /* Methods
    /*******************************************/

    public function scopeSearch($query, $search)
    {
        return $query->where('banner', 'like', '%'.$search.'%' )
            ->orWhere('width','like', '%'.$search.'%')
            ->orWhere('height','like', '%'.$search.'%');
    }
}
