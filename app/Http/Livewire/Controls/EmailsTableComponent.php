<?php

namespace App\Http\Livewire\Controls;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class EmailsTableComponent extends Component
{
    public $emails=[];
    public $mode;
    public $uid;

    protected $listeners=[
        'setemails' => 'setEmails',
    ];

    public function setEmails($uid, $emails)
    {
        if ($this->uid==$uid)
        {
            $this->emails=$emails;
        }

    }

    public function mount()
    {
        if ($this->mode=='create') $this->EmailAdd();
    }

    public function EmailAdd()
    {
        $newemail=[
            'email' =>  '',
            'description'  =>  '',
            'notif' =>  true,
        ];
        $this->emails[]=$newemail;
        $this->checkEmails();
    }

    public function EmailDelete($index)
    {
        array_splice($this->emails,$index,1);
        $this->checkEmails();
    }
    public function EmailChangeNotif($index)
    {
        $this->emails[$index]['notif']=!$this->emails[$index]['notif'];
        $this->updatedEmails();
        $this->checkEmails();
    }

    public function updatedEmails()
    {
        $this->emit('eventsetemails',$this->emails);
        $this->checkEmails();
    }

    public function checkEmails()
    {
        $haserrorsemails=false;
        foreach($this->emails as $email)
        {
            if ($email['email']!='')
            {
                $validator=Validator::make(
                    [ 'email'   =>  $email['email']  ],
                    [ 'email'   =>  'required|email' ],
                );
                if ($validator->fails())
                {
                    $this->addError('email_'.$email['email'], 'EL EMAIL '.$email['email'].' NO ES VÁLIDO');
                    $this->addError('email', 'EL EMAIL '.$email['email'].' NO ES VÁLIDO');
                    $haserrorsemails=true;
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.controls.emails-table-component');
    }

}
