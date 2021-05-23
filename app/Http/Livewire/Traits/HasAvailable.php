<?php

namespace App\Http\Livewire\Traits;

Trait HasAvailable
{

    public $available=true;

    public function available($id)
    {
        $item=$this->model::find($id);
        if (is_null($item)) return;
        $item->available=true;
    }

    public function unAvailable($id)
    {
        $item=$this->model::find($id);
        if (is_null($item)) return;
        $item->available=false;
    }

}
