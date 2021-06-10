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
    public $withoutteacher=true;
    public $showSubjectsDialog=false;
    public $subjects_list=null;

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
        $this->subjects_list=collect([]);

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

        /*
        $anno=getUserAnnoSession();
        $subjectsdata=DB::table('anno_school_subject_teacher')->where('anno_id', $anno->id)
            ->where('teacher_id', $this->record->id);

        $this->subjects_id_selected=collect($subjectsdata->pluck('school_subject_id'));
        $this->subjects_selected=$anno->belongsToMany(SchoolSubject::class)->active()->available()->withPivot(['grade_id','period_id','priority','available'])->orderBy('grade_id')->whereIn('school_subject_id', $this->subjects_id_selected )->get();
        */
        $this->loadSubjects();
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

    public function postStore($storedRecord)
    {
        $this->userProfileSaveUser($storedRecord, $this->teacher, 'teacher');

        $this->syncSubjects($storedRecord->id);
        $this->loadSubjects();

        $this->showSubjectsDialog=false;
    }

    public function postUpdate($updatedRecord)
    {
        // Update user
        $this->userProfileUpdateUser($updatedRecord);

        $this->syncSubjects($updatedRecord->id);
        $this->loadSubjects();

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

    /** Events */

    public function updatedSearch()
    {
        $this->createSubjectsFilter();
    }

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

        // Search



        $anno=getUserAnnoSession();
        $this->subjects=$anno->belongsToMany(SchoolSubject::class)->active()->available()->withPivot(['grade_id','period_id','priority','available'])->orderBy('grade_id');
        $subjectsbuilder=$this->subjects->whereRaw( $this->filtersubjects );
        $this->subjects=$subjectsbuilder->get();
        if ($this->search!='')
        {
            $search=$this->search;
            $this->subjects=SchoolSubject::whereIn('id', $subjectsbuilder->pluck('id'))->search($this->search)->get();
        }
    }

    /* Subjects Support */

    public function createSubjectsListItem($anno_school_subject_teacher_id, $subject_id)
    {
        $obj=SchoolSubject::find($subject_id);
        $this->subjects_list->push([
            'id'            => $anno_school_subject_teacher_id,
            'subject'       => [
                'id'            =>  $obj->id,
                'subject'       =>  $obj->subject,
                'code'          =>  $obj->code,
                'grade'         =>  $obj->grade->grade,
                'period'        =>  $obj->period->period,
                'coordinator'   =>  $obj->coordinator??0,
            ]
        ]);

    }

    public function loadSubjects()
    {
        $this->subjects_list=collect([]);

        $anno=getUserAnnoSession();
        $subjects=DB::table('anno_school_subject_teacher')->where('anno_id', $anno->id)
            ->where('teacher_id', $this->recordid)->get();
        foreach($subjects as $item)
        {
            $this->createSubjectsListItem($item->id, $item->school_subject_id);
        }
    }

    public function deleteSubject( $index )
    {
        $this->subjects_list->pull($index);
    }

    public function selectSubject($id)
    {
        $this->search='';
        if (!$this->subjects_list->pluck('subject.id')->contains($id))
        {
            $this->createSubjectsListItem(0,$id);
        }
    }

    public function setCoordinator($subject_id)
    {
        $subject=$this->subjects_list->where('subject.id', $subject_id)->first();
        if ($subject==null) return;
        $changedvalue=1-$subject['subject']['coordinator'];
        $key=$this->subjects_list->where('subject.id', $subject_id)->keys()->first();
        $replaced=$this->subjects_list->replace( [ $key => [
                'id'            => $subject['id'],
                'subject'       => [
                    'id'            =>  $subject['subject']['id'],
                    'code'          =>  $subject['subject']['code'],
                    'subject'       =>  $subject['subject']['subject'],
                    'grade'         =>  $subject['subject']['grade'],
                    'period'        =>  $subject['subject']['period'],
                    'coordinator'   =>  $changedvalue,
                ]
        ]]);

        $this->subjects_list=$replaced;

    }

    public function syncSubjects($teacher_id=null)
    {

        if ($teacher_id==null) return;

        $anno=getUserAnnoSession();
        $subjectstodelete=DB::table('anno_school_subject_teacher')->where('anno_id', $anno->id)
        ->where('teacher_id', $teacher_id)->whereNotIn('school_subject_id',$this->subjects_list->pluck('subject.id'));
        $subjectstodelete->delete();
        foreach($this->subjects_list as $item)
        {
            if ($item['id']==0)
            {
                // Create row
                DB::table('anno_school_subject_teacher')->insert([
                    'anno_id'               =>  $anno->id,
                    'school_subject_id'     =>  $item['subject']['id'],
                    'teacher_id'            =>  $teacher_id,
                    'coordinator'           =>  $item['subject']['coordinator'],
                ]);
            }
            else
            {
                // Update
                DB::table('anno_school_subject_teacher')->where('id', $item['id'])->update([
                    'anno_id'               =>  $anno->id,
                    'school_subject_id'     =>  $item['subject']['id'],
                    'teacher_id'            =>  $teacher_id,
                    'coordinator'           =>  $item['subject']['coordinator'],
                ]);
            }
        }

    }



}
