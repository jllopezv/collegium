<?php

namespace App\Http\Livewire\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

Trait IsUserType
{

    public $userprofile=null;

    public function getUserProfileCredentials()
    {
        $user=new User;
        $user->name=$this->getProfileName();
        $user->username=$this->getProfileUsername();
        $user->email=$this->profileuseremail;
        return $user;
    }

    public function validateUserProfile()
    {
        $user=$this->getUserProfileCredentials();
        return($user->validateCreateProfile());
    }

    public function login($table, $id)
    {
        if (Auth::check() && Auth::user()->hasAbilityOr($table.'login'))
        {
            Auth::logout();
            $user=Auth::loginUsingId($id, true);

            if ($user===false)
            {
                $this->showError("NO SE PUDO REALIZAR LOGIN CON EL USUARIO");
                return;
            }

            return redirect()->route('dashboard');
        }

        $this->showError("NO TIENE AUTORIZACION PARA REALIZAR LA OPERACION");
        return;
    }


}
