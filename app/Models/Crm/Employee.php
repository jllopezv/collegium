<?php

namespace App\Models\Crm;

use App\Models\Aux\Document;
use App\Models\Traits\HasAnno;
use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\Crm\EmployeeEmail;
use App\Models\Crm\EmployeePhone;
use App\Models\Traits\IsUserType;
use App\Models\Traits\HasPriority;
use App\Models\Traits\HasAbilities;
use App\Models\Traits\HasAvailable;
use App\Models\Traits\HasModelAvatar;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;

class Employee extends Model
{
    use HasActive;
    use HasOwner;
    use HasCommon;
    use HasAbilities;
    use HasAllowedActions;

    /* Profile */
    use IsUserType;

    /* Has Avatar */
    use HasModelAvatar;

    /* Anno Support */
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
        'employee', 'address1','address2','city','state','country_id','pbox','notes', 'birth', 'hired', 'degree',
        'profile_photo_path', 'employee_type_id'
    ];

    protected $appends= [ 'avatar' ];

    protected $dates=[ 'birth', 'hired' ];

    /*******************************************/
    /* Relationships
    /*******************************************/

    public function phones()
    {
        return $this->hasMany(EmployeePhone::class,'employee_id');
    }

    public function emails()
    {
        return $this->hasMany(EmployeeEmail::class,'employee_id');
    }

    /**
     * Get all of the models's documents
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    /*******************************************/
    /* Accessors and mutators
    /*******************************************/

    public function getPriorityAttribute()
    {
        $anno=getUserAnnoSession();
        $grade=$anno->employees->where('id', $this->id)->first();
        if ($grade==null) return 0;
        return $grade->pivot->priority;
    }

    public function setPriorityAttribute($value)
    {
        $anno=getUserAnnoSession();
        $anno->employees()->updateExistingPivot($this->id, ['priority' => $value]);
    }

    public function getAvailableAttribute()
    {

        $anno=getUserAnnoSession();
        $grade=$anno->employees->where('id', $this->id)->first();
        if ($grade==null) return null;
        return $grade->pivot->available;

    }

    public function setAvailableAttribute($value)
    {
        $anno=getUserAnnoSession();
        $anno->employees()->updateExistingPivot($this->id, ['available' => $value]);
    }


    public function getTypeAttribute()
    {
        $type=EmployeeType::find($this->employee_type_id);
        if ($type==null) return null;
        return $type;
    }

    /*******************************************/
    /* Methods
    /*******************************************/

    public function scopeSearch($query, $search)
    {
        return $query->where('employee', 'like', '%'.$search.'%' );
    }

    /*******************************************/
    /* Actions
    /*******************************************/

    public function postDelete()
    {
        $this->user->delete();  // Delete asocciated user
    }

    public function postLock()
    {
        $this->user->lock();  // Lock asocciated user
    }

    public function postUnlock()
    {
        $this->user->unlock(); // Unlock assocciated user
    }
}
