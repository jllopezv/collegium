<?php

namespace App\Http\Livewire\Messages;

use Livewire\Component;

class ModalConfirm extends Component
{
    public $isOpen = false;
    public $modalmessage='';
    public $modaltype='';
    public $modaltitle='';
    public $callOK=null;
    public $callCANCEL=null;
    public $params='';

    protected $listeners = ['showModalConfirm' => 'open', 'closeModalConfirm' => 'close'];

    public function open($modaltype, $modalmessage, $modaltitle, $callok, $callcancel,$params)
    {
        $this->isOpen = true;
        $this->modaltype = $modaltype;
        $this->modalmessage = $modalmessage;
        $this->modaltitle=$modaltitle;
        $this->callOK=$callok;
        $this->callCANCEL=$callcancel;
        $this->params=$params;
    }

    public function close()
    {
        $this->isOpen = false;
    }

    public function sendEvent($eventName, $eventParams)
    {
        $this->close();
        $this->emit($eventName, $eventParams);
    }

    public function render()
    {
        return view('livewire.messages.modal-confirm');
    }
}
