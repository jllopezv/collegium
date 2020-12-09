<?php

namespace App\Http\Livewire\School;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\School\Student;
use App\Http\Livewire\Traits\HasAvatar;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class StudentComponent extends Component
{
    use WithPagination;
    use HasCommon;
    use HasAvatar;
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;

    public  $exp;
    public  $names;
    public  $first_surname;
    public  $second_surname;
    public  $birth;
    public  $age;
    public  $gender;
    public  $avatar;
    public  $profile_photo_path;
    private $avatarfolder='students-photos';

    public  $name;


    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',
        'avatar_updated'        => 'avatarUpdated',
        'eventsetbirth'         => 'eventSetBirth',
        'eventsetgender'        => 'eventSetGender',
    ];

    /**
     * Mount function
     *
     * @return void
     */
    public function mount()
    {
        $this->table='students';
        $this->module='school';
        $this->avatar_prefix='student';
        $this->commonMount();
        $this->multiple=true;
        // Default order for table
        $this->sortorder='exp';
        $this->flashmessageid='studentsaved';
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
            'exp'               => 'required|string|max:255|unique:students,exp,'.$this->recordid,
            'names'             => 'required|string|max:255',
            'first_surname'     => 'required|string|max:255',
            'second_surname'    => 'required|string|max:255',
            'birth'             => 'required|date',
            // 'gender'            => 'required'

        ];
    }

    public function loadDefaults()
    {
        $this->gender='M';
        $this->emit('setvalue', 'gendercomponent', $this->gender);
        $this->birth=getDateFromDate(2000,1,1);
        $this->emit('setvalue', 'birthcomponent', getDateString($this->birth));
    }

    public function resetForm()
    {
        $this->exp='';
        $this->names='';
        $this->first_surname='';
        $this->second_surname='';
        $this->birth='';
        $this->gender='';
        $this->profile_photo_path=null;
        $this->loadDefaults();
        $this->emit('avatarreset');
    }

    public function loadRecordDef()
    {
        $this->exp=$this->record->exp;
        $this->names=$this->record->names;
        $this->first_surname=$this->record->first_surname;
        $this->second_surname=$this->record->second_surname;
        $this->profile_photo_path=$this->record->profile_photo_path;
        $this->birth=$this->record->birth;
        $this->gender=$this->record->gender;
        $this->name=$this->record->name;
        $this->avatar=$this->record->avatar;

    }

    public function getKeyNotification($record)
    {
        return ($record->name);
    }

    /**
     * Save or Update record data
     *
     * @return void
     */
    public function saveRecord()
    {
        return [
            'exp'                   =>  $this->exp,
            'profile_photo_path'    =>  $this->profile_photo_path,
            'names'                 =>  $this->names,
            'first_surname'         =>  $this->first_surname,
            'second_surname'        =>  $this->second_surname,
            'birth'                 =>  $this->birth,
            'gender'                =>  $this->gender,
        ];
    }


    public function updated()
    {
        $record=new Student;
        $record->names=$this->names;
        $record->first_surname=$this->first_surname;
        $record->second_surname=$this->second_surname;
        $record->profile_photo_path=$this->profile_photo_path;
        $this->name=$record->name;
    }

    public function eventSetBirth($date)
    {
        if ($date!=null)
        {
            $this->birth=getDateFromFormat($date);
            $this->birth->hour(0);
            $this->birth->minute(0);
            $this->birth->second(0);
            $this->age=getAge($this->birth);
        }

    }

    public function eventSetGender($gender)
    {
        $this->gender=$gender;

    }

    public function canUpdate()
    {
        return $this->saveAvatar();
    }

    public function canStore()
    {
        return $this->saveAvatar();
    }

    public function beforeGoBack()
    {
        $this->deleteTemp();
    }

    public function deleting($record)
    {
        return $this->deleteAvatar($record);
    }

}
