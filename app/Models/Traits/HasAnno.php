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
        return $this->belongsToMany(Anno::class);
    }

}
