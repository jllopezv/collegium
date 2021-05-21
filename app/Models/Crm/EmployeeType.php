<?php

namespace App\Models\Crm;

use App\Models\Traits\HasAbilities;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasAllowedActions;
use App\Models\Traits\HasCommon;


class EmployeeType extends Model
{
    use HasActive;
    use HasOwner;
    use HasCommon;
    use HasAllowedActions;
    use HasAbilities;

    /*******************************************/
    /* Properties
    /*******************************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type'
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
        return $query->where('type', 'like', '%'.$search.'%' );
    }
}
