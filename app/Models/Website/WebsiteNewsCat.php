<?php

namespace App\Models\Website;

use App\Models\Aux\Color;
use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\Traits\HasPriority;
use App\Models\Traits\HasAbilities;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;

class WebsiteNewsCat extends Model
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
        'category', 'priority', 'color_id'
    ];

    /*******************************************/
    /* Relationships
    /*******************************************/

    /**
     * Get Color
     *
     * @return void
     */
    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    /*******************************************/
    /* Accessors and mutators
    /*******************************************/

    /**
     * Set Level
     *
     * @param  String $value
     * @return void
     */
    public function setCategoryAttribute($value)
    {
        $this->attributes['category']=mb_strtoupper($value);
    }

    /**
     * Get Level
     *
     * @param  String $value
     * @return String
     */
    public function getCategoryAttribute($value)
    {
        return mb_strtoupper($value);
    }

    public function getCategoryNameAttribute($value)
    {
        return $this->color->getCustomTag($this->category);
    }


    /*******************************************/
    /* Methods
    /*******************************************/

    public function scopeSearch($query, $search)
    {
        return $query->where('category', 'like', '%'.$search.'%' );
    }

}
