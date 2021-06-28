<?php

namespace App\Http\Livewire\Crm;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Crm\InvoiceLine;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;


class InvoiceComponent extends Component
{
    /* Common */
    use WithPagination;
    use HasCommon;


    /* Messages */
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;

    public $ref='';
    public $description='';
    public $currency_id;
    public $subtotal;
    public $discount;
    public $discount_percent;
    public $taxes;
    public $total;
    public $invoiceable_type=null;
    public $invoiceable_id=null;
    public $lines=null;
    public $invoice_source;

    /* Customers */

    public $showCustomers=false;
    public $searchcustomer='';
    public $customer_id;


    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',
        'eventsetcountry'       => 'eventSetCountry',
        'eventsettype'          => 'eventSetType',
        'eventsetphones'        => 'eventSetPhones',
        'eventsetuserprofileemail' => 'eventSetUserProfileEmail',
        'eventsetbirth'         => 'eventSetBirth',


        /* Invoice */
        'invoicedataupdated'    =>  'invoiceDataSync',
        'dropdownupdated'       =>  'dropdownSync',

        /* Customers */

        'hidesearchdialog'        => 'hideCustomersDialog',
        'customersearchupdated'   => 'customerSearchUpdated',
        'customerdialogclosed'    => 'customerDialogClosed',
        'customerselected'        => 'customerSelected',

    ];

    /**
     * Mount function
     *
     * @return void
     */
    public function mount()
    {
        $this->table='invoices';
        $this->module='crm';
        $this->commonMount();
        $this->multiple=true;

        // Default order for table
        $this->sortorder='invoice_date';
        if ($this->mode=='create')
        {
            // default create options
            $this->loadDefaults();
        }
        $this->lines=collect([]);

        $this->invoice_source=transup('customers');


   }

    /**
     * Rules to validate model
     *
     * @return array
     */
    public function validateRules() : array
    {
        return [
            'ref'                   => 'required|string|max:255|unique:invoices,ref,'.$this->recordid,
        ];
    }

    public function loadDefaults()
    {

    }

    public function resetForm()
    {
        $this->ref='';
        $this->description='';
        $this->lines=collect([]); // Make emit event
        $this->emit('setvaluelines', 'invoiceinlinecomponent', $this->lines);
    }

    public function loadRecordDef()
    {
        $this->ref=$this->record->ref;
        $this->description=$this->record->description;
        $this->rnc=$this->record->rnc;
        $this->lines=$this->record->lines->toArray();

    }


    public function getKeyNotification($record)
    {
        return ($record->ref);
    }

    /**
     * Validate only some fields
     *
     * @return void
     */
    public function validateFields()
    {
        return [
            'ref'                   => $this->ref,
        ];
    }

    /**
     * Save or Update record data
     *
     * @return void
     */
    public function saveRecord()
    {
        return [
            'ref'                    => $this->ref,
            'description'            => $this->description,
            'currency_id'            => $this->currency_id,
            'subtotal'               => $this->subtotal,
            'discount'               => $this->discount,
            'discount_percent'       => $this->discount_percent,
            'taxes'                  => $this->taxes,
            'total'                  => $this->total,

       ];
    }

    public function eventSetCountry($country, $change)
    {
        $this->country_id=$country;
    }

    public function eventSetType($type_id, $change)
    {
        $this->customer_type_id=$type_id;
    }


    public function invoiceDataSync($data)
    {
        $this->lines=$data['lines'];
        $this->currency_id=$data['currency_id'];
        $this->subtotal=$data['subtotal'];
        $this->taxes=$data['taxes'];
        $this->discount=$data['discount'];
        $this->discount_percent=$data['discount_percent'];
        $this->total=$data['total'];
    }

    public function dropdownSync($uid, $value)
    {
        if ($uid=='invoicecurrency')
        {
            $this->currency_id=$value;
        }
    }

    public function postStore($storedRecord)
    {
        // Save Invoice Lines

        //New lines with id=0
        foreach($this->lines as $line)
        {
            if ($line['id']==0)
            {
                $row=InvoiceLine::create([
                    'code'                  =>  $line['code'],
                    'item'                  =>  $line['item'],
                    'currency_id'           =>  $line['currency_id'],
                    'quantity'              =>  $line['quantity'],
                    'price'                 =>  $line['price'],
                    'discount'              =>  $line['discount'],
                    'discount_percent'      =>  $line['discount_percent'],
                    'tax'                   =>  $line['tax'],
                    'amount'                =>  $line['amount'],
                    'invoice_id'            =>  $storedRecord->id,
                ]);
            }
        }
    }

    public function postUpdate($updatedRecord)
    {
        // Save Invoice Lines

        // Deleted lines
        $invoicelines=collect($this->lines)->pluck('id');
        InvoiceLine::where('invoice_id', $updatedRecord->id)->whereNotIn('id',$invoicelines)->delete();

        //New lines with id=0
        foreach($this->lines as $line)
        {
            if ($line['id']==0)
            {
                $row=InvoiceLine::create([
                    'code'                  =>  $line['code'],
                    'item'                  =>  $line['item'],
                    'currency_id'           =>  $line['currency_id'],
                    'quantity'              =>  $line['quantity'],
                    'price'                 =>  $line['price'],
                    'discount'              =>  $line['discount'],
                    'discount_percent'      =>  $line['discount_percent'],
                    'tax'                   =>  $line['tax'],
                    'amount'                =>  $line['amount'],
                    'invoice_id'            =>  $updatedRecord->id,
                ]);
            }
            else
            {
                $row=InvoiceLine::where('id',$line['id'])->update([
                    'code'                  =>  $line['code'],
                    'item'                  =>  $line['item'],
                    'currency_id'           =>  $line['currency_id'],
                    'quantity'              =>  $line['quantity'],
                    'price'                 =>  $line['price'],
                    'discount'              =>  $line['discount'],
                    'discount_percent'      =>  $line['discount_percent'],
                    'tax'                   =>  $line['tax'],
                    'amount'                =>  $line['amount'],
                    'invoice_id'            =>  $updatedRecord->id,
                ]);
            }
        }
    }

    /* Search Customers */

    public function customerDialogClosed()
    {
        $this->showCustomers=false;
    }

    public function customerSearchUpdated($search)
    {
        $this->searchcustomer=$search;
    }

    public function showCustomersDialog()
    {
        $this->emit('showcustomerdialog');
        $this->showCustomers=true;
    }
    public function hideCustomersDialog()
    {
        $this->emit('hidecustomerdialog');
    }

    public function customerSelected($id)
    {
        $this->customer_id=$id;
    }

}
