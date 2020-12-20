<?php

namespace App\Models\School;

use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\Traits\HasAbilities;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anno extends Model
{
    use HasActive;
    use HasOwner;
    use HasCommon;
    use HasAbilities;
    use HasAllowedActions;

    /*******************************************/
    /* Properties
    /*******************************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'anno', 'anno_start', 'anno_end'
    ];

    protected $dates = [
        'anno_start', 'anno_end'
    ];

    /*******************************************/
    /* Relationships
    /*******************************************/

    /*******************************************/
    /* Accessors and mutators
    /*******************************************/

    /**
     * Set Grade
     *
     * @param  String $value
     * @return void
     */
    public function setAnnoAttribute($value)
    {
        $this->attributes['anno']=mb_strtoupper($value);
    }

    /**
     * Get Grade
     *
     * @param  String $value
     * @return String
     */
    public function getAnnoAttribute($value)
    {
        return mb_strtoupper($value);
    }

    /*******************************************/
    /* Methods
    /*******************************************/

    public function scopeSearch($query, $search)
    {
        return $query->where('anno', 'like', '%'.$search.'%' );
    }

    public function setCurrent()
    {
        $currents=Anno::where('current', true)->get();
        foreach($currents as $current)
        {
            $current->current=false;
            $current->save();
        }
        $this->current=true;
        $this->save();
    }

    /*******************************************/
    /* Events
    /*******************************************/

    public function canLockRecordCustom()
    {
        return ($this->canBeLocked());
    }

    public function canBeLocked()
    {
        if ($this->current) return false;
        return true;
    }

    public function canDeleteRecordCustom()
    {
        return ($this->canBeDeleted());
    }

    public function canBeDeleted()
    {
        if ($this->current) return false;
        return true;
    }
}
