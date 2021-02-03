<?php

namespace App\Models\Traits;

use App\Models\School\Anno;


/**
 * HasAnno
 */
trait HasAnno
{
    protected $hasAnno=true;

    public function annoables()
    {
        return $this->morphToMany(Anno::class, 'annoable');
    }

    public function anno($anno_id)
    {
        return $this->morphToMany(Anno::class, 'annoable')->where('anno_id',$anno_id)->first();
    }

    static public function sessionAnno($anno_id)
    {
        $anno=new Anno;
        return $anno->getModel()::join('annoables',$anno->getTable().'.id','=','annoables.annoable_id')->where('anno_id',$anno_id);
    }
}
