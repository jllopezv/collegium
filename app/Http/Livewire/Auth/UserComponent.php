<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\Auth\User;
use App\Models\Aux\Country;
use App\Models\Aux\Language;
use App\Models\Aux\Timezone;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Livewire\Traits\HasAvatar;
use App\Http\Livewire\Traits\HasCommon;
use Illuminate\Support\Facades\Storage;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class UserComponent extends Component
{
    use WithPagination;
    use HasCommon;
    use HasAvatar;
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;

    public  $name;
    public  $username;
    public  $email;
    public  $level;
    public  $password;
    public  $password_confirmation;
    public  $profile_photo_path;
    public  $avatar;
    public  $roles=[];
    public  $dateformat;
    public  $timezone_id;
    public  $country_id;
    public  $language_id;
    private $avatarfolder='profile-photos';


    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',
        'avatar_updated'        => 'avatarUpdated',
        'eventsetrole'          => 'eventSetRole',
        'eventsettimezone'      => 'eventSetTimezone',
        'eventsetcountry'       => 'eventSetCountry',
        'eventsetlanguage'      => 'eventSetLanguage',
        'eventsetdateformat'    => 'eventSetDateformat',
    ];

    /**
     * Mount function
     *
     * @return void
     */
    public function mount()
    {
        $this->table='users';
        $this->module='auth';
        $this->commonMount();
        $this->multiple=true;
        // Default order for table
        $this->sortorder='username';
        $this->flashmessageid='usersaved';
        $this->loadDefaults();
    }

    public function getQueryData()
    {
        return $this->model::with([ 'roles' ]);
    }

    public function loadDefaults()
    {
        $this->dateformat=config('lopsoft.date_format');
        $this->timezone_id=(Timezone::where('name',config('lopsoft.timezone_default'))->first())->id??null;
        $this->country_id=(Country::where('country',config('lopsoft.country_default'))->first())->id??null;
        $this->language_id=(Language::where('code',config('lopsoft.locale_default'))->first())->id??null;
    }

    /**
     * Rules to validate model
     *
     * @return array
     */
    public function validateRules() : array
    {
        $rules=[
            'name'          => 'required|string|max:255',
            'username'      => 'required|string|max:255|unique:users,username,'.$this->recordid,
            'email'         => 'required|email',
        ];

        if ($this->mode=='create')
        {
            $rules=array_merge($rules, [ 'password' => 'required|string|min:5', ]);
        }
        return $rules;
    }

    public function resetForm()
    {
        $this->name='';
        $this->username='';
        $this->email='';
        $this->level='';
        $this->profile_photo_path=null;
        $this->password='';
        $this->password_confirmation='';
        $this->roles=[];
        $this->loadDefaults();
        $this->emit('setvalue', 'rolecomponent', null);
        $this->emit('avatarreset');
    }



    public function saveRecord()
    {
        $ret=[
            'name'                  =>  $this->name,
            'username'              =>  $this->username,
            'email'                 =>  $this->email,
            'profile_photo_path'    =>  $this->profile_photo_path,
            'dateformat'            =>  $this->dateformat,
            'timezone_id'           =>  $this->timezone_id,
            'country_id'            =>  $this->country_id,
            'language_id'           =>  $this->language_id,
        ];

        if ($this->password!="" || $this->mode=='create')
        {
            $ret=array_merge($ret,['password'  =>  Hash::make($this->password),]);
        }

        return $ret;
    }

    public function canUpdate()
    {
        return $this->saveAvatar();
    }

    public function canStore()
    {
        return $this->saveAvatar();
    }

    public function postStore($recordstored)
    {
        $recordstored->roles()->sync($this->roles);
        $recordstored->level=$recordstored->getUserLevel();
        $recordstored->save();
    }

    public function postUpdate($recordupdated)
    {
        $recordupdated->roles()->sync($this->roles);
    }

    public function validateCustomFields()
    {
        if ($this->password!=$this->password_confirmation)
        {
            $this->addError('password', 'LAS CONTRASEÑAS NO COINCIDEN');
            $this->addError('password_confirmation', 'LAS CONTRASEÑAS NO COINCIDEN');
            return false;
        }
        if (count($this->roles)==0)
        {
            $this->addError('roles', 'DEBE SELECCIONAR AL MENOS UN ROL');
            return false;
        }
        return true;
    }

    public function beforeGoBack()
    {
        $this->deleteTemp();
    }

    public function deleting($record)
    {
        return $this->deleteAvatar($record);
    }

    public function loadRecordDef()
    {

        $this->name=$this->record->name;
        $this->username=$this->record->username;
        $this->email=$this->record->email;
        $this->profile_photo_path=$this->record->profile_photo_path;
        $this->avatar=$this->record->avatar;
        $this->level=$this->record->level;
        $this->dateformat=$this->record->dateformat;
        $this->timezone_id=$this->record->timezone_id;
        $this->country_id=$this->record->country_id;
        $this->language_id=$this->record->language_id;
    }

    public function getKeyNotification($record)
    {
        return ($record->usename);
    }

    public function delete($id)
    {
        $this->showConfirm("error","<span class='text-xl'>¡¡ATENCIÓN!!</span><br/><br/>TODOS LOS REGISTROS CREADOS POR ESTE USUARIO QUEDARÁN EXPUESTOS A TODOS LOS DEMÁS USUARIOS<br/><b>ESTA OPERACIÓN ES IRREVERSIBLE</b><br/><br/>¿SEGURO QUE DESEA BORRAR EL USUARIO?","BORRAR REGISTRO","deleteRecord","close","$id");
    }

    /**
     * Event listener to set dropdown value
     *
     * @param  mixed $key
     * @return void
     */
    public function eventSetRole($roles)
    {
        $this->roles=$roles;
    }

    public function eventSetLanguage($language)
    {
        $this->language_id=$language;
    }

    public function eventSetTimezone($timezone)
    {
        $this->timezone_id=$timezone;
    }

    public function eventSetCountry($country, $change)
    {
        $this->country_id=$country;

        if ($change)
        {
            // Changed by user
            $country=Country::find($this->country_id);
            if ( is_null($country) )
            {
                $this->language_id=(Language::where('code',config('lopsoft.locale_default'))->first())->id??null;
            }
            else
            {
                $this->language_id=(Language::where('code',$country->language)->first())->id??null;
            }
            $this->emit('setvalue', 'languagecomponent', $this->language_id);
        }

    }

    public function eventSetDateformat($dateformat)
    {
        $this->dateformat=$dateformat;
    }

    public function setDataFilter()
    {
        $this->data->where('level','>=', Auth::user()->level);
    }



}
