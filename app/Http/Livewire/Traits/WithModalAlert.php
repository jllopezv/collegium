<?php

namespace App\Http\Livewire\Traits;

Trait WithModalAlert
{
    public function showAlertError($message, $title='')
    {
        $this->emit('showModalAlert', 'error', $message, $title);
    }

    public function showAlertSuccess($message, $title='')
    {
        $this->emit('showModalAlert', 'success', $message, $title);
    }

    public function showAlertInfo($message, $title='')
    {
        $this->emit('showModalAlert', 'info', $message, $title);
    }

    public function showAlertWarning($message, $title='')
    {
        $this->emit('showModalAlert', 'warning', $message, $title);
    }




}
