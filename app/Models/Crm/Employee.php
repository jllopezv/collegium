<?php

namespace App\Models\Crm;

use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\Crm\EmployeePhone;
use App\Models\Traits\IsUserType;
use App\Models\Traits\HasAbilities;
use App\Models\Crm\EmployeeEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Traits\HasAllowedActions;

class Employee extends Model
{
    use HasActive;
    use HasOwner;
    use HasCommon;
    use HasAbilities;
    use HasAllowedActions;
    use IsUserType;


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

    /*******************************************/
    /* Accessors and mutators
    /*******************************************/

    /**
     * Get Avatar, if not exists return defaul avatar
     *
     * @return void
     */
    public function getAvatarAttribute()
    {
        if (is_null($this->profile_photo_path)) return Storage::disk('public')->url(config('lopsoft.default_avatar'));
        if ( !Storage::disk('public')->exists( 'thumbs/'.$this->profile_photo_path ) )
        {
            if ( !Storage::disk('public')->exists( $this->profile_photo_path ) )
            {
                return Storage::disk('public')->url(config('lopsoft.default_avatar'));
            }
            else
            {
                return Storage::disk('public')->url( $this->profile_photo_path );
            }
        }
        return Storage::disk('public')->url( 'thumbs/'.$this->profile_photo_path );
    }

    /**
     * Set avatar path for user
     *
     * @param  mixed $value
     * @return void
     */
    public function setAvatarAttribute($value)
    {
        $this->profile_photo_path=$value;
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
