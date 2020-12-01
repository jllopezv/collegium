<?php

namespace App\Models\School;

use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasAbilities;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasActive;
    use HasOwner;
    use HasAbilities;
    use HasAllowedActions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'exp', 'names', 'first_surname', 'second_surname', 'birth', 'gender'
    ];

    protected $appends= [ 'name' ];

    protected $dates=[ 'birth' ];

    /*******************************************/
    /* Relationships
    /*******************************************/

    /*******************************************/
    /* Accessors and mutators
    /*******************************************/

    public function getNameAttribute()
    {
        return $this->first_surname." ".$this->second_surname.", ".$this->names;
    }

    /**
     * Get Name in uppercase
     *
     * @param  string  $value
     * @return string
     */
    public function getNamesAttribute($value)
    {
        if (config('lopsoft.studentsname_uppercase')) return mb_strtoupper($value);
        return $value;
    }

    /**
     * Set Names in uppercase
     *
     * @param  string  $value
     * @return void
     */
    public function setNamesAttribute($value)
    {
        if (config('lopsoft.studentsname_uppercase')) $this->attributes['names'] = mb_strtoupper($value);
    }

    /**
     * Get First_surname in uppercase
     *
     * @param  string  $value
     * @return string
     */
    public function getFirstSurnameAttribute($value)
    {
        if (config('lopsoft.studentsname_uppercase')) return mb_strtoupper($value);
        return $value;
    }

    /**
     * Set FirstSurname in uppercase
     *
     * @param  string  $value
     * @return void
     */
    public function setFirstSurnameAttribute($value)
    {
        if (config('lopsoft.studentsname_uppercase')) $this->attributes['first_surname'] = mb_strtoupper($value);
    }

    /**
     * Get Secondsurname in uppercase
     *
     * @param  string  $value
     * @return string
     */
    public function getSecondSurnameAttribute($value)
    {
        if (config('lopsoft.studentsname_uppercase')) return mb_strtoupper($value);
        return $value;
    }

    /**
     * Set SecondSurname in uppercase
     *
     * @param  string  $value
     * @return void
     */
    public function setSecondSurnameAttribute($value)
    {
        if (config('lopsoft.studentsname_uppercase')) $this->attributes['second_surname'] = mb_strtoupper($value);
    }

    /*******************************************/
    /* Methods
    /*******************************************/

    public function scopeSearch($query, $search)
    {
        return $query->where('exp', 'like', '%'.$search.'%' )
            ->orWhere('names', 'like', '%'.$search.'%')
            ->orWhere('first_surname', 'like', '%'.$search.'%')
            ->orWhere('last_surname', 'like', '%'.$search.'%' );
    }

}
