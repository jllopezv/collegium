<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAnno;
use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\Traits\HasAbilities;
use App\Models\Traits\HasAllowedActions;
use App\Models\Traits\HasAvailable;
use App\Models\Traits\HasPriority;

class SchoolSection extends Model
{
    use HasActive;
    use HasOwner;
    use HasCommon;
    use HasAbilities;
    use HasAllowedActions;
    use HasAnno;
    use HasPriority;
    use HasAvailable;

    /*******************************************/
    /* Properties
    /*******************************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'section', 'priority', 'grade_id'
    ];

    protected $appends=['priority'];

    /*******************************************/
    /* Relationships
    /*******************************************/

    public function grade()
    {
        return $this->belongsTo(SchoolGrade::class);
    }


    /*******************************************/
    /* Accessors and mutators
    /*******************************************/

    public function getPriorityAttribute()
    {
        $anno=getUserAnnoSession();
        $section=$anno->schoolSections->where('id', $this->id)->first();
        if ($section==null) return 0;
        return $section->pivot->priority;
    }

    public function setPriorityAttribute($value)
    {
        $anno=getUserAnnoSession();
        $anno->schoolSections()->updateExistingPivot($this->id, ['priority' => $value]);
    }

    public function getAvailableAttribute()
    {

        $anno=getUserAnnoSession();
        $section=$anno->schoolSections->where('id', $this->id)->first();
        if ($section==null) return null;
        return $section->pivot->available;

    }

    public function setAvailableAttribute($value)
    {
        $anno=getUserAnnoSession();
        $anno->schoolSections()->updateExistingPivot($this->id, ['available' => $value]);
    }

    public function getSectionLabelAttribute()
    {
        $grade=SchoolGrade::find($this->grade_id);
        return $this->section." - ".$grade->grade;
    }


    /**
     * Set Section
     *
     * @param  String $value
     * @return void
     */
    public function setSectionAttribute($value)
    {
        $this->attributes['section']=mb_strtoupper($value);
    }

    /**
     * Get Batch
     *
     * @param  String $value
     * @return String
     */
    public function getSectionAttribute($value)
    {
        return mb_strtoupper($value);
    }

    /*******************************************/
    /* Methods
    /*******************************************/

    public function scopeSearch($query, $search)
    {
        return $query->where('section', 'like', '%'.$search.'%' );
    }
}
