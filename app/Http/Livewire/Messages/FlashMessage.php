<?php

namespace App\Http\Livewire\Messages;

use Livewire\Component;

class FlashMessage extends Component
{
    public $msgid;
    public $message;
    public $msgtype;

    protected $listeners = ['showFlashMessage' => 'open', 'hideFlashMessage' => 'close'];

    public function mount($msgid)
    {
        $this->msgid=$msgid;
    }

    public function open($msgtype, $msgid, $message)
    {
        if ($msgid==$this->msgid)
        {
            $this->msgtype=$msgtype;
            $this->message=$message;
            $this->dispatchBrowserEvent('showflashmessage', ['msgid' => $msgid]);
        }

    }

    public function close($msgid)
    {
        if ($msgid==$this->msgid)
        {
            $this->dispatchBrowserEvent('hideflashmessage', ['msgid' => $msgid]);
        }
    }

    public function render()
    {
        return view('livewire.messages.flash-message', [ 'id' => $this->msgid ]);
    }
}
