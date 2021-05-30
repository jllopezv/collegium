<?php

namespace App\Http\Livewire\Crm;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Aux\Country;
use App\Models\Crm\Employee;
use Livewire\WithPagination;
use App\Models\Crm\EmployeeEmail;
use App\Models\Crm\EmployeePhone;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\HasAvatar;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\IsUserType;
use App\Http\Livewire\Traits\HasPriority;
use Illuminate\Support\Facades\Validator;
use App\Http\Livewire\Traits\HasAvailable;
use App\Http\Livewire\Traits\HasDocuments;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAnnoSupport;
use App\Http\Livewire\Traits\WithUserProfile;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class EmployeeComponent extends Component
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
    use HasAvatar;

    /* Anno Support */
    use HasPriority;
    use HasAvailable;
    use WithAnnoSupport;

    /* Documents */
    use HasDocuments;

    public $employee;
    public $address1;
    public $address2;
    public $city;
    public $state;
    public $country_id;
    public $pbox;
    public $notes;
    public $phones=[];
    public $emails=[];
    public $age;
    public $birth;
    public $hired;
    public $degree;
    public $salary;
    public $employee_type_id;

    /* Avatar */
    private $avatarfolder='employees-photos';
    public  $avatar;
    public  $profile_photo_path;

    public $emailcomponent='employeesemails'; // Emails component name

    public $phone=[
        'id'            =>  0,
        'phone'         =>  '',
        'description'   =>  '',
    ];
    public $email=[
        'id'            =>  0,
        'email'         =>  '',
        'description'   =>  '',
        'notif'         =>  1,
    ];


    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',
        'eventsetcountry'       => 'eventSetCountry',
        'eventsettype'          => 'eventSetType',
        'eventsetphones'        => 'eventSetPhones',
        'eventsetuserprofileemail' => 'eventSetUserProfileEmail',
        'eventsetbirth'         => 'eventSetBirth',

        /* Anno Support */
        'activateRecordInAnnoAction' => 'activateRecordInAnnoAction',
        'deactivateRecordInAnnoAction' => 'deactivateRecordInAnnoAction',

        /* Dates */
        'eventsetbirth'         => 'eventSetBirth',
        'eventsethired'         => 'eventSetHired',

        /* Avatar */
        'avatarupdated'         => 'avatarUpdated',

        // UserProfile
        'eventEmailsTableUpdatedEmails'     => 'eventSetEmails',

        /* Filters */
        'eventfiltertype'     => 'eventFilterType',

        /* Documents */
        'document-documentadded'      => 'documentAdded',
        'document-documentupdated'    => 'documentUpdated',
        'document-documentdeleted'    => 'documentDeleted',
        'document-refresh'            => 'documentRefresh',


    ];

    /**
     * Mount function
     *
     * @return void
     */
    public function mount()
    {
        $this->table='employees';
        $this->module='crm';
        $this->commonMount();
        $this->multiple=true;

        // Default order for table
        $this->sortorder='id';
        if ($this->mode=='create')
        {
            // default create options
            $this->loadDefaults();
            $this->phones[]=$this->phone;
            $this->emails[]=$this->email;
        }

        /* Avatar */
        $this->avatar_prefix='employee';

        // Filter and sorts
        $this->canShowFilterButton=true;

        // Documents
        $this->documentscomponent='document-employees';
        $this->documents_root='documents/employees';


   }

    /**
     * Rules to validate model
     *
     * @return array
     */
    public function validateRules() : array
    {
        return [
            'employee'              => 'required|string|max:255',//|unique:school_levels,level,'.$this->recordid,
            'employee_type_id'      => 'required|exists:employee_types,id',
            'address1'              => 'nullable|string|max:255',
            'address2'              => 'nullable|string|max:255',
            'city'                  => 'nullable|string|max:255',
            'state'                 => 'nullable|string|max:255',
            'pbox'                  => 'nullable|string|max:255',
            'notes'                 => 'nullable|string|max:1024',
            'degree'                => 'nullable|string|max:255',
            'salary'                => 'nullable|string|max:255',
        ];
    }

    public function loadDefaults()
    {
        $this->country_id=Auth::user()->country_id??(Country::where('country',config('lopsoft.country_default'))->first())->id??null;
        $this->emit('setvalue', 'countrycomponent', $this->country_id );
        $this->birth=getDateFromDate(1974,1,1);
        $this->emit('setvalue', 'birthcomponent', getDateString($this->birth));
        $this->hired=Carbon::now();
        $this->emit('setvalue', 'hiredcomponent', getDateString($this->hired));

        $this->degree='';
        $this->salary='0.0';

        $anno=getUserAnnoSession();
        $employees=$anno->employees;
        $this->priority=max(count($employees), $employees->max('pivot.priority'))+1;

        // Userprofile
        $this->userProfileClear();
    }

    public function resetForm()
    {
        $this->employee='';
        $this->address1='';
        $this->address2='';
        $this->city='';
        $this->state='';
        $this->pbox='';
        $this->notes='';
        $this->profile_photo_path=null;
        $this->phones=[];
        $this->phones[]=$this->phone;
        $this->emails=[];
        $this->emails[]=$this->email;
        $this->loadDefaults();
        $this->emit('setphones','employeesphones' , $this->phones);
        $this->emit('setemails','employeesemails' , $this->emails);
        $this->resetAvatar();
    }

    public function loadRecordDef()
    {
        $this->employee=$this->record->employee;
        $this->address1=$this->record->address1;
        $this->address2=$this->record->address2;
        $this->city=$this->record->city;
        $this->state=$this->record->state;
        $this->pbox=$this->record->pbox;
        $this->notes=$this->record->notes;
        $this->birth=$this->record->birth;
        $this->hired=$this->record->hired;
        $this->degree=$this->record->degree;
        $this->salary=$this->record->salary;
        $this->avatar=$this->record->avatar;
        $this->profile_photo_path=$this->record->profile_photo_path;
        $this->employee_type_id=$this->record->employee_type_id;
        $this->phones=getPhones($this->record->phones);
        $this->emails=getEmails($this->record->emails);

        // User Profile
        $this->userProfileLoadRecord($this->record, $this->emails);


    }


    public function getKeyNotification($record)
    {
        return ($record->employee);
    }

    /**
     * Validate only some fields
     *
     * @return void
     */
    public function validateFields()
    {
        return [
            'employee'               => $this->employee,
            'employee_type_id'       => $this->employee_type_id,
            'address1'               => $this->address1,
            'address2'               => $this->address2,
            'city'                   => $this->city,
            'state'                  => $this->state,
            'pbox'                   => $this->pbox,
            'notes'                  => $this->notes,
            'degree'                 => $this->degree,
            'salary'                 => $this->salary,
            'profile_photo_path'     => $this->profile_photo_path,

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
            'employee'               => $this->employee,
            'address1'               => $this->address1,
            'address2'               => $this->address2,
            'city'                   => $this->city,
            'state'                  => $this->state,
            'pbox'                   => $this->pbox,
            'notes'                  => $this->notes,
            'country_id'             => $this->country_id,
            'employee_type_id'       => $this->employee_type_id,
            'birth'                  => $this->birth,
            'hired'                  => $this->hired,
            'degree'                 => $this->degree,
            'salary'                 => $this->salary,
            'profile_photo_path'     => $this->profile_photo_path,
            'hired'                  => $this->hired,
            'birth'                  => $this->birth,
       ];
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
        if ($this->deletingRecordAnno($record))
        {
            return $this->deleteAvatar($record);
        }
        return false;
    }


    public function eventSetCountry($country, $change)
    {
        $this->country_id=$country;
    }

    public function eventSetType($type_id, $change)
    {
        $this->employee_type_id=$type_id;
    }

    public function customValidation()
    {
        $haserrorsemails=false;
        $haserrorsphones=false;
        $haserrors=false;
        foreach($this->emails as $email)
        {
            if ($email['email']!='')
            {
                $validator=Validator::make(
                    [ 'email' =>  $email['email'] ],
                    [ 'email'   =>  'required|email' ],
                );
                if ($validator->fails())
                {
                    $this->addError('email_'.$email['email'], 'EL EMAIL '.$email['email'].' NO ES VÁLIDO');
                    $this->addError('useremail', 'EL EMAIL '.$email['email'].' NO ES VÁLIDO');
                    $haserrorsemails=true;
                }
            }
        }
        foreach($this->phones as $phone)
        {
            if ($phone['phone']!='')
            {
                $validator=Validator::make(
                    ['phone'    =>  $phone['phone'] ],
                    ['phone'    =>  'required|string|max:255' ],
                );
                if ($validator->fails())
                {
                    $this->addError('phone_'.$phone['phone'], 'EL TELÉFONO '.$phone['phone'].' NO ES VÁLIDO');
                    $this->addError('phone', 'EL TELÉFONO '.$phone['phone'].' NO ES VÁLIDO');
                    $haserrorsphones=true;
                }
            }
        }
        if ($haserrorsemails)
        {
            $this->ShowError('HAY EMAILS QUE NO SON VÁLIDOS');
        }
        if ($haserrorsphones)
        {
            $this->ShowError('HAY TELÉFONOS QUE NO SON VÁLIDOS');
        }

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
        // Create Phones
        foreach($this->phones as $phone)
        {
            if ($phone['phone']!='')
            {
                EmployeePhone::create([
                    'phone'             => $phone['phone'],
                    'description'       => $phone['description'],
                    'employee_id'       => $recordStored->id,
                ]);
            }
        }
        // Create Emails
        foreach($this->emails as $email)
        {
            if ($email['email']!='')
            {
                EmployeeEmail::create([
                    'email'             => $email['email'],
                    'description'       => $email['description'],
                    'notif'             => $email['notif'],
                    'employee_id'       => $recordStored->id,
                ]);
            }
        }

        $this->userProfileSaveUser($recordStored, $this->employee, 'employee');

    }

    public function postUpdate($recordUpdated)
    {
        // Update Phones
        foreach($this->phones as $phone)
        {
            if ($phone['phone']!='')
            {
                if ($phone['id']!=0)
                {
                    EmployeePhone::where('id',$phone['id'])->update([
                        'phone'             => $phone['phone'],
                        'description'       => $phone['description'],
                        'employee_id'       => $recordUpdated->id,
                    ]);
                }
                else
                {
                    EmployeePhone::create([
                        'phone'             => $phone['phone'],
                        'description'       => $phone['description'],
                        'employee_id'       => $recordUpdated->id,
                    ]);
                }

            }
        }
        // Update Emails
        foreach($this->emails as $email)
        {
            if ($email['email']!='')
            {
                if ($email['id']!=0)
                {
                    EmployeeEmail::where('id',$email['id'])->update([
                        'email'             => $email['email'],
                        'description'       => $email['description'],
                        'notif'             => $email['notif'],
                        'employee_id'       => $recordUpdated->id,
                    ]);
                }
                else
                {
                    EmployeeEmail::create([
                        'email'             => $email['email'],
                        'description'       => $email['description'],
                        'notif'             => $email['notif'],
                        'employee_id'       => $recordUpdated->id,
                    ]);
                }

            }
        }

        // Update user
        $this->userProfileUpdateUser($recordUpdated);

    }


    public function eventSetPhones($phones)
    {
        $this->phones=$phones;
    }

    public function eventSetEmails($emails)
    {
        $this->emails=$emails;
        $this->userProfileSetEmails($emails);
    }

    public function getProfileUsername()
    {
        $parts=explode(' ',$this->employee);
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

    public function eventSetHired($date)
    {
        if ($date!=null)
        {
            $this->hired=getDateFromFormat($date);
        }
    }

    /**
     * Filters
     */

    public function eventFilterType($type_id)
    {
        $this->type_id=$type_id;
        $this->filterdata='';

        if ($this->type_id!='*')
        {
            $this->filterdata=' employee_type_id='.$type_id;
        }
    }

    public function setDataFilter()
    {

        if ($this->filterdata!='')
        {

            $this->data->whereRaw( $this->filterdata );
        }
    }


    /**
     * Anno Support
     */

    public function forceGetQueryData($ret)
    {

        if ($this->showOnlyAnno)
        {
            $subset=getUserAnnoSession()->employees();
        }
        else
        {
            $subset=Employee::query();
            $this->resetFilter();
        }
        return $this->annoSupportForceGetQueryData($ret, $subset );
    }

    public function activateRecordInAnnoAction($id)
    {
        $anno=getUserAnnoSession();
        $item=$this->model::find($id);
        $anno->employees()->attach($id);
    }

    public function deactivateRecordInAnnoAction($id)
    {
        $anno=getUserAnnoSession();
        $anno->employees()->detach($id);
    }


}
