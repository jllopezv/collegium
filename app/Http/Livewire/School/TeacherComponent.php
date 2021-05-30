<?php

namespace App\Http\Livewire\School;

use Livewire\Component;
use App\Models\Crm\Employee;
use Livewire\WithPagination;
use App\Models\School\Teacher;
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
        // Userprofile
        $this->userProfileClear();
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



}
