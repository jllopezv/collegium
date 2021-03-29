<?php

namespace App\Models\Website;

use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\Traits\HasPriority;
use App\Models\Traits\HasAbilities;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;

class WebsiteMenu extends Model
{
    use HasActive;
    use HasOwner;
    use HasCommon;
    use HasAbilities;
    use HasAllowedActions;
    use HasPriority;


    /*******************************************/
    /* Properties
    /*******************************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu', 'label', 'priority', 'parent_id', 'link', 'website_page_id'
    ];

    /*******************************************/
    /* Relationships
    /*******************************************/

    /**
     * Get Page
     *
     * @return void
     */
    public function page()
    {
        return $this->belongsTo(WebsitePage::class,'website_page_id','id');
    }



    /*******************************************/
    /* Accessors and mutators
    /*******************************************/

    public function setMenuAttribute($value)
    {
        $this->attributes['menu']=mb_strtoupper($value);
    }

    public function getMenuAttribute($value)
    {
        return mb_strtoupper($value);
    }

    /*******************************************/
    /* Methods
    /*******************************************/

    public function scopeSearch($query, $search)
    {
        return $query->where('menu', 'like', '%'.$search.'%' )
            ->orWhere('label', 'like', '%'.$search.'%' );
    }

}
