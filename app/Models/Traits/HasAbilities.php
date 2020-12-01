<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Auth;


/**
 * HasAbilities
 */
trait HasAbilities
{
    public function canDestroyRecordCustom()
    {
        return true;
    }

    public function canEditRecordCustom()
    {
        return true;
    }

    public function canShowRecordCustom()
    {
        return true;
    }

    public function canPrintRecordCustom()
    {
        return true;
    }

    public function abilityDestroy()
    {
        if (!Auth::user()->hasAbility($this->getTable().'.destroy')) return false;

        if ( $this->created_by!=Auth::user()->id && !Auth::user()->isAdmin() )
        {
            if (Auth::user()->hasAbility($this->getTable().'.destroy.owner')) return false;
        }
        return true;
    }

    public function abilityShow()
    {
        if (!Auth::user()->hasAbility($this->getTable().'.show')) return false;

        if ( $this->created_by!=Auth::user()->id && !Auth::user()->isAdmin() )
        {
            if (Auth::user()->hasAbility($this->getTable().'.show.owner')) return false;
        }
        return true;
    }

    public function abilityEdit()
    {
        if (!Auth::user()->hasAbility($this->getTable().'.edit')) return false;

        if ( $this->created_by!=Auth::user()->id && !Auth::user()->isAdmin() )
        {
            if (Auth::user()->hasAbility($this->getTable().'.edit.owner')) return false;
        }
        return true;
    }

    public function abilityPrint()
    {
        if (!Auth::user()->hasAbility($this->getTable().'.print')) return false;

        if ( $this->created_by!=Auth::user()->id && !Auth::user()->isAdmin() )
        {
            if (Auth::user()->hasAbility($this->getTable().'.print.owner')) return false;
        }
        return true;
    }


    public function canDestroyRecord()
    {
        if ( !$this->abilityDestroy() ) return false;
        return $this->canDestroyRecordCustom();
    }

    public function canShowRecord()
    {
        if ( !$this->abilityShow() ) return false;
        return $this->canShowRecordCustom();
    }

    public function canEditRecord()
    {
        if ( !$this->abilityEdit() ) return false;
        return $this->canEditRecordCustom();
    }

    public function canPrintRecord()
    {
        if ( !$this->abilityPrint() ) return false;
        return $this->canPrintRecordCustom();
    }

    public function canLockRecord()
    {
        if ( Auth::user()->isAdmin() ) return true;
        return false;
    }

    public function canUnlockRecord()
    {
        if ( Auth::user()->isAdmin() ) return true;
        return false;
    }

}
