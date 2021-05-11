<?php

namespace App\Models\Traits;

use App\Models\School\Anno;
use Illuminate\Support\Facades\DB;


/**
 * HasAnno
 */
trait HasAnno
{
    protected $hasAnno=true;

    public function annos()
    {
        $relationship=$this->belongsToMany(Anno::class);
        if ( property_exists($this, 'hasPriority'))
        {
            $relationship=$relationship->withPivot('priority');
        }
        if ( property_exists($this, 'hasAvailable'))
        {
            $relationship=$relationship->withPivot('available');
        }
        return $relationship;
    }

    public function annosToLabel()
    {
        $anno=$this->annos->last();
        if ($anno==null) return "";
        return "<span class='text-xs font-bold px-2 bg-cool-gray-600 text-green-300 rounded'>".$anno->anno."</span>";
        /*$ret='';
        foreach($annos as $anno)
        {
            $ret.="<span class='text-xs font-bold px-2 bg-cool-gray-600 text-green-300 rounded'>".$anno->anno."</span>";
        }
        return $ret;*/
    }

    public function isInAnno($anno_id=null)
    {
        if ($anno_id==null)
        {
            $anno=getUserAnnoSession();
            $anno_id=$anno->id;
        }
        $annos=$this->annos;
        foreach($annos as $itemanno)
        {
            if ($itemanno->id==$anno_id) return true;
        }
        return false;
    }

}
