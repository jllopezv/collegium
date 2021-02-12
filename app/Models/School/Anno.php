<?php

namespace App\Models\School;

use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\School\SchoolBatch;
use App\Models\School\SchoolGrade;
use App\Models\School\SchoolLevel;
use App\Models\Traits\HasAbilities;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anno extends Model
{
    use HasActive;
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

    public function schoolLevels()
    {
        return $this->belongsToMany(SchoolLevel::class)->active()->available()->withPivot(['priority','available'])->orderBy('priority');
    }

    public function schoolGrades()
    {
        return $this->belongsToMany(SchoolGrade::class)->active()->available()->withPivot(['priority','available'])->orderBy('priority');
    }

    public function schoolBatches()
    {
        return $this->belongsToMany(SchoolBatch::class)->active()->available()->withPivot(['priority','available'])->orderBy('priority');
    }

    public function schoolModalities()
    {
        return $this->belongsToMany(SchoolModality::class)->active()->available()->withPivot(['priority','available'])->orderBy('priority');
    }

    public function schoolSections()
    {
        return $this->belongsToMany(SchoolSection::class)->active()->available()->withPivot(['priority','available'])->orderBy('priority');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class)->withPivot('priority')->orderBy('priority');
    }

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

    public function current()
    {
        return Anno::where('current', true)->first();
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
