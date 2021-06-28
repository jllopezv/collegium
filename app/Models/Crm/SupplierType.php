<?php

namespace App\Models\Crm;

use App\Models\Crm\Supplier;
use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\Traits\HasAbilities;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;


class SupplierType extends Model
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
        $supplier=Supplier::where('supplier_type_id', $this->id)->first();

        return $supplier!=null?false:true;
    }
}
