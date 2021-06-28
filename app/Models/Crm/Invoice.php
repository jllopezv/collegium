<?php

namespace App\Models\Crm;

use App\Models\Crm\Customer;
use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\Traits\HasAbilities;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;

class Invoice extends Model
{
    use HasActive;
    use HasOwner;
    use HasCommon;
    use HasAbilities;
    use HasAllowedActions;


    /*******************************************/
    /* Properties
    /*******************************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ref', 'description', 'currency_id',
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

    /**
     * Get invoice lines
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function lines()
    {
        return $this->hasMany(InvoiceLine::class);
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
