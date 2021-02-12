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

class SchoolModality extends Model
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
        'modality', 'priority'
    ];

    protected $appends=['priority'];

    /*******************************************/
    /* Relationships
    /*******************************************/


    /*******************************************/
    /* Accessors and mutators
    /*******************************************/

    public function getPriorityAttribute()
    {
        $anno=getUserAnnoSession();
        $modality=$anno->schoolModalities->where('id', $this->id)->first();
        if ($modality==null) return 0;
        return $modality->pivot->priority;
    }

    public function setPriorityAttribute($value)
    {
        $anno=getUserAnnoSession();
        $anno->schoolModalities()->updateExistingPivot($this->id, ['priority' => $value]);
    }

    public function getAvailableAttribute()
    {

        $anno=getUserAnnoSession();
        $modality=$anno->schoolModalities->where('id', $this->id)->first();
        if ($modality==null) return null;
        return $modality->pivot->available;

    }

    public function setAvailableAttribute($value)
    {
        $anno=getUserAnnoSession();
        $anno->schoolModalities()->updateExistingPivot($this->id, ['available' => $value]);
    }


    /**
     * Set Batch
     *
     * @param  String $value
     * @return void
     */
    public function setModalityAttribute($value)
    {
        $this->attributes['modality']=mb_strtoupper($value);
    }

    /**
     * Get Batch
     *
     * @param  String $value
     * @return String
     */
    public function getModalityAttribute($value)
    {
        return mb_strtoupper($value);
    }

    /*******************************************/
    /* Methods
    /*******************************************/

    public function scopeSearch($query, $search)
    {
        return $query->where('modality', 'like', '%'.$search.'%' );
    }
}
