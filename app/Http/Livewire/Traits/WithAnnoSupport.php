<?php

namespace App\Http\Livewire\Traits;

use App\Models\School\SchoolLevel;

Trait WithAnnoSupport
{

    public $showOnlyAnno=true;

    /**
     * Show All Annos
     */

    public function showAnno()
    {
        $this->showOnlyAnno=true;
    }

    public function hideAnno()
    {
        $this->showOnlyAnno=false;
    }

    public function annoSupportForceGetQueryData($ret, $query)
    {
        if (!$this->showOnlyAnno)
        {
            if ($this->sortorder=='priority' || $this->sortorder=='-priority') $this->sortorder='-id';
        }
        if (!$this->showOnlyAnno) $ret=$query;
        return $ret;
    }


}
