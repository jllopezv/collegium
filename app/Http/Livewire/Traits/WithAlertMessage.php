<?php

namespace App\Http\Livewire\Traits;

Trait WithAlertMessage
{
    public function ShowError($message, $title="", $submessage="",   $showtitle=false, $tout=3000)
    {
        $this->dispatchBrowserEvent('alertmsg', [
            'type'          => 'error',
            'msg'           => $message,
            'submsg'        => $submessage,
            'title'         => $title,
            'showtitle'     => $showtitle,
            'timeout'       => $tout,
        ]);
    }

    public function ShowSuccess($message, $title="", $submessage="",   $showtitle=false, $tout=3000)
    {
        $this->dispatchBrowserEvent('alertmsg', [
            'type'          => 'success',
            'msg'           => $message,
            'submsg'        => $submessage,
            'title'         => $title,
            'showtitle'     => $showtitle,
            'timeout'       => $tout,
        ]);
    }

    public function ShowInfo($message, $title="", $submessage="",   $showtitle=false, $tout=3000)
    {
        $this->dispatchBrowserEvent('alertmsg', [
            'type'          => 'info',
            'msg'           => $message,
            'submsg'        => $submessage,
            'title'         => $title,
            'showtitle'     => $showtitle,
            'timeout'       => $tout,
        ]);
    }

    public function ShowWarning($message, $title="", $submessage="",   $showtitle=false, $tout=3000)
    {
        $this->dispatchBrowserEvent('alertmsg', [
            'type'          => 'warning',
            'msg'           => $message,
            'submsg'        => $submessage,
            'title'         => $title,
            'showtitle'     => $showtitle,
            'timeout'       => $tout,
        ]);
    }

    public function ShowDebug($message, $title="", $submessage="",   $showtitle=false, $errocode='', $tout=3000)
    {
        $this->dispatchBrowserEvent('alertmsg', [
            'type'          => 'debug',
            'msg'           => $message,
            'submsg'        => $submessage,
            'title'         => $title,
            'showtitle'     => $showtitle,
            'errorcode'     => $errocode,
            'timeout'       => $tout,
        ]);
    }




}
