<?php

namespace App\Http\Livewire\Traits;

use App\Models\User;

Trait WithUserProfile
{

    public $profileusername;
    public $profileuseremail;
    public $profileemailsdropdown=[];
    public $emaildropdown=true;


    // Validation
    public $checkedEmail=false;
    public $checkedUsername=false;
    public $validEmail=false;
    public $validUsername=false;


    /**
     * Methods
     */

    public function userProfileValidation()
    {
        $haserrors=false;
        $this->emit("userprofileclearerrors");

        $this->checkUserProfileEmail();
        $this->checkUserProfileUsername();

        if (!$this->validEmail)
        {
            $this->addError('profileuseremail', 'EMAIL DE USUARIO NO VÁLIDO');
            $this->emit('userprofileadderror','profileuseremail','EMAIL DE USUARIO NO VÁLIDO');
            $this->ShowError('EMAIL DE USUARIO NO VÁLIDO');
            $haserrors=true;
        }

        if (!$this->validUsername)
        {
            $this->addError('profileusername', 'USUARIO NO VÁLIDO');
            $this->emit('userprofileadderror','profileusername','USUARIO NO VÁLIDO');
            $this->ShowError('NOMBRE DE USUARIO NO VÁLIDO');
            $haserrors=true;
        }

        return $haserrors;
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
        //$this->emit("userprofileupdatedvalidation",  $this->validUsername, $this->validEmail);


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

    }

    public function getProfileEmail()
    {
        if ($this->getProfileUsername()=='') return '';
        return $this->getProfileUsername()."@".config('lopsoft.emails_generate_domain');
    }

    public function userProfileClear()
    {
        $this->validUsername=false;
        $this->validEmail=false;
        $this->checkedEmail=false;
        $this->checkedUsername=false;
        $this->profileuseremail='';
        $this->profileusername='';
        $this->profileemailsdropdown=[];
        $this->emit('setoptions','userprofileemailsdropdowncomponent', $this->profileemailsdropdown);
    }

    public function userProfileLoadRecord($record, $emails=[])
    {
        $this->profileuseremail=$record->user->email;
        $this->profileusername=$record->user->username;
        $this->profileemailsdropdown=$emails;
        $this->userProfileSetEmails($emails);
        $this->checkUserProfileUsername();
        $this->checkUserProfileEmail();
    }

    // Override this for customization

    public function generateProfileUsername()
    {
        $this->profileusername=$this->getProfileUsername();
        $this->checkUserProfileUsername();
    }

    public function generateProfileEmail()
    {
        $genemail=$this->getProfileEmail();
        if ( $genemail=='' ) return;
        $this->profileuseremail=$genemail;
        if (isset($this->emails))
        {
            $this->emit('addemail', $this->emailcomponent, $this->profileuseremail, 'Email Sugerido');
            $this->userProfileSetEmails($this->emails);
            $this->emit('setvalue', 'userprofileemailsdropdowncomponent', $this->profileuseremail);
        }
        $this->checkUserProfileEmail();
    }


    /**
     * Actions
     */

    public function userProfileSaveUser($recordStored, $name, $role)
    {

        $userprofile=User::createProfileUser($name, $this->profileusername, $this->profileuseremail, config('lopsoft.users_defaultpassword'), $role );
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

    public function userProfileUpdateUser($recordUpdated)
    {
        $currentuser=$recordUpdated->user;
        $currentuser->username=$this->profileusername;
        $currentuser->email=$this->profileuseremail;
        $currentuser->save();
    }

    /**
     * Events
     */

    public function eventSetUserProfileEmail($email, $change=false)
    {
        $this->profileuseremail=$email;
        $this->checkUserProfileEmail();
    }

    public function userProfileSetEmails($emails)
    {
        $this->profileemailsdropdown=[];
        if (count($emails)==0) return;
        foreach($emails as $email)
        {
            if ( $email['email']!='' )
            {
                $this->profileemailsdropdown[]=[
                    'text'  =>  $email['email'],
                    'value' =>  $email['email'],
                ];
            }
        }
        $this->emit('setoptions','userprofileemailsdropdowncomponent', $this->profileemailsdropdown);
        $this->checkUserProfileEmail();

    }

    public function updatedProfileusername()
    {
        $this->checkUserProfileUsername();
    }

    public function updatedProfileuseremail()
    {
        $this->checkUserProfileEmail();
    }

    public function userProfileUpdatedValidation($validUsername, $validEmail)
    {
        $this->validUsername=$validUsername;
        $this->validEmail=$validEmail;
        $this->checkedUsername=true;
        $this->checkedEmail=true;
    }

    public function userProfileUpdatedData($username, $email)
    {
        $this->profileusername=$username;
        $this->profileuseremail=$email;
    }



}
