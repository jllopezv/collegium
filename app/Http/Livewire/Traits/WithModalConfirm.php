<?php

namespace App\Http\Livewire\Traits;

Trait WithModalConfirm
{
    public function showConfirm($modaltype, $message, $title='', $callOK, $callCANCEL='close', $params)
    {
        $this->emit('showModalConfirm', $modaltype, $message, $title, $callOK, $callCANCEL, $params);
    }


}
