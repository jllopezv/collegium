<?php

namespace App\Models\Website;

use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\Traits\HasPriority;
use App\Models\Traits\HasAbilities;
use App\Models\Website\WebsiteAdvertisementCat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Traits\HasAllowedActions;
use App\Models\Traits\HasShowed;

class WebsiteAdvertisement extends Model
{
    use HasActive;
    use HasOwner;
    use HasCommon;
    use HasAbilities;
    use HasAllowedActions;
    use HasShowed;


    /*******************************************/
    /* Properties
    /*******************************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'published', 'top', 'fixed', 'starred', 'body', 'image', 'website_advertisement_cat_id', 'showed'
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
        return $this->belongsTo(WebsiteAdvertisementCat::class,'website_advertisement_cat_id','id');
    }

    /*******************************************/
    /* Accessors and mutators
    /*******************************************/

    /**
     * Get Image, if not exists return defaul image
     *
     * @return void
     */
    public function getAdvertisementImageAttribute()
    {
        $showthumb=config('lopsoft.advertisements_index_showthumb');

        if (is_null($this->image)  || $this->image=='') return Storage::disk('public')->url(config('lopsoft.advertisements_default_image'));
        if ( !Storage::disk('public')->exists( 'thumbs/'.$this->image ) || $showthumb==false)
        {
            if ( !Storage::disk('public')->exists( $this->image ) )
            {
                return Storage::disk('public')->url(config('lopsoft.advertisements_default_image'));
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
    /**
     * Scope a query to only include published records.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('published', 1);
    }

    public function getStatusFormatted()
    {
        return  "<span class=''>".
                "<i class='px-3 fa fa-globe-americas fa-fw ".($this->published?'text-green-400':'text-gray-300')."'></i>".
                "<i class='px-3 fa fa-thumbs-up fa-fw ".($this->top?'text-blue-400':'text-gray-300')."'></i>".
                "<i class='px-3 fa fa-thumbtack fa-fw ".($this->fixed?'text-red-400':'text-gray-300')."'></i>".
                "<i class='px-3 fa fa-star fa-fw ".($this->starred?'text-yellow-400':'text-gray-300')."'></i>".
                "</span>";
    }
}
