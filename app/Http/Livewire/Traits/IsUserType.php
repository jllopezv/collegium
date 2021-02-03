<?php

namespace App\Http\Livewire\Traits;

use App\Models\User;

Trait IsUserType
{

    public $userprofile=null;

    public function getUserProfileCredentials()
    {
        $user=new User;
        $user->name=$this->getProfileName();
        $user->username=$this->getProfileUsername();
        $user->email=$this->email;
        return $user;
    }

    public function validateUserProfile()
    {
        $user=$this->getUserProfileCredentials();
        return($user->validateCreateProfile());
    }


}
