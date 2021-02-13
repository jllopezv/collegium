<?php

namespace App\Models\School;

use App\Models\Traits\HasAnno;
use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\Traits\HasAbilities;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;
use App\Models\Traits\HasAvailable;
use App\Models\Traits\HasPriority;
use PhpParser\ErrorHandler\Collecting;

class SchoolGrade extends Model
{
    use HasActive;
    use HasOwner;
    use HasCommon;
    use HasAbilities;
    use HasAllowedActions;
    use HasAnno;
    use HasPriority;
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
        'grade', 'priority', 'level_id'
    ];

    protected $appends=['priority', 'available'];

    /*******************************************/
    /* Relationships
    /*******************************************/

    public function level()
    {
        return $this->belongsTo(SchoolLevel::class);
    }

    public function students($anno_id=null)
    {
        if ($anno_id==null)
        {
            $anno=getUserAnnoSession();
        }
        else
        {
            $anno=Anno::find($anno_id);
        }
        $collect=collect();
        if ($anno!=null)
        {
            foreach($anno->students()->orderBy('id','asc')->get() as $student)
            {
                $grade=$student->gradeInAnno($anno_id);
                if ($grade!=null)
                {
                    if ($grade->id==$this->id) $collect->push($student);
                }
            }
        }
        return $collect;
    }

    /*******************************************/
    /* Accessors and mutators
    /*******************************************/

    public function getPriorityAttribute()
    {
        $anno=getUserAnnoSession();
        $grade=$anno->schoolGrades->where('id', $this->id)->first();
        if ($grade==null) return 0;
        return $grade->pivot->priority;
    }

    public function setPriorityAttribute($value)
    {
        $anno=getUserAnnoSession();
        $anno->schoolGrades()->updateExistingPivot($this->id, ['priority' => $value]);
    }

    public function getAvailableAttribute()
    {

        $anno=getUserAnnoSession();
        $grade=$anno->schoolGrades->where('id', $this->id)->first();
        if ($grade==null) return null;
        return $grade->pivot->available;

    }

    public function setAvailableAttribute($value)
    {
        $anno=getUserAnnoSession();
        $anno->schoolGrades()->updateExistingPivot($this->id, ['available' => $value]);
    }


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
