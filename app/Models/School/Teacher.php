<?php

namespace App\Models\School;

use App\Models\Crm\Employee;
use App\Models\Traits\HasAnno;
use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\Traits\IsUserType;
use App\Models\Traits\HasPriority;
use Illuminate\Support\Facades\DB;
use App\Models\Traits\HasAbilities;
use App\Models\Traits\HasAvailable;
use App\Models\Traits\HasModelAvatar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Traits\HasAllowedActions;


class Teacher extends Model
{
    use HasActive;
    use HasOwner;
    use HasCommon;
    use HasAbilities;
    use HasAllowedActions;

    /* Profile */
    use IsUserType;

    /* Avatar */
    use HasModelAvatar;

    /* Anno Support */
    use HasAnno;
    use HasPriority;
    use HasAvailable;

    private $subject_id=0;


    /*******************************************/
    /* Properties
    /*******************************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'teacher','employee_id'
    ];

    protected $appends = [
        'coordinator'
    ];

    /*******************************************/
    /* Relationships
    /*******************************************/

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(SchoolSubject::class,'anno_school_subject_teacher', 'teacher_id', 'id' );
    }

    public function grades()
    {
        $anno=getUserAnnoSession();
        $subjects=$this->subjects();
        $anno_subjects=$anno->schoolSubjects()->whereIn('school_subject_id', $subjects->pluck('school_subject_id'))->pluck('grade_id');
        return $anno->schoolGrades()->whereIn('school_grades.id', $anno_subjects);
    }

    /*******************************************/
    /* Accessors and mutators
    /*******************************************/

    /**
     * Get Avatar, if not exists return defaul avatar
     *
     * @return void
     */
    public function getAvatarAttribute()
    {
        if (is_null($this->profile_photo_path))
        {
            if ($this->employee!=null) return $this->employee->avatar;
            return $this->user->avatar;
        }
        if ( !Storage::disk('public')->exists( 'thumbs/'.$this->profile_photo_path ) )
        {
            if ( !Storage::disk('public')->exists( $this->profile_photo_path ) )
            {
                return Storage::disk('public')->url(config('lopsoft.default_avatar'));
            }
            else
            {
                return Storage::disk('public')->url( $this->profile_photo_path );
            }
        }
        return Storage::disk('public')->url( 'thumbs/'.$this->profile_photo_path );
    }

    public function getPriorityAttribute()
    {
        $anno=getUserAnnoSession();
        $grade=$anno->teachers->where('id', $this->id)->first();
        if ($grade==null) return 0;
        return $grade->pivot->priority;
    }

    public function setPriorityAttribute($value)
    {
        $anno=getUserAnnoSession();
        $anno->teachers()->updateExistingPivot($this->id, ['priority' => $value]);
    }

    public function getAvailableAttribute()
    {

        $anno=getUserAnnoSession();
        $grade=$anno->teachers->where('id', $this->id)->first();
        if ($grade==null) return null;
        return $grade->pivot->available;

    }

    public function setAvailableAttribute($value)
    {
        $anno=getUserAnnoSession();
        $anno->teachers()->updateExistingPivot($this->id, ['available' => $value]);
    }

    public function getCoordinatorAttribute()
    {
        return $this->coordinator($this->subject_id, null);

    }

    public function coordinator($subject_id, $anno_id=null)
    {

        if ($anno_id==null) $anno_id=getUserAnnoSessionId();

        $ret=DB::table('anno_school_subject_teacher')->where('anno_id', $anno_id)
        ->where('school_subject_id', $subject_id)
        ->where('teacher_id', $this->id)->first();

        return $ret->coordinator??0;

    }

    /*******************************************/
    /* Methods
    /*******************************************/

    public function scopeSearch($query, $search)
    {
        return $query->where('teacher', 'like', '%'.$search.'%' );
    }

    public function setSubject($subject_id)
    {
        $this->subject_id=$subject_id;
        return $this;
    }

    /*******************************************/
    /* Actions
    /*******************************************/

    /*******************************************/
    /* Actions
    /*******************************************/

    public function postDelete()
    {
        $this->user->delete();  // Delete asocciated user

        // Associated subjects

        $anno=getUserAnnoSession();
        DB::table('anno_school_subject_teacher')->where('teacher_id', $this->id)->delete();
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
