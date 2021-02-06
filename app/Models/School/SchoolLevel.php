<?php

namespace App\Models\School;

use Illuminate\Support\Str;
use App\Models\Traits\HasAnno;
use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\Traits\HasPriority;
use Illuminate\Support\Facades\DB;
use App\Models\Traits\HasAbilities;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolLevel extends Model
{
    use HasActive;
    use HasOwner;
    use HasCommon;
    use HasAbilities;
    use HasAllowedActions;
    use HasPriority;
    use HasAnno;


    /*******************************************/
    /* Properties
    /*******************************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'level', 'priority'
    ];

    /*******************************************/
    /* Relationships
    /*******************************************/

    public function inAnno($anno_id=null)
    {
        $record=DB::table('anno_school_level')->where('anno_id', getAnnoSessionId($anno_id))->pluck('school_level_id')->first();
        return SchoolLevel::find($record);
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
