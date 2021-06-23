<?php

namespace App\Models\Crm;

use App\Models\Crm\Customer;
use App\Models\Traits\HasOwner;
use App\Models\Traits\HasCommon;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
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
        'ref', 'description',
    ];

    protected $dates= [ 'invoice_date', 'invoice_due' ];

    /*******************************************/
    /* Relationships
    /*******************************************/


    /**
     * Get all customers of the models's invoices
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function customer()
    {
        return $this->morphOne(Customer::class, 'documentable');
    }

    /*******************************************/
    /* Accessors and mutators
    /*******************************************/

    /*******************************************/
    /* Methods
    /*******************************************/

    public function scopeSearch($query, $search)
    {
        return $query->where('ref', 'like', '%'.$search.'%' )
            ->orWhere( 'description', 'like', '%'.$search.'%' );
    }

    /*******************************************/
    /* Actions
    /*******************************************/

}
