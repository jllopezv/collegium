<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
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

    public $username;
    public $name;
    public $email;
    public $oldpassword;
    public $password;
    public $password_confirmation;
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

    public function render()
    {
        return view('livewire.update-profile');
    }


    public function testemit()
    {



        // $this->emit('eventtest');
        $this->showFlashSuccess('passwordUpdate','INFORMACIÓN ACTUALIZADA');
    }
}
