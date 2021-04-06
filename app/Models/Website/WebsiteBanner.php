<?php

namespace App\Models\Website;

use App\Models\Aux\Image;
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
     * Get all of the models's translations.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /*******************************************/
    /* Accessors and mutators
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

    /**
     * Get Image
     *
     * @param  String $value
     * @return String
     */
    public function getImageAttribute($value)
    {
        return $this->images->first();
    }

    /*******************************************/
    /* Methods
    /*******************************************/

    public function scopeSearch($query, $search)
    {
        return $query->where('banner', 'like', '%'.$search.'%' )
            ->orWhere('width','like', '%'.$search.'%')
            ->orWhere('height','like', '%'.$search.'%');
    }

    static public function getBanner($banner)
    {
        return WebsiteBanner::where('banner',$banner)->first();
    }
}
