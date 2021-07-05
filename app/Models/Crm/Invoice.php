<?php

namespace App\Models\Crm;

use App\Models\Aux\Currency;
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
        'ref', 'serie', 'description', 'invoice_date', 'invoice_due', 'currency_id',
        'source_code', 'source_source', 'source_rnc', 'source_address1', 'source_address2',
        'source_city', 'source_state', 'source_pbox', 'country_id',
        'notes_ext', 'notes_int',
        'subtotal', 'discount', 'discount_percent', 'taxes', 'total', 'paid', 'pending', 'latefee'
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
        return $this->morphOne(Customer::class, 'invoiceable');
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

    public function getTotalStringAttribute()
    {
        $currency=Currency::find($this->currency_id);
        if ($currency==null) return $this->total;
        return $currency->getString($this->total);
    }

    public function getPaidStringAttribute()
    {
        $currency=Currency::find($this->currency_id);
        if ($currency==null) return $this->paid;
        return $currency->getString($this->paid);
    }

    public function getPendingStringAttribute()
    {
        $currency=Currency::find($this->currency_id);
        if ($currency==null) return $this->pending;
        return $currency->getString($this->pending);
    }

    /*******************************************/
    /* Methods
    /*******************************************/

    public function scopeSearch($query, $search)
    {
        return $query->where('ref', 'like', '%'.$search.'%' )
            ->orWhere( 'description', 'like', '%'.$search.'%' );
    }

    public function status($textsize='text-xs')
    {
        $text=transup('pending');
        $textclass='bg-red-600 '.$textsize.' text-white font-bold rounded-md';
        switch($this->status)
        {
            case 2:
                $text=transup('pending');
                $textclass='bg-red-600 '.$textsize.' text-white font-bold rounded-md';
                break;
            case 4:
                $text=transup('paid');
                $textclass='bg-green-400 '.$textsize.' text-white font-bold rounded-md';
                break;
            case 1:
                $text=transup('invoice_due');
                $textclass='bg-blue-600 '.$textsize.' text-white font-bold rounded-md';
                break;
            case 3:
                $text=transup('partial');
                $textclass='bg-yellow-300 '.$textsize.' text-white font-bold rounded-md';
                break;
        }
        return "<span class='px-2 $textclass'>$text</span>";
    }


    /*******************************************/
    /* Actions
    /*******************************************/


}
