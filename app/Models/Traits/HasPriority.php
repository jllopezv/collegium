<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Auth;

trait HasPriority
{
    protected $hasPriority=true;

    public function upPriority()
    {
        if (!in_array('priority', $this->fillable)) return;
        if ($this->priority<2) return;
        $this->priority--;
        if ( !property_exists($this, 'hasAnno') || (property_exists($this, 'hasAnno') && property_exists($this, 'hasPriority')) ) $this->save();
    }

    public function downPriority()
    {
        if (!in_array('priority', $this->fillable)) return;
        $this->priority++;
        if ( !property_exists($this, 'hasAnno') || (property_exists($this, 'hasAnno') && property_exists($this, 'hasPriority')) ) $this->save();
    }

    static public function syncPriority($items)
    {
        if (count($items)==0) return;
        $priority=1;
        foreach($items as $item)
        {
            $item->priority=$priority;
            if ( !property_exists($item->getModel(), 'hasAnno')) $item->save();
            $priority++;
        }
    }

}
