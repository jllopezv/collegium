<?php

namespace App\Http\Livewire\School;

use App\Models\User;
use Livewire\Component;
use App\Models\Aux\Country;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\School\Student;
use App\Models\School\ParentEmail;
use App\Models\School\ParentPhone;
use App\Models\School\SchoolParent;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\IsUserType;
use Illuminate\Support\Facades\Validator;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithUserProfile;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class SchoolParentComponent extends Component
{
    use WithPagination;
    use HasCommon;
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;
    use IsUserType;
    use WithUserProfile;

    public $parent;
    public $address1;
    public $address2;
    public $city;
    public $state;
    public $country_id;
    public $pbox;
    public $notes;
    public $phones=[];
    public $emails=[];
    public $students=[];
    public $studentsnotenrolled=[];

    public $emailcomponent='parentsemails'; // Emails component name

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
        'eventsetphones'        => 'eventSetPhones',
        'eventsetuserprofileemail' => 'eventSetUserProfileEmail',

        // UserProfile
        'eventEmailsTableUpdatedEmails'     => 'eventSetEmails',
    ];

    /**
     * Mount function
     *
     * @return void
     */
    public function mount()
    {
        $this->table='school_parents';
        $this->module='school';
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


   }

    /**
     * Rules to validate model
     *
     * @return array
     */
    public function validateRules() : array
    {
        return [
            'parent'                => 'required|string|max:255',//|unique:school_levels,level,'.$this->recordid,
            'address1'              => 'nullable|string|max:255',
            'address2'              => 'nullable|string|max:255',
            'city'                  => 'nullable|string|max:255',
            'state'                 => 'nullable|string|max:255',
            'pbox'                  => 'nullable|string|max:255',
            'notes'                 => 'nullable|string|max:1024',
        ];
    }

    public function loadDefaults()
    {
        $this->country_id=Auth::user()->country_id??(Country::where('country',config('lopsoft.country_default'))->first())->id??null;
        $this->emit('setvalue', 'countrycomponent', $this->country_id );

        // Userprofile
        $this->userProfileClear();
    }

    public function resetForm()
    {
        $this->parent='';
        $this->address1='';
        $this->address2='';
        $this->city='';
        $this->state='';
        $this->pbox='';
        $this->notes='';
        $this->phones=[];
        $this->phones[]=$this->phone;
        $this->emails=[];
        $this->emails[]=$this->email;
        $this->loadDefaults();
        $this->emit('setphones','parentsphones' , $this->phones);
        $this->emit('setemails','parentsemails' , $this->emails);
    }

    public function loadRecordDef()
    {
        $this->parent=$this->record->parent;
        $this->address1=$this->record->address1;
        $this->address2=$this->record->address2;
        $this->city=$this->record->city;
        $this->state=$this->record->state;
        $this->pbox=$this->record->pbox;
        $this->notes=$this->record->notes;
        $this->phones=getPhones($this->record->phones);
        $this->emails=getEmails($this->record->emails);

        /* Only for the current academic year */
        $anno=getUserAnnoSession();
        $this->students=$anno->belongsToMany(Student::class)->orderBy('anno_student.grade_id','asc')->whereIn('students.id',$this->record->students->pluck('id'))->get();
        $this->studentsnotenrolled=$this->record->students()->whereNotIn('students.id',$this->students->pluck('id'))->get();


        // User Profile
        $this->userProfileLoadRecord($this->record, $this->emails);


    }


    public function getKeyNotification($record)
    {
        return ($record->parent);
    }

    /**
     * Validate only some fields
     *
     * @return void
     */
    public function validateFields()
    {
        return [
            'parent'                 =>  $this->parent,
            'address1'               => $this->address1,
            'address2'               => $this->address2,
            'city'                   => $this->city,
            'state'                  => $this->state,
            'pbox'                   => $this->pbox,
            'notes'                  => $this->notes,
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
            'parent'                 => $this->parent,
            'address1'               => $this->address1,
            'address2'               => $this->address2,
            'city'                   => $this->city,
            'state'                  => $this->state,
            'pbox'                   => $this->pbox,
            'notes'                  => $this->notes,
            'country_id'             => $this->country_id,
        ];
    }

    public function eventSetCountry($country, $change)
    {
        $this->country_id=$country;

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
                ParentPhone::create([
                    'phone'             => $phone['phone'],
                    'description'       => $phone['description'],
                    'school_parent_id'  => $recordStored->id,
                ]);
            }
        }
        // Create Emails
        foreach($this->emails as $email)
        {
            if ($email['email']!='')
            {
                ParentEmail::create([
                    'email'             => $email['email'],
                    'description'       => $email['description'],
                    'notif'             => $email['notif'],
                    'school_parent_id'  => $recordStored->id,
                ]);
            }
        }

        $this->userProfileSaveUser($recordStored, $this->parent, 'schoolparent');

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
                   ParentPhone::where('id',$phone['id'])->update([
                        'phone'             => $phone['phone'],
                        'description'       => $phone['description'],
                        'school_parent_id'  => $recordUpdated->id,
                    ]);
                }
                else
                {
                    ParentPhone::create([
                        'phone'             => $phone['phone'],
                        'description'       => $phone['description'],
                        'school_parent_id'  => $recordUpdated->id,
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
                    ParentEmail::where('id',$email['id'])->update([
                        'email'             => $email['email'],
                        'description'       => $email['description'],
                        'notif'             => $email['notif'],
                        'school_parent_id'  => $recordUpdated->id,
                    ]);
                }
                else
                {
                    ParentEmail::create([
                        'email'             => $email['email'],
                        'description'       => $email['description'],
                        'notif'             => $email['notif'],
                        'school_parent_id'  => $recordUpdated->id,
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
        $from=2;
        $username='';

        if ($from==1)
        {
            /* From parent */
            $parts=explode(' ',$this->parent);
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
        }
        if ($from==2)
        {
            $count=SchoolParent::count();
            do{
                $count++;
                $candidate='p'.Str::padLeft($count,5,'0');
            }while(User::where('username', $candidate)->first()!=null);
            $username=$candidate;
        }
        return $username;
    }

}
