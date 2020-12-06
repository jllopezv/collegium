<?php

namespace App\Models\Aux;

use App\Models\Traits\HasAbilities;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;

class Timezone extends Model
{

    use HasAbilities;
    use HasAllowedActions;

    public function scopeSearch($query, $search)
    {
        $tzs=Timezone::all();
        $filtered=$tzs->filter(function($value,$key) use($search)
        {
            $newsearch=str_replace(' ','_',strtolower($search));
            return (strpos( strtolower($value->name), strtolower($newsearch) ) !== false);
        })->pluck('id');

        return $query->whereIn('id',$filtered)
                ->orWhere('offset','like','%'.$search.'%');

    }

}
