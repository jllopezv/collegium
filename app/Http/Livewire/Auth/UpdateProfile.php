<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use App\Models\Aux\Country;
use App\Models\Aux\Language;
use App\Models\Aux\Timezone;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithFlashMessage;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;


class UpdateProfile extends Component
{
    use WithFileUploads;
    use WithModalAlert;
    use WithFlashMessage;

    protected $listeners= [
        'eventsettimezone'      => 'eventSetTimezone',
        'eventsetcountry'       => 'eventSetCountry',
        'eventsetlanguage'      => 'eventSetLanguage',
        'eventsetdateformat'    => 'eventSetDateformat',
    ];

    public $username;
    public $name;
    public $email;
    public $oldpassword;
    public $password;
    public $password_confirmation;
    public $timezone_id;
    public $country_id;
    public $language_id;
    public $dateformat;
    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [
        'current_password' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    public function mount()
    {
        $user=Auth::user();

        $this->username=$user->username;
        $this->name=$user->name;
        $this->email=$user->email;


        $this->resetErrorBag();

    }

    public function loadDefaults()
    {
        $this->dateformat=Auth::user()->dateformat??config('lopsoft.date_format');
        $this->timezone_id=Auth::user()->timezone_id??(Timezone::where('name',config('lopsoft.timezone_default'))->first())->id??null;
        $this->country_id=Auth::user()->country_id??(Country::where('country',config('lopsoft.country_default'))->first())->id??null;
        $this->language_id=Auth::user()->language_id??(Language::where('code',config('lopsoft.locale_default'))->first())->id??null;

        $this->emit('setvalue', 'dateformatcomponent', $this->dateformat );
        $this->emit('setvalue', 'countrycomponent', $this->country_id );
        $this->emit('setvalue', 'languagecomponent', $this->language_id );
        $this->emit('setvalue', 'timezonecomponent', $this->timezone_id );
    }

    public function updateProfileInformation()
    {
        $this->resetErrorBag();
        $this->showFlashError('profileInfo','ERROR AL ACTUALIZAR DATOS');

        $id=Auth::user()->id;
        $validateData=[
            'name'      => 'required|string|min:1|max:255',
            'email'     => 'required|email|max:255|unique:users,email,'.$id,

        ];

        $this->validate($validateData);

        $user=User::find($id);
        $user->username=$this->username;
        $user->name=$this->name;
        $user->email=$this->email;

        if ($user->save())
        {
            $this->showFlashSuccess('profileInfo','INFORMACIÓN ACTUALIZADA');
        }
        else
        {
            $this->showFlashError('profileInfo','ERROR AL GUARDAR LOS DATOS');
        }

    }

    public function updatePassword(UpdatesUserPasswords $updater)
    {

        $this->resetErrorBag();
        $this->showFlashError('passwordUpdate','ERROR AL ACTUALIZAR DATOS');

        $updater->update(Auth::user(), $this->state);

        $this->state = [
            'current_password' => '',
            'password' => '',
            'password_confirmation' => '',
        ];

        $this->showFlashSuccess('passwordUpdate','INFORMACIÓN ACTUALIZADA');
    }

    public function updateProfileLocale()
    {
        $this->resetErrorBag();
        $this->showFlashError('localeUpdate','ERROR AL ACTUALIZAR DATOS');

        $id=Auth::user()->id;

        $user=User::find($id);
        $user->timezone_id=$this->timezone_id;
        $user->country_id=$this->country_id;
        $user->language_id=$this->language_id;
        $user->dateformat=$this->dateformat;

        try
        {

            if ($user->save())
            {
                $this->showFlashSuccess('localeUpdate','INFORMACIÓN ACTUALIZADA');
            }
            else
            {
                $this->showFlashError('localeUpdate','ERROR AL GUARDAR LOS DATOS');
            }
        }
        catch(\Exception $e)
        {
            $this->showFlashError('localeUpdate','ERROR AL GUARDAR LOS DATOS');
            $this->showException($e);
        }

    }

    /**
     * Show Exception message
     *
     * @param  mixed $e
     * @return void
     */
    public function showException(\Exception $e)
    {
        $this->showAlertError('SE PRODUJO UN ERROR INESPERADO<br/><br/>'.$e->getMessage(),"ERROR INESPERADO");
    }

    public function render()
    {
        return view('livewire.update-profile');
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


    /**
     * When component is updated... then emit broadcast message to all components to set values to parent
     *
     * @return void
     */
    public function updated()
    {
        // Request report from children
        $this->emit("getvalue","*");
    }


    public function resetImage()
    {
        $this->emit('resetavatar');
    }

    public function imageRotate()
    {
        $this->emit('rotateavatar');
    }

}
