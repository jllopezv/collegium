<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;

class UserProfileComponent extends Component
{
    public $uid;
    public $mode;

    public $emailsdropdown=[];
    public $profileuseremail;
    public $profileusername;
    public $validEmail=false;
    public $validUsername=false;
    public $checkedEmail=false;
    public $checkedUsername=false;
    public $recordid=0;
    public $canGenerateUsername=true;
    public $canGenerateEmail=true;
    public $record;

    protected $listeners=[
        'userprofilesetemails'  =>  'setEmails',
        'userprofilesetusername'=>  'setUsername',
        'userprofileadderror'   => 'userProfileAddError',
        'userprofileclearerrors'   => 'userProfileClearErrors',
        'eventsetuserprofileemail' => 'eventSetUserProfileEmail',
    ];


    public function updatedProfileUsername()
    {
        $this->checkUserProfileUsername();
        $this->emit("userprofileupdateddata", $this->profileusername, $this->profileuseremail );
    }

    public function checkUserProfileUsername()
    {
        $this->checkedUsername=false;
        if ($this->profileusername=='' || $this->profileusername==null) return;
        $user=User::where('username', $this->profileusername)->first();

        if ($user==null)
        {
            // dont exists. I can use it
            $this->validUsername=true;
        }
        else
        {
            // User exists
            $this->validUsername=false;
            if ($user->profile!=null && $user->profile->id==$this->recordid)
            {
                // User has a profile and is my profile. Everything is OK
                $this->validUsername=true;
            }
        }

        $this->checkedUsername=true;
        $this->emit("userprofileupdatedvalidation",  $this->validUsername, $this->validEmail );

    }

    public function checkUserProfileEmail()
    {
        $this->checkedEmail=false;
        if ($this->profileuseremail=='' || $this->profileuseremail==null) return;
        $user=User::where('email', $this->profileuseremail)->first();
        if ($user==null)
        {
            // not exists. I can use it
            $this->validEmail=true;
        }
        else
        {
            // User exists
            $this->validEmail=false;
            if ($user->profile!=null && $user->profile->id==$this->recordid)
            {
                // User has a profile and is my profile. Everything is OK
                $this->validEmail=true;
            }
        }

        $this->checkedEmail=true;
        $this->emit("userprofileupdatedvalidation",  $this->validUsername, $this->validEmail);


    }

    public function generateProfileUsername()
    {
        $this->emit("userprofileusernamerequired");
    }

    public function generateProfileEmail()
    {
        $this->emit("userprofileemailrequired");
    }


    /**
     * Events
     */


    public function setEmails($uid, $emails)
    {
        if ($this->uid==$uid)
        {
            $this->emailsdropdown=[];
            if (count($emails)==0) return;
            foreach($emails as $email)
            {
                if ( $email['email']!='' )
                {
                    $this->emailsdropdown[]=[
                        'text'  =>  $email['email'],
                        'value' =>  $email['email'],
                    ];
                }
            }
            $this->emit('setoptions','userprofileemailsdropdowncomponent', $this->emailsdropdown);
            $this->checkUserProfileEmail();
        }

    }

    public function setUsername($uid, $username)
    {
        dd("aqui");
        if ($this->uid==$uid)
        {

            $this->profileusername=$username;
            $this->checkUserProfileUsername();
        }
    }


    public function eventSetUserProfileEmail($email, $change=false)
    {
        $this->profileuseremail=$email;
        $this->checkUserProfileEmail();
        $this->emit("userprofileupdateddata", $this->profileusername, $this->profileuseremail );
    }

    /**
     * Errors control
     */

    public function userProfileAddError($name,$message)
    {
        $this->addError($name,$message);
    }

    public function userProfileClearErrors()
    {
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.auth.user-profile-component');
    }
}
