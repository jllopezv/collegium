<?php

namespace App\Models\Website;

use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\Traits\HasPriority;
use App\Models\Traits\HasAbilities;
use App\Models\Website\WebsitePostCat;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WebsitePost extends Model
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
        'title', 'published', 'top', 'fixed', 'starred', 'body', 'image', 'website_post_cat_id'
    ];

    /*******************************************/
    /* Relationships
    /*******************************************/

    /**
     * Get Color
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(WebsitePostCat::class);
    }

    /*******************************************/
    /* Accessors and mutators
    /*******************************************/



    /*******************************************/
    /* Methods
    /*******************************************/

    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', '%'.$search.'%' )
            ->orWhere('body','like', '%'.$search.'%');
    }
}
