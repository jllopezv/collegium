<?php

namespace App\Models\Aux;


use Facades\App\Models\Aux\Country as Countries;
use App\Models\Traits\HasCache;
use App\Models\Traits\HasAbilities;
use App\Models\Traits\HasTranslation;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;

class Country extends Model
{

    use HasAbilities;
    use HasAllowedActions;
    use HasTranslation;
    use HasCache;

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
        'country', 'nicename', 'iso', 'iso3', 'numcode', 'phonecode', 'language'
    ];

    protected $appends=[ 'flag' ];

    public function setCountryAttribute($value)
    {
        $this->attributes['country'] = mb_strtoupper($value);
    }

    public function getCountryAttribute($value)
    {
        return strtoupper($value);
    }

    public function setIsoAttribute($value)
    {
        $this->attributes['iso'] = strtoupper($value);
    }

    public function getIsoAttribute($value)
    {
        return mb_strtoupper($value);
    }

    public function setLanguageAttribute($value)
    {
        $this->attributes['language'] = strtolower($value);
    }

    public function getLanguageAttribute($value)
    {
        return strtolower($value);
    }

    public function getFlagAttribute()
    {
        return $this->flag();
    }

    public function flag()
    {
        return ( "<i class='gnosys-flag fflag fflag-".$this->iso." ff-md ff-wave ff-lt'></i>" );
    }

    public function flagsm()
    {
        return ( "<i class='gnosys-flag fflag fflag-".$this->iso." ff-sm ff-wave ff-lt'></i>" );
    }

    public function scopeSearch($query, $search)
    {
        $countries=Countries::allCache();
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
