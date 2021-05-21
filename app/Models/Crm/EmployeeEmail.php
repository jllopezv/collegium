<?php

namespace App\Models\Crm;

use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use Illuminate\Database\Eloquent\Model;

class EmployeeEmail extends Model
{
    use HasActive;
    use HasOwner;
    use HasCommon;


    /*******************************************/
    /* Properties
    /*******************************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'description', 'notif', 'employee_id'
    ];

    /*******************************************/
    /* Relationships
    /*******************************************/

    /*******************************************/
    /* Accessors and mutators
    /*******************************************/

    /*******************************************/
    /* Methods
    /*******************************************/

    public function scopeSearch($query, $search)
    {
        return $query->where('email', 'like', '%'.$search.'%' )
            ->orWhere('description','like', '%'.$search.'%' );
    }
}
