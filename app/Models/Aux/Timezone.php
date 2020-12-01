<?php

namespace App\Models\Aux;

use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use Illuminate\Database\Eloquent\Model;

class Timezone extends Model
{

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
