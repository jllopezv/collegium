<?php

namespace App\Models\School;

use App\Models\Traits\HasAnno;
use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\Traits\HasPriority;
use Illuminate\Support\Facades\DB;
use App\Models\School\SchoolPeriod;
use App\Models\Traits\HasAbilities;
use App\Models\Traits\HasAvailable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;

class SchoolSubject extends Model
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
        'code', 'subject', 'abbr', 'priority'
    ];

    protected $appends=['priority', 'available'];

    /*******************************************/
    /* Relationships
    /*******************************************/


    /*******************************************/
    /* Accessors and mutators
    /*******************************************/

    public function getGradeAttribute()
    {
        try{
            $anno=getUserAnnoSession();
            $grade_id=$anno->schoolSubjects->find($this->id)->pivot->grade_id;
            $grade=SchoolGrade::find($grade_id);
            return $grade;
        }
        catch(\Exception $e)
        {
            return null;
        }
    }

    public function getPeriodAttribute()
    {
        try{
            $anno=getUserAnnoSession();
            $period_id=$anno->schoolSubjects->find($this->id)->pivot->period_id;
            $period=SchoolPeriod::find($period_id);
            return $period;
        }
        catch(\Exception $e)
        {
            return null;
        }
    }

    public function getPriorityAttribute()
    {
        $anno=getUserAnnoSession();
        $grade=$anno->schoolSubjects->where('id', $this->id)->first();
        if ($grade==null) return 0;
        return $grade->pivot->priority;
    }

    public function setPriorityAttribute($value)
    {
        $anno=getUserAnnoSession();
        $anno->schoolSubjects()->updateExistingPivot($this->id, ['priority' => $value]);
    }

    public function getAvailableAttribute()
    {

        $anno=getUserAnnoSession();
        $grade=$anno->schoolSubjects->where('id', $this->id)->first();
        if ($grade==null) return null;
        return $grade->pivot->available;

    }

    public function setAvailableAttribute($value)
    {
        $anno=getUserAnnoSession();
        $anno->schoolSubjects()->updateExistingPivot($this->id, ['available' => $value]);
    }


    /**
     * Set Subject
     *
     * @param  String $value
     * @return void
     */
    public function setSubjectAttribute($value)
    {
        $this->attributes['subject']=mb_strtoupper($value);
    }

    /**
     * Get Subject
     *
     * @param  String $value
     * @return String
     */
    public function getSubjectAttribute($value)
    {
        return mb_strtoupper($value);
    }

    /**
     * Set Abbr
     *
     * @param  String $value
     * @return void
     */
    public function setAbbrAttribute($value)
    {
        $this->attributes['abbr']=mb_strtoupper($value);
    }

    /**
     * Get Abbr
     *
     * @param  String $value
     * @return String
     */
    public function getAbbrAttribute($value)
    {
        return mb_strtoupper($value);
    }

    public function teachers()
    {
        $anno=getUserAnnoSession();
        $teachers=DB::table('anno_school_subject_teacher')->where('anno_id', $anno->id)
            ->where('school_subject_id', $this->id)->pluck('teacher_id');
        return $anno->teachers()->whereIn('teachers.id', $teachers)->get();
    }

    /*******************************************/
    /* Methods
    /*******************************************/

    public function scopeSearch($query, $search)
    {
        return $query->where('code', 'like', '%'.$search.'%' )->
                    orWhere('subject', 'like', '%'.$search.'%' );
    }
}
