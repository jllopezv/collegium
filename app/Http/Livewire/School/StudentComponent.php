<?php

namespace App\Http\Livewire\School;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Lopsoft\LopHelp;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\School\Student;
use App\Models\School\SchoolGrade;
use App\Models\School\SchoolParent;
use App\Http\Livewire\Traits\HasAvatar;
use App\Http\Livewire\Traits\HasCommon;
use Illuminate\Support\Facades\Session;
use App\Http\Livewire\Traits\IsUserType;
use App\Http\Livewire\Traits\HasPriority;
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
    use HasPriority;

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
    public  $section_id;
    public  $batch_id;
    public  $modality_id;

    private $avatarfolder='students-photos';


    public  $studentname;
    public  $username;
    public  $checkedEmail=false;
    public  $validEmail=false;
    public  $infoParent=null;

    // Filters

    public $filtergrade='';
    public $filtersection='';
    public $filterbatch='';
    public $filtermodality='';

    // others

    public $showParents=false;
    public $selectedParent=false;
    public $relationship;
    public $schoolparent=null;
    public $infoParentArray=[];

    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',
        'avatarupdated'         => 'avatarUpdated',
        'eventsetbirth'         => 'eventSetBirth',
        'eventsetgender'        => 'eventSetGender',
        'eventsetgrade'         => 'eventSetGrade',
        'eventsetsection'       => 'eventSetSection',
        'eventsetbatch'         => 'eventSetBatch',
        'eventsetmodality'      => 'eventSetModality',
        'eventfiltergrade'      => 'eventFilterGrade',
        'eventfiltersection'    => 'eventFilterSection',
        'eventfilterbatch'      => 'eventFilterBatch',
        'eventfiltermodality'   => 'eventFilterModality',
        'eventfilterorder'      => 'eventFilterOrder',
        'parentselected'        => 'parentSelected',
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
        $this->sortorder='grade_id';
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
            'priority'          => 'required|numeric',
            'email'             => 'required|email|max:255|unique:users,email'.($this->mode!='create'?','.$this->record->user->id:''),
            'grade_id'          => 'required',
            'section_id'        => 'required',
            'batch_id'          => 'required',
            'modality_id'       => 'required',

        ];
    }

    /**
     * Validate only some fields
     *
     * @return void
     */
    public function validateFields()
    {
        // Its necessary because validated fields are not equal to saveRecord fields
        return [
            'exp'                   =>  $this->exp,
            'profile_photo_path'    =>  $this->profile_photo_path,
            'names'                 =>  $this->names,
            'first_surname'         =>  $this->first_surname,
            'second_surname'        =>  $this->second_surname,
            'birth'                 =>  $this->birth,
            'gender'                =>  $this->gender,
            'email'                 =>  $this->email,
            'priority'              =>  $this->priority,
            'grade_id'              =>  $this->grade_id,
            'section_id'            =>  $this->section_id,
            'batch_id'              =>  $this->batch_id,
            'modality_id'           =>  $this->modality_id,
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
        $this->priority=$this->record->priority;
        $this->emit('setvalue', 'gradecomponent', $this->grade_id);

        if ($this->record!=null)
        {
            $this->selectInfoParent();
        }
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

    public function eventSetGrade($grade_id, $change)
    {
        $this->grade_id=$grade_id;
        if ($this->mode=='create')
        {
            $grade=SchoolGrade::find($this->grade_id);
            if ($grade==null)
            {
                $this->priority=1;
                return;
            }
            $this->priority=count($grade->students())+1;

        }

        if ($change==true)
        {
            // Set filterraw para section
            $this->emit('setfilterraw','sectioncomponent','grade_id='.$grade_id);

        }
    }

    public function eventSetSection($section_id)
    {
        $this->section_id=$section_id;
    }

    public function eventSetBatch($batch_id)
    {
        $this->batch_id=$batch_id;
    }

    public function eventSetModality($modality_id)
    {
        $this->modality_id=$modality_id;
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
        $this->updatedEmail();
        if ($this->grade_id==null)
        {
            $this->addError('grade_id', 'DEBE SELECCIONAR UN GRADO');
            $this->emit('validationerror',$this->getErrorBag());
            $this->showFlashError($this->flashmessageid,"ERROR EN LOS DATOS");
            return false;
        }
        return true;
    }

    public function customUpdateValidation()
    {
        $this->updatedEmail();
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
        $recordStored->enroll([
            'priority'      =>   $this->priority,
            'grade_id'      =>   $this->grade_id,
            'section_id'    =>  $this->section_id,
            'batch_id'      =>  $this->batch_id,
            'modality_id'   =>  $this->modality_id,
        ]);
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

        // Update Enroll
        $recordUpdated->updateEnroll([
            'priority'      =>   $this->priority,
            'grade_id'      =>   $this->grade_id,
            'section_id'    =>  $this->section_id,
            'batch_id'      =>  $this->batch_id,
            'modality_id'   =>  $this->modality_id,
        ]);
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
        $this->email=mb_strtolower($this->email);
        $user=User::where('email', $this->email)->first();
        $this->checkedEmail=true;
        if ($user==null)
        {
            $this->validEmail=true;
            return;
        }
        if ( $this->mode=='edit' && $user->profile!=null && $user->profile->id==$this->record->id)
        {
            $this->validEmail=true;
        }
        else
        {
            $this->validEmail=$user==null?true:false;
        }
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

    public function eventFilterGrade($grade_id)
    {
        $this->filterdata='';
        if ($grade_id=='*')
        {
            $this->filtergrade='';
        }
        else
        {
            $this->filtergrade="anno_student.grade_id=".$grade_id;
        }
        if ($grade_id=='*')
        {
            $newoptions=\App\Lopsoft\LopHelp::getFilterDropdownBuilder(getUserAnnoSession()->schoolSections(), 'id', 'section', '', true, '');
        }
        else
        {
            $newoptions=LopHelp::getFilterDropdownBuilder(SchoolGrade::find($grade_id)->sections(), 'id', 'section', '', true, '');
        }
        $this->emit('setoptions','filtersectioncomponent',$newoptions);
    }

    public function eventFilterSection($section_id)
    {
        $this->filterdata='';
        if ($section_id=='*')
        {
            $this->filtersection='';
        }
        else
        {
            $this->filtersection="anno_student.section_id=".$section_id;
        }
    }

    public function eventFilterBatch($batch_id)
    {
        $this->filterdata='';
        if ($batch_id=='*')
        {
            $this->filterbatch='';
        }
        else
        {
            $this->filterbatch="anno_student.batch_id=".$batch_id;
        }
    }

    public function eventFilterModality($modality_id)
    {
        $this->filterdata='';
        if ($modality_id=='*')
        {
            $this->filtermodality='';
        }
        else
        {
            $this->filtermodality="anno_student.modality_id=".$modality_id;
        }
    }

    public function setDataFilter()
    {
        if ($this->filtergrade!='' || $this->filtersection!='' || $this->filterbatch!='' || $this->filtermodality!='')
        {
            if ($this->filtergrade!='')
            {
                $this->filterdata=$this->filtergrade;
            }
            if ($this->filtersection!='')
            {
                if ($this->filterdata!='')
                {
                    $this->filterdata.=' and ';
                }
                $this->filterdata.=$this->filtersection;
            }
            if ($this->filterbatch!='')
            {
                if ($this->filterdata!='')
                {
                    $this->filterdata.=' and ';
                }
                $this->filterdata.=$this->filterbatch;
            }
            if ($this->filtermodality!='')
            {
                if ($this->filterdata!='')
                {
                    $this->filterdata.=' and ';
                }
                $this->filterdata.=$this->filtermodality;
            }

            $this->data->whereRaw($this->filterdata);
            //if ($this->filtergrade!='' && $this->filtersection!="") dd($this->data->get());
        }
    }

    public function findRecordBuilder()
    {
        // Special find cause it has pivot fields like grade_id, section_id, batch_id, modality_id
        $anno=getUserAnnoSession();
        return $anno->students->where('id' , $this->recordid)->first();
    }

    public function eventFilterOrder($field, $change)
    {
        if ($change)
        {

            if ($this->sortorder==$field)
            {
                $this->sortorder='-'.$field;
            }
            else
            {
                $this->sortorder=$field;
            }

            $this->refreshDatatable();
        }
    }

    public function showParentsDialog()
    {
        $this->showParents=true;
    }
    public function parentSelected($id)
    {
        $this->showParents=false;
        $this->selectedParent=true;
        $this->schoolparent=SchoolParent::find($id);
    }

    public function cancelAssign()
    {
        $this->emit('setvalue', 'searchschoolparentcomponent', '');
        $this->showParents=false;
        $this->selectedParent=false;
        $this->schoolparent=null;
        $this->relationship='';
    }

    public function assignParent()
    {

    }

    public function selectInfoParent($id=null)
    {
        if ($id==null)
        {
            $this->infoParent=$this->record->parents()->withPivot('relationship')->first();
        }
        else
        {
            $this->infoParent=$this->record->parents()->withPivot('relationship')->where('school_parent_id',$id)->first();
        }
        if ($this->infoParent!=null)
        {
            $this->infoParentArray=$this->infoParent->toArray();
            $this->emit('setphones','parentsphones', $this->infoParent->phones);
            $this->emit('setemails','parentsemails', $this->infoParent->emails);
        }
    }

}
