<?php

namespace App\Http\Livewire\Traits;

Trait HasPriority
{
    public function upPriority($id)
    {
        $item=$this->model::find($id);
        if (is_null($item)) return;
        $item->upPriority();
    }

    public function downPriority($id)
    {
        $item=$this->model::find($id);
        if (is_null($item)) return;
        $item->downPriority();

    }

    public function syncPriority()
    {
        $this->model::syncPriority();
    }

}
