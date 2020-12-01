<?php

namespace App\Http\Livewire\Messages;

use Livewire\Component;

class ModalAlert extends Component
{
    public $isOpen = false;
    public $modaltype = '';
    public $modalmessage='';
    public $modaltitle='';

    protected $listeners = ['showModalAlert' => 'open', 'closeModalAlert' => 'close'];

    public function open($modaltype, $modalmessage, $modaltitle='')
    {
        $this->isOpen = true;
        $this->modaltype = $modaltype;
        $this->modalmessage = $modalmessage;
        $this->modaltitle=$modaltitle;
    }

    public function close()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.messages.modal-alert');
    }
}
