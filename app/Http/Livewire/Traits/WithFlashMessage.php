<?php

namespace App\Http\Livewire\Traits;

Trait WithFlashMessage
{
    public function showFlashError($msgid, $message)
    {
        $this->emit('showFlashMessage', 'error', $msgid, $message);
    }

    public function showFlashSuccess($msgid, $message)
    {
        $this->emit('showFlashMessage', 'success', $msgid, $message);
    }

    public function showFlashInfo($msgid, $message)
    {
        $this->emit('showFlashMessage', 'info', $msgid, $message);
    }

    public function showFlashWarning($msgid, $message)
    {
        $this->emit('showFlashMessage', 'warning', $msgid, $message);
    }

    public function hideFlashMessage($msgid)
    {
        $this->emit('hideFlashMessage', $msgid);
    }




}
