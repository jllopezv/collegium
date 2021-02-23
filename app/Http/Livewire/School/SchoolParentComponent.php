<?php

namespace App\Http\Livewire\School;

use App\Models\User;
use Livewire\Component;
use App\Models\Aux\Country;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\School\ParentEmail;
use App\Models\School\ParentPhone;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\IsUserType;
use Illuminate\Support\Facades\Validator;
use App\Http\Livewire\Traits\WithModalAlert;
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

    public $parent;
    public $relationship;
    public $address1;
    public $address2;
    public $city;
    public $state;
    public $country_id;
    public $pbox;
    public $notes;
    public $useremail;
    public $username;
    public $validEmail=false;
    public $checkedEmail=false;
    public $checkedUsername=false;
    public $validUsername=false;
    public $phones=[];
    public $emails=[];
    public $emailsdropdown=[];
    public $phone=[
        'phone'  =>  '',
        'description'  =>  '',
    ];
    public $email=[
        'email'  =>  '',
        'description'  =>  '',
        'notif'  =>  1,
    ];


    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',
        'eventsetcountry'       => 'eventSetCountry',
        'eventsetuseremail'     => 'eventSetUserEmail',
        'eventsetphones'        => 'eventSetPhones',
        'eventsetemails'        => 'eventSetEmails',
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
            'relationship'          => 'required|string|max:255',
            'address1'              => 'nullable|string|max:255',
            'address2'              => 'nullable|string|max:255',
            'city'                  => 'nullable|string|max:255',
            'state'                 => 'nullable|string|max:255',
            'pbox'                  => 'nullable|string|max:255',
            'notes'                 => 'nullable|string|max:1024',
            'useremail'             => 'required',
            'username'              => 'required',
        ];
    }

    public function loadDefaults()
    {
        $this->country_id=Auth::user()->country_id??(Country::where('country',config('lopsoft.country_default'))->first())->id??null;
        $this->emit('setvalue', 'countrycomponent', $this->country_id );
    }

    public function resetForm()
    {
        $this->parent='';
        $this->relationship='';
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
        $this->username='';
        $this->useremail='';
        $this->emailsdropdown=[];
        $this->checkedEmail=false;
        $this->checkedUsername=false;
        $this->loadDefaults();
        $this->emit('setphones','parentsphones' , $this->phones);
        $this->emit('setemails','parentsemails' , $this->emails);
        // $this->emit('setoptions','emailsdropdowncomponent',$this->emailsdropdown);
    }

    public function loadRecordDef()
    {
        $this->parent=$this->record->parent;
        $this->relationship=$this->record->relationship;
        $this->address1=$this->record->address1;
        $this->address2=$this->record->address2;
        $this->city=$this->record->city;
        $this->state=$this->record->state;
        $this->pbox=$this->record->pbox;
        $this->notes=$this->record->notes;
        $this->useremail=$this->record->user->email;
        $this->username=$this->record->user->username;
        $this->phones=getPhones($this->record->phones);
        $this->emails=getEmails($this->record->emails);
        $this->getEmailsDropDown();
        $this->emit('setoptions','emailsdropdowncomponent',$this->emails);
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
            'relationship'           => $this->relationship,
            'address1'               => $this->address1,
            'address2'               => $this->address2,
            'city'                   => $this->city,
            'state'                  => $this->state,
            'pbox'                   => $this->pbox,
            'notes'                  => $this->notes,
            'useremail'              => $this->useremail,
            'username'               => $this->username,
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
            'relationship'           => $this->relationship,
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


    public function customStoreValidation()
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
                    ['phone' =>  $phone['phone'] ],
                    ['phone'   =>  'required|string|max:255' ],
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

        if ($this->checkedEmail && !$this->validEmail)
        {
            $this->addError('useremail', 'EMAIL NO VÁLIDO');
            $haserrors=true;
        }

        if ($this->checkedUsername && !$this->validUsername)
        {
            $this->addError('username', 'USUARIO NO VÁLIDO');
            $haserrors=true;
        }

        if ($haserrorsemails || $haserrorsphones || $haserrors)
        {
            $this->showFlashError($this->flashmessageid,"ERROR EN LOS DATOS");
            $this->emit('validationerror', $this->getErrorBag());
            return false;
        }
        return true;
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

        $userprofile=User::createProfileUser($this->parent, $this->username, $this->useremail, config('lopsoft.users_defaultpassword'), 'parent' );
        if ($userprofile==null)
        {
            $this->checkFlashErrors();
            return;
        }
        else
        {
            $userprofile->profile_photo_path=null;
            $recordStored->user()->save($userprofile);
        }

    }

    public function getEmailsDropDown()
    {
        $this->emailsdropdown=[];
        if (count($this->emails)==0) return;
        foreach($this->emails as $email)
        {
            if ( $email['email']!='' )
            {
                $this->emailsdropdown[]=[
                    'text'  =>  $email['email'],
                    'value' =>  $email['email'],
                ];
            }
        }
        $this->emit('setoptions','emailsdropdowncomponent', $this->emailsdropdown);
        $this->checkEmail();
    }

    public function eventSetUserEmail($email)
    {
        $this->useremail=$email;
        $this->checkEmail();
    }

    public function checkEmail()
    {
        $this->checkedEmail=false;
        if ($this->useremail=='' || $this->useremail==null) return;
        $user=User::where('email', $this->useremail)->first();
        if ($user==null)
        {
            $this->validEmail=true;
            return;
        }
        if ($user->profile!=null)
        {
            if ( $this->mode=='edit' && $user->profile->id==$this->record->id )
            {
                $this->validEmail=true;
            }
            else
            {
                $this->validEmail=$user==null?true:false;
            }
        }
        $this->checkedEmail=true;
    }

    public function eventSetPhones($phones)
    {
        $this->phones=$phones;
    }

    public function eventSetEmails($emails)
    {
        $this->emails=$emails;
        $this->getEmailsDropDown();
    }

    public function getProfileUsername()
    {
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
        return $username;
    }

    public function updatedParent()
    {
        $this->username=$this->getProfileUsername();
        $this->checkUsername();
    }

    public function updatedUsername()
    {
        $this->checkUsername();
    }

    public function checkUsername()
    {
        $this->checkedUsername=false;
        if ($this->username=='' || $this->username==null) return;
        $user=User::where('username', $this->username)->first();

        if ( $this->mode=='edit' && $user->profile->id==$this->record->id )
        {
            $this->validUsername=true;
        }
        else
        {
            $this->validUsername=$user==null?true:false;
        }
        $this->checkedUsername=true;
    }



}
