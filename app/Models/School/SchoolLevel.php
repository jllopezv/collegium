<?php

namespace App\Models\School;

use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasAbilities;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolLevel extends Model
{
    use HasActive;
    use HasOwner;
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
        'level', 'showorder'
    ];

    /*******************************************/
    /* Relationships
    /*******************************************/

    /*******************************************/
    /* Accessors and mutators
    /*******************************************/

    /**
     * Set Level
     *
     * @param  String $value
     * @return void
     */
    public function setLevelAttribute($value)
    {
        $this->attributes['level']=mb_strtoupper($value);
    }

    /**
     * Get Level
     *
     * @param  String $value
     * @return String
     */
    public function getLevelAttribute($value)
    {
        return mb_strtoupper($value);
    }


    /*******************************************/
    /* Methods
    /*******************************************/

    public function scopeSearch($query, $search)
    {
        return $query->where('level', 'like', '%'.$search.'%' );
    }

}
