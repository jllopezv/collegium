<?php

namespace App\Http\Livewire\School;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\School\Student;
use App\Http\Livewire\Traits\HasAvatar;
use App\Http\Livewire\Traits\HasCommon;
use Illuminate\Support\Facades\Session;
use App\Http\Livewire\Traits\IsUserType;
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
    use IsUserType;

    public  $exp;
    public  $names;
    public  $first_surname;
    public  $second_surname;
    public  $email;
    public  $birth;
    public  $age;
    public  $gender;
    public  $avatar;
    public  $profile_photo_path;
    public  $grade_id;



    private $avatarfolder='students-photos';


    public  $studentname;
    public  $username;
    public  $checkedEmail=false;
    public  $validEmail=false;


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
        'eventsetgrade'         => 'eventSetGrade',
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
        $this->commonSaveAnnoSession=false;
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
            'email'             => 'required|email|max:255|unique:users,email'.($this->mode!='create'?','.$this->record->user->id:''),
            // 'gender'            => 'required'

        ];
    }

    public function loadDefaults()
    {
        $this->gender='M';
        $this->emit('setvalue', 'gendercomponent', $this->gender);
        $this->birth=getDateFromDate(2000,1,1);
        $this->emit('setvalue', 'birthcomponent', getDateString($this->birth));
        $this->grade_id=null;
        $this->emit('setvalue', 'gradecomponent', $this->grade_id);
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
        $this->avatar=null;
        $this->email='';
        $this->checkedEmail=false;
        $this->validEmail=false;
        $this->username='';
        $this->studentname='';
        $this->loadDefaults();
        $this->resetAvatar();
        $this->grade_id=null;
        $this->emit('setvalue', 'gradecomponent', $this->grade_id);

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
        $this->studentname=$this->getStudentName();
        $this->email=$this->record->user->email;
        $this->username=$this->record->user->username;
        $this->avatar=$this->record->avatar;

        $this->emit('setvalue', 'gradecomponent', $this->grade_id);


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
            'email'                 =>  $this->email,
        ];
    }


    public function updated()
    {
        $this->studentname=$this->getStudentName();
        $this->username=$this->getProfileUsername();
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

    public function eventSetGrade($grade_id)
    {
        $this->grade_id=$grade_id;
    }

    public function canUpdate()
    {
        return $this->saveAvatar();
    }

    public function canStore()
    {
        if ($this->saveAvatar()==false) return false;
        if (!$this->validateUserProfile())
        {
            $this->checkFlashErrors();
            return false;
        }
        return true;
    }

    public function beforeGoBack()
    {
        $this->deleteTemp();
    }

    public function deletingRecord($record)
    {
        return $this->deleteAvatar($record);
    }

    public function getProfileUsername()
    {
        $username=Str::of($this->names)->before(' ').(Str::of($this->names)->contains(' ')?Str::of($this->names)->after(' '):'').$this->first_surname;
        $username=str_replace(' ','',$username);
        return mb_strtolower( withoutAccents($username) );
    }

    public function getProfileName()
    {
        $name=Str::title($this->names.' '.$this->first_surname.' '.$this->second_surname);
        return $name;
    }

    public function getStudentName()
    {
        return $this->first_surname." ".$this->second_surname.", ".$this->names;
    }

    public function customStoreValidation()
    {
        if ($this->grade_id==null)
        {
            $this->addError('grade_id', 'DEBE SELECCIONAR UN GRADO');
            $this->emit('validationerror',$this->getErrorBag());
            $this->showFlashError($this->flashmessageid,"ERROR EN LOS DATOS");
            return false;
        }
        return true;
    }

    public function postStore($recordStored)
    {
        $user=$this->getUserProfileCredentials();
        $userprofile=User::createProfileUser($user->name, $user->username, $user->email, config('lopsoft.users_defaultpassword'), 'student' );
        if ($userprofile==null)
        {
            $this->checkFlashErrors();
            return;
        }
        else
        {
            $userprofile->profile_photo_path=$this->profile_photo_path;
            $recordStored->user()->save($userprofile);
        }

        // Enroll
        $recordStored->enroll($this->grade_id);
    }

    public function postUpdate($recordUpdated)
    {
        $userprofile=$this->record->user;
        if ($userprofile!=null)
        {
            $userprofile->username=$this->username;
            $userprofile->name=$this->getProfileName();
            $userprofile->email=$this->email;
            if ($userprofile->profile_photo_path==null) $userprofile->profile_photo_path=$this->profile_photo_path;
            $userprofile->save();

        }

        // Enroll
        $recordUpdated->enroll($this->grade_id);
    }

    public function generateEmail()
    {

        if ($this->names=='')
        {
            $this->ShowError("NO SE DEFINIÓ NINGÚN NOMBRE");
            return;
        }
        $suggest=$this->getProfileUsername();
        $this->email=generateAppEmail($suggest);
    }

    public function updatedEmail()
    {
        if (!Str::of($this->email)->contains('@') || $this->email=='' || ( Str::of($this->email)->contains('@') && Str::of($this->email)->after('@')=='') )
        {
            $this->checkedEmail=false;
            return;
        }
        $user=User::where('email', $this->email)->first();
        $this->checkedEmail=true;
        $this->validEmail=$user==null?true:false;

        $this->email=mb_strtolower($this->email);
    }

    public function preStore()
    {
        $this->updatedEmail();
    }

    public function preUpdate()
    {
        $this->updatedEmail();
    }

    /**
     * Entry point to delete action
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $this->showConfirm("error","¿SEGURO QUE DESEA BORRAR EL ESTUDIANTE? <br/><br/>¡¡ATENCIÓN!!<br/><b>BORRARÁ TAMBIÉN EL USUARIO ASOCIADO</b>","BORRAR ESTUDIANTE","deleteRecord","close","$id");
    }
}
