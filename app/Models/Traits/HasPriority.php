<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Auth;

trait HasPriority
{

    public function upPriority()
    {
        if (!in_array('priority', $this->fillable)) return;
        if ($this->priority<2) return;
        $this->priority--;
        $this->save();
    }

    public function downPriority()
    {
        if (!in_array('priority', $this->fillable)) return;
        $this->priority++;
        $this->save();
    }

    static public function syncPriority()
    {
        $items=self::orderBy('priority')->get();
        $priority=1;
        foreach($items as $item)
        {
            $item->priority=$priority;
            $item->save();
            $priority++;
        }
    }

}
