<?php

namespace App\Models\Crm;

use App\Models\Crm\Customer;
use App\Models\Traits\HasOwner;
use App\Models\Traits\HasCommon;
use Illuminate\Database\Eloquent\Model;

class InvoiceLine extends Model
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
        'id', 'code', 'item', 'invoice_id', 'quantity', 'price', 'discount', 'discount_percent', 'tax', 'amount', 'currency_id'
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

    /*******************************************/
    /* Actions
    /*******************************************/

}
