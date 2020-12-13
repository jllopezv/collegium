<?php

namespace App\Models\School;

use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasAbilities;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;

class SchoolGrade extends Model
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
        'grade', 'showorder', 'level_id'
    ];

    /*******************************************/
    /* Relationships
    /*******************************************/

    public function level()
    {
        return $this->belongsTo(SchoolLevel::class);
    }

    /*******************************************/
    /* Accessors and mutators
    /*******************************************/

    /**
     * Set Grade
     *
     * @param  String $value
     * @return void
     */
    public function setGradeAttribute($value)
    {
        $this->attributes['grade']=mb_strtoupper($value);
    }

    /**
     * Get Grade
     *
     * @param  String $value
     * @return String
     */
    public function getGradeAttribute($value)
    {
        return mb_strtoupper($value);
    }

    /*******************************************/
    /* Methods
    /*******************************************/

    public function scopeSearch($query, $search)
    {
        return $query->where('grade', 'like', '%'.$search.'%' );
    }
}
