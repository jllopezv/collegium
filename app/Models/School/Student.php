<?php

namespace App\Models\School;

use App\Models\Aux\Document;
use App\Models\Traits\HasAnno;
use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\Traits\IsUserType;
use App\Models\Traits\HasPriority;
use App\Models\Traits\HasAbilities;
use App\Models\Traits\HasModelAvatar;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;

class Student extends Model
{
    use HasActive;
    use HasOwner;
    use HasCommon;
    use HasAbilities;
    use HasAllowedActions;
    use IsUserType;
    use HasAnno;
    use HasPriority;
    use HasModelAvatar;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'exp', 'names', 'profile_photo_path', 'first_surname', 'second_surname', 'birth', 'gender', 'priority'
    ];

    protected $appends= [ 'name', 'avatar', 'grade' ,'priority', 'params', 'section', 'modality'];

    protected $dates=[ 'birth' ];

    /*******************************************/
    /* Relationships
    /*******************************************/

    public function enrolled()
    {
        return $this->belongsToMany(Anno::class)->withPivot(['grade_id', 'section_id', 'batch_id', 'modality_id']);
    }

    public function gradeInAnno($anno_id=null)
    {
        if ($anno_id==null)
        {
            $anno=getUserAnnoSession();
            if ($anno==null) return '';
        }
        else
        {
            $anno=Anno::find($anno_id);
            if ($anno==null) return '';
        }

        $student=$anno->students()->withPivot('grade_id')->where('students.id', $this->id)->first();
        if ($student==null) return '';
        $grade=SchoolGrade::find($student->pivot->grade_id);
        if ($grade==null) return '';
        return $grade;
    }

    public function parents()
    {
        return $this->belongsToMany(SchoolParent::class,'school_parent_student')->withPivot('relationship');
    }

    /**
     * Get all of the models's documents.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }


    /*******************************************/
    /* Accessors and mutators
    /*******************************************/

    public function getPriorityAttribute()
    {
        $anno=getUserAnnoSession();
        $student=$anno->students->where('id', $this->id)->first();
        if ($student==null) return 0;
        return $student->pivot->priority;
    }

    public function setPriorityAttribute($value)
    {
        $anno=getUserAnnoSession();
        $anno->students()->updateExistingPivot($this->id, ['priority' => $value]);
    }

    /**
     * Get grade of student in the anno session
     *
     * @return SchoolGrade
     */
    public function getGradeAttribute()
    {
        $anno=getUserAnnoSession();
        if ($anno==null) return null;
        $student=$anno->students()->withPivot('grade_id')->where('students.id', $this->id)->first();
        if ($student==null) return null;
        $grade=SchoolGrade::find($student->pivot->grade_id);
        if ($grade==null) return null;
        return $grade;
    }

    /**
     * Get grade of student in the anno session
     *
     * @return SchoolGrade
     */
    public function getParamsAttribute()
    {
        $anno=getUserAnnoSession();
        if ($anno==null) return [];
        $params=$anno->students()->withPivot(['grade_id', 'section_id', 'batch_id', 'modality_id'])->where('students.id', $this->id)->first();
        if ($params==null) return [];
        return ([
            'grade_id'      =>  $params->pivot->grade_id,
            'section_id'    =>  $params->pivot->section_id,
            'batch_id'      =>  $params->pivot->batch_id,
            'modality_id'   =>  $params->pivot->modality_id,
        ]);
    }

    public function getModalityAttribute()
    {
        $params=$this->params;
        if (sizeof($params)==0) return null;
        return SchoolModality::find($params['modality_id'])->first();
    }

    public function getBatchAttribute()
    {
        $params=$this->params;
        if (sizeof($params)==0) return null;
        return SchoolBatch::find($params['batch_id'])->first();
    }

    /**
     * Get grade of student in the anno session
     *
     * @return SchoolGrade
     */
    public function getSectionAttribute()
    {
        $anno=getUserAnnoSession();
        if ($anno==null) return [];
        $params=$anno->students()->withPivot(['grade_id', 'section_id', 'batch_id', 'modality_id'])->where('students.id', $this->id)->first();
        if ($params==null) return [];

        $section=SchoolSection::find($params->pivot->section_id)->section??'';
        $batch=SchoolBatch::find($params->pivot->batch_id)->batch??'';
        //$modality=SchoolModality::find($params->pivot->modality_id)->modality??'';

        return $section.'-'.$batch;//.' ('.$modality.') ';

    }


    public function getNameAttribute()
    {
        return $this->first_surname." ".$this->second_surname.", ".$this->names;
    }

    /**
     * Get Name in uppercase
     *
     * @param  string  $value
     * @return string
     */
    public function getNamesAttribute($value)
    {
        if (config('lopsoft.studentsname_uppercase')) return mb_strtoupper($value);
        return $value;
    }

    /**
     * Set Names in uppercase
     *
     * @param  string  $value
     * @return void
     */
    public function setNamesAttribute($value)
    {
        if (config('lopsoft.studentsname_uppercase')) $this->attributes['names'] = mb_strtoupper($value);
    }

    /**
     * Get First_surname in uppercase
     *
     * @param  string  $value
     * @return string
     */
    public function getFirstSurnameAttribute($value)
    {
        if (config('lopsoft.studentsname_uppercase')) return mb_strtoupper($value);
        return $value;
    }

    /**
     * Set FirstSurname in uppercase
     *
     * @param  string  $value
     * @return void
     */
    public function setFirstSurnameAttribute($value)
    {
        if (config('lopsoft.studentsname_uppercase')) $this->attributes['first_surname'] = mb_strtoupper($value);
    }

    /**
     * Get Secondsurname in uppercase
     *
     * @param  string  $value
     * @return string
     */
    public function getSecondSurnameAttribute($value)
    {
        if (config('lopsoft.studentsname_uppercase')) return mb_strtoupper($value);
        return $value;
    }

    /**
     * Set SecondSurname in uppercase
     *
     * @param  string  $value
     * @return void
     */
    public function setSecondSurnameAttribute($value)
    {
        if (config('lopsoft.studentsname_uppercase')) $this->attributes['second_surname'] = mb_strtoupper($value);
    }

    /*******************************************/
    /* Methods
    /*******************************************/

    public function isEnrolled()
    {
        return ($this->enrolled->where('id',getUserAnnoSessionId())->first()!=null?true:false );
    }

    public function enroll( $params, $anno_id=null )
    {
        if ($anno_id==null)
        {
            $anno_id=getUserAnnoSessionId();
        }

        $enroll=$this->enrolled->where('id',$anno_id)->first();
        // if ($enroll!=null && $enroll->pivot->grade_id!=$params['grade_id'])
        // {
        //     $this->annos()->detach($anno_id);
        // }
        $this->annos()->attach($anno_id, $params);

        return $this;
    }

    public function updateEnroll( $params, $anno_id=null )
    {
        if ($anno_id==null)
        {
            $anno_id=getUserAnnoSessionId();
        }

        $enroll=$this->enrolled->where('id',$anno_id)->first();
        $this->annos()->updateExistingPivot($anno_id, $params);

        return $this;
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('exp', 'like', '%'.$search.'%' )
            ->orWhere('names', 'like', '%'.$search.'%')
            ->orWhere('first_surname', 'like', '%'.$search.'%')
            ->orWhere('second_surname', 'like', '%'.$search.'%' );
    }


    /*******************************************/
    /* Actions
    /*******************************************/

    public function postDelete()
    {
        $this->user->delete();  // Delete asocciated user
    }

    public function postLock()
    {
        $this->user->lock();  // Lock asocciated user
    }

    public function postUnlock()
    {
        $this->user->unlock(); // Unlock assocciated user
    }
}
