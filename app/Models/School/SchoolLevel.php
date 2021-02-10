<?php

namespace App\Models\School;

use Exception;
use Illuminate\Support\Str;
use App\Models\Traits\HasAnno;
use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\Traits\HasPriority;
use Illuminate\Support\Facades\DB;
use App\Models\Traits\HasAbilities;
use App\Models\Traits\HasAvailable;
use App\Http\Livewire\Traits\HasAvatar;
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
    use HasAvailable;


    /*******************************************/
    /* Properties
    /*******************************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'level', 'priority', 'available'
    ];

    protected $appends=[ 'priority', 'available' ];

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

    public function getPriorityAttribute()
    {
        $anno=getUserAnnoSession();
        $level=$anno->schoolLevels->where('id', $this->id)->first();
        if ($level==null) return 0;
        return $level->pivot->priority;
    }

    public function setPriorityAttribute($value)
    {
        $anno=getUserAnnoSession();
        $anno->schoolLevels()->updateExistingPivot($this->id, ['priority' => $value]);
    }

    public function getAvailableAttribute()
    {

        $anno=getUserAnnoSession();
        $level=$anno->schoolLevels->where('id', $this->id)->first();
        if ($level==null) return null;
        return $level->pivot->available;

    }

    public function setAvailableAttribute($value)
    {
        $anno=getUserAnnoSession();
        $anno->schoolLevels()->updateExistingPivot($this->id, ['available' => $value]);
    }

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
