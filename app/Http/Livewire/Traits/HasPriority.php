<?php

namespace App\Http\Livewire\Traits;

Trait HasPriority
{

    public $priority=0;

    public function upPriority($id)
    {
        $item=$this->model::find($id);
        if (is_null($item)) return;
        $item->upPriority();
        // $this->callTimeout('refreshDatatable',500);
    }

    public function downPriority($id)
    {
        $item=$this->model::find($id);
        if (is_null($item)) return;
        $item->downPriority();
        // $this->callTimeout('refreshDatatable',500);
    }

    public function syncPriority()
    {
        $this->model::syncPriority($this->querySearch()->get());
    }



}
