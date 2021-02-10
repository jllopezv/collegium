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

}
