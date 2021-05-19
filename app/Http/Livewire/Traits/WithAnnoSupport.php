<?php

namespace App\Http\Livewire\Traits;

use App\Models\School\SchoolLevel;

Trait WithAnnoSupport
{

    // public $showOnlyAnno=true;  //Defined in HasCommon for compatibility

    /**
     * Show All Annos
     */

    public function showAnnoGrid()
    {
        $this->showOnlyAnno=true;
        $this->showFilters=true;
        $this->createFilter();
        $this->getFilter();
    }

    public function hideAnnoGrid()
    {
        $this->showOnlyAnno=false;
        $this->showFilters=false;
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

    public function activateRecordInAnno($id)
    {
        $this->showConfirm("error","¿SEGURO QUE DESEA ACTIVAR EL REGISTRO EN EL AÑO ACADÉMICO ACTUAL?","ACTIVAR REGISTRO","activateRecordInAnnoAction","close","$id");
    }

    public function deactivateRecordInAnno($id)
    {
        $this->showConfirm("error","¿SEGURO QUE DESEA DESACTIVAR EL REGISTRO EN EL AÑO ACADÉMICO ACTUAL?","DESACTIVAR REGISTRO","deactivateRecordInAnnoAction","close","$id");
    }




}
