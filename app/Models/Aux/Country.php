<?php

namespace App\Models\Aux;

use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasAbilities;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;
use App\Models\Traits\HasTranslation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{

    use HasAbilities;
    use HasAllowedActions;
    use HasTranslation;

    /**
     * Fields with translation
     *
     * @var array
     */
    protected $translatable = [ 'country' ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country', 'code'
    ];

    public function setCountryAttribute($value)
    {
        $this->attributes['country'] = mb_strtoupper($value);
    }

    public function getCountryAttribute($value)
    {
        return strtoupper($value);
    }

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = strtoupper($value);
    }

    public function getCodeAttribute($value)
    {
        return mb_strtoupper($value);
    }

    public function getFlagAttribute()
    {
        return $this->flag();
    }

    public function flag()
    {
        return ( "<i class='gnosys-flag fflag fflag-".$this->iso." ff-md ff-wave ff-lt'></i>" );
    }

    public function scopeSearch($query, $search)
    {
        $countries=Country::all();
        $filtered=$countries->filter(function($value,$key) use($search)
        {
            return (strpos( mb_strtoupper($value->country), mb_strtoupper($search) ) !== false);
        })->pluck('id');

        if ($filtered->isEmpty())
        {
            return $query->where('country','like','%'.mb_strtoupper($search).'%')
                ->orWhere('iso','like','%'.$search.'%')
                ->orWhere('iso3','like','%'.$search.'%')
                ->orWhere('numcode','like','%'.$search.'%')
                ->orWhere('phonecode','like','%'.$search.'%');
        }

        return $query->whereIn('id', $filtered->toArray() );
    }


}
