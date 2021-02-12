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

class SchoolBatch extends Model
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
        'batch', 'priority'
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
        $batch=$anno->schoolBatches->where('id', $this->id)->first();
        if ($batch==null) return 0;
        return $batch->pivot->priority;
    }

    public function setPriorityAttribute($value)
    {
        $anno=getUserAnnoSession();
        $anno->schoolBatches()->updateExistingPivot($this->id, ['priority' => $value]);
    }

    public function getAvailableAttribute()
    {

        $anno=getUserAnnoSession();
        $batch=$anno->schoolBatches->where('id', $this->id)->first();
        if ($batch==null) return null;
        return $batch->pivot->available;

    }

    public function setAvailableAttribute($value)
    {
        $anno=getUserAnnoSession();
        $anno->schoolBatches()->updateExistingPivot($this->id, ['available' => $value]);
    }


    /**
     * Set Batch
     *
     * @param  String $value
     * @return void
     */
    public function setBatchAttribute($value)
    {
        $this->attributes['batch']=mb_strtoupper($value);
    }

    /**
     * Get Batch
     *
     * @param  String $value
     * @return String
     */
    public function getBatchAttribute($value)
    {
        return mb_strtoupper($value);
    }

    /*******************************************/
    /* Methods
    /*******************************************/

    public function scopeSearch($query, $search)
    {
        return $query->where('batch', 'like', '%'.$search.'%' );
    }
}
