<?php

namespace App\Models\Website;

use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\Traits\HasPriority;
use App\Models\Traits\HasAbilities;
use App\Models\Website\WebsitePostCat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
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
        return $this->belongsTo(WebsitePostCat::class,'website_post_cat_id','id');
    }

    /*******************************************/
    /* Accessors and mutators
    /*******************************************/

    /**
     * Get Image, if not exists return defaul image
     *
     * @return void
     */
    public function getPostImageAttribute()
    {
        $showthumb=config('lopsoft.posts_index_showthumb');

        if (is_null($this->image)) return Storage::disk('public')->url(config('lopsoft.posts_default_image'));
        if ( !Storage::disk('public')->exists( 'thumbs/'.$this->image ) || $showthumb==false)
        {
            if ( !Storage::disk('public')->exists( $this->image ) )
            {
                return Storage::disk('public')->url(config('lopsoft.posts_default_image'));
            }
            else
            {
                return Storage::disk('public')->url( $this->image );
            }
        }
        return Storage::disk('public')->url( 'thumbs/'.$this->image );
    }

    /*******************************************/
    /* Methods
    /*******************************************/

    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', '%'.$search.'%' )
            ->orWhere('body','like', '%'.$search.'%');
    }
}
