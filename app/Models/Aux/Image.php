<?php

namespace App\Models\Aux;

use App\Models\Traits\HasAbilities;
use App\Models\Website\WebsiteBanner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Traits\HasAllowedActions;

class Image extends Model
{
    use HasAbilities;
    use HasAllowedActions;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image', 'data', 'tag'
    ];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function banners()
    {
        $this->morphedMany(WebsiteBanner::class, 'imageable');
    }

    /**
     * Get Image, if not exists return defaul image
     *
     * @return void
     */
    public function getUrlImageAttribute()
    {
        $showthumb=config('lopsoft.images_index_showthumb');

        if (is_null($this->image)  || $this->image=='') return Storage::disk('public')->url(config('lopsoft.images_default_image'));
        if ( !Storage::disk('public')->exists( 'thumbs/'.$this->image ) || $showthumb==false)
        {
            if ( !Storage::disk('public')->exists( $this->image ) )
            {
                return Storage::disk('public')->url(config('lopsoft.images_default_image'));
            }
            else
            {
                return Storage::disk('public')->url( $this->image );
            }
        }
        return Storage::disk('public')->url( 'thumbs/'.$this->image );
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('image', 'like', '%'.$search.'%' );
    }

}
