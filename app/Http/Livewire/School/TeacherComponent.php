<?php

namespace App\Http\Livewire\School;

use Livewire\Component;
use App\Lopsoft\LopHelp;
use App\Models\Crm\Employee;
use Livewire\WithPagination;
use App\Models\School\Teacher;
use App\Models\School\SchoolLevel;
use Illuminate\Support\Facades\DB;
use App\Models\School\SchoolSubject;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\IsUserType;
use App\Http\Livewire\Traits\HasPriority;
use App\Http\Livewire\Traits\HasAvailable;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAnnoSupport;
use App\Http\Livewire\Traits\WithUserProfile;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class TeacherComponent extends Component
{
    /* Common */
    use WithPagination;
    use HasCommon;

    /* Messages */
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;

    /* User */
    use IsUserType;
    use WithUserProfile;

    /* Anno Support */
    use HasPriority;
    use HasAvailable;
    use WithAnnoSupport;

    public $teacher;
    public $employee_id;
    public $employee=null;
    public $employeedata=[];

    /* Subjects Tab */
    public $level_id='*';
    public $grade_id='*';
    public $period_id='*';
    public $subjects=[];
    public $filtersubjects='';
    public $subjects_selected;
    public $subjects_id_selected;


    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',


        /* Anno Support */
        'activateRecordInAnnoAction' => 'activateRecordInAnnoAction',
        'deactivateRecordInAnnoAction' => 'deactivateRecordInAnnoAction',

        /* Events */
        'eventsetemployee'      =>  'eventSetEmployee',

        /* Filters */
        'eventsubjectfilterlevel'      => 'eventSubjectFilterLevel',
        'eventsubjectfiltergrade'      => 'eventSubjectFilterGrade',
        'eventsubjectfilterperiod'      => 'eventSubjectFilterPeriod',

    ];

    /**
     * Mount function
     *
     * @return void
     */
    public function mount()
    {
        $this->table='teachers';
        $this->module='school';
        $this->commonMount();
        $this->multiple=true;
        // Default order for table
        $this->sortorder='id';
        if ($this->mode=='create')
        {
            // default create options
            $this->loadDefaults();
        }

   }

    /**
     * Rules to validate model
     *
     * @return array
     */
    public function validateRules() : array
    {
        return [
            'teacher'                => 'required|string|max:255',//|unique:school_levels,level,'.$this->recordid,
        ];
    }

    public function loadDefaults()
    {
        $this->subjects_selected=collect([]);

        // Userprofile
        $this->userProfileClear();

        $this->createSubjectsFilter();
    }

    public function resetForm()
    {
        $this->teacher='';
        $this->employee_id=0;
        $this->loadDefaults();

    }

    public function loadRecordDef()
    {
        $this->teacher=$this->record->teacher;
        $this->employee_id=$this->record->employee_id;

        $this->profileuseremail=$this->record->user->email;
        $this->profileusername=$this->record->user->username;

        $anno=getUserAnnoSession();
        $subjectsdata=DB::table('anno_school_subject_teacher')->where('anno_id', $anno->id)
            ->where('teacher_id', $this->record->id);

        $this->subjects_id_selected=collect($subjectsdata->pluck('school_subject_id'));
        $this->subjects_selected=$anno->belongsToMany(SchoolSubject::class)->active()->available()->withPivot(['grade_id','period_id','priority','available'])->orderBy('grade_id')->whereIn('school_subject_id', $this->subjects_id_selected )->get();

    }

    public function getKeyNotification($record)
    {
        return ($record->teacher);
    }

    /**
     * Validate only some fields
     *
     * @return void
     */
    public function validateFields()
    {
        return [
            'teacher'                =>  $this->teacher,
        ];
    }

    /**
     * Save or Update record data
     *
     * @return void
     */
    public function saveRecord()
    {
        return [
            'teacher'                 => $this->teacher,
            'employee_id'             => $this->employee_id,

        ];
    }

    public function customValidation()
    {
        $haserrorsemails=false;
        $haserrorsphones=false;
        $haserrors=false;

        $haserrors=$this->userProfileValidation();

        if ($haserrorsemails || $haserrorsphones || $haserrors)
        {
            $this->showFlashError($this->flashmessageid,"ERROR EN LOS DATOS");
            $this->emit('validationerror', $this->getErrorBag());
            return false;
        }
        return true;
    }


    public function customStoreValidation()
    {
        return $this->customValidation();
    }

    public function customUpdateValidation()
    {
        return $this->customValidation();
    }

    public function postStore($recordStored)
    {
        $this->userProfileSaveUser($recordStored, $this->teacher, 'teacher');
    }

    public function postUpdate($recordUpdated)
    {
        // Update user
        $this->userProfileUpdateUser($recordUpdated);

        // Update subjects
        $anno=getUserAnnoSession();
        DB::table('anno_school_subject_teacher')->where('anno_id',$anno->id)
            ->where('teacher_id', $recordUpdated->id)->delete();
        foreach($this->subjects_selected as $subj)
        {
            $anno->schoolSubjectsTeachers()->attach([ $subj->id => [
                'teacher_id'    =>  $recordUpdated->id,
            ]]);
        }

    }

    public function getProfileUsername()
    {
        $parts=explode(' ',$this->teacher);
        if (sizeof($parts)==1)
        {
            $username=$parts[0];
        }
        if (sizeof($parts)==2)
        {
            $username=$parts[0].'.'.$parts[1];
        }
        if (sizeof($parts)>2)
        {
            $username=$parts[0].substr($parts[1],0,1).'.'.$parts[2];
        }
        $username=mb_strtolower( withoutAccents($username) );
        return $username;
    }

    public function selectSubject($subject_id)
    {
        $this->subjects_id_selected[]=$subject_id;
        $anno=getUserAnnoSession();
        $s=$anno->belongsToMany(SchoolSubject::class)->active()->available()->withPivot(['grade_id','period_id','priority','available'])->orderBy('grade_id');
        $s=$s->whereIn('school_subjects.id', $this->subjects_id_selected)->get();
        $this->subjects_selected=$s;
    }
    public function deleteSubject($array_id)
    {
        $this->subjects_id_selected->splice($array_id, 1);
        $anno=getUserAnnoSession();
        $s=$anno->belongsToMany(SchoolSubject::class)->active()->available()->withPivot(['grade_id','period_id','priority','available'])->orderBy('grade_id');
        $s=$s->whereIn('school_subjects.id', $this->subjects_id_selected)->get();
        $this->subjects_selected=$s;
    }

    /** Events */

    public function eventSetEmployee($employee_id)
    {
        if ($employee_id==null) return;

        $this->employee_id=$employee_id;
        $this->employee=Employee::find($employee_id);
        if ($this->employee==null)
        {
            $this->employeedata=[];
            return;
        }
        $this->employeedata=$this->employee->toArray();
        $this->emit('setvalue','hiredcomponent', getDateString($this->employee->hired));

        $this->teacher = $this->employee->employee;
    }

    /**
     * Anno Support
     */

    public function forceGetQueryData($ret)
    {

        if ($this->showOnlyAnno)
        {
            $subset=getUserAnnoSession()->teachers();
        }
        else
        {
            $subset=Teacher::query();
            $this->resetFilter();
        }
        return $this->annoSupportForceGetQueryData($ret, $subset );
    }

    public function activateRecordInAnnoAction($id)
    {
        $anno=getUserAnnoSession();
        $item=$this->model::find($id);
        $anno->teachers()->attach($id);
    }

    public function deactivateRecordInAnnoAction($id)
    {
        $anno=getUserAnnoSession();
        $anno->teachers()->detach($id);
    }

    /* Filters */

    public function eventSubjectFilterLevel($level_id)
    {
        $this->level_id=$level_id;
        if ($level_id=='*')
        {
            $datafiltered=getUserAnnoSession()->schoolGrades();
        }
        else
        {
            $datafiltered=SchoolLevel::find($level_id)->grades();
        }
        $this->createSubjectsFilter();
        $newoptions=LopHelp::getFilterDropdownBuilder($datafiltered, 'id', 'grade', '', true, '');
        $this->emit('setoptions','subjectfiltergradecomponent',$newoptions);

    }

    public function eventSubjectFilterGrade($grade_id)
    {
        $this->grade_id=$grade_id;
        $this->createSubjectsFilter();
    }

    public function eventSubjectFilterPeriod($period_id)
    {
        $this->period_id=$period_id;
        $this->createSubjectsFilter();
    }

    public function createSubjectsFilter()
    {
        $this->filtersubjects='';

        // LEVELS

        if ($this->level_id=='*')
        {
            $datafiltered=getUserAnnoSession()->schoolGrades();
        }
        else
        {
            $datafiltered=SchoolLevel::find($this->level_id)->grades();
        }
        foreach($datafiltered->get() as $item)
        {
            if ($this->filtersubjects!='') $this->filtersubjects.=' or ';
            $this->filtersubjects.=' grade_id='.$item->id.' ';
        }

        // GRADES

        if ($this->grade_id!='*')
        {
            $this->filtersubjects="grade_id=".$this->grade_id;
        }

        // PERIODS

        if ($this->period_id!='*')
        {
            $this->filtersubjects='('.$this->filtersubjects.') and period_id='.$this->period_id;
        }

        $anno=getUserAnnoSession();
        $this->subjects=$anno->belongsToMany(SchoolSubject::class)->active()->available()->withPivot(['grade_id','period_id','priority','available'])->orderBy('grade_id');
        $this->subjects=$this->subjects->whereRaw( $this->filtersubjects )->get();


    }



}
