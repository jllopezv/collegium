<?php

namespace App\Models\Crm;

use App\Models\Crm\Customer;
use App\Models\Crm\Employee;
use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\Traits\HasAbilities;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;


class CustomerType extends Model
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

    public function canDeleteRecordCustom()
    {
        return ($this->canBeDeleted());
    }

    public function canBeDeleted()
    {
        $customer=Customer::where('customer_type_id', $this->id)->first();

        return $customer!=null?false:true;
    }
}
