<?php

namespace App\Http\Livewire\Crm;

use Livewire\Component;
use App\Models\Crm\Customer;
use App\Models\Crm\Supplier;
use Livewire\WithPagination;
use App\Models\School\Student;
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

    public $ref='-';
    public $description='';
    public $invoice_date;
    public $invoice_due;
    public $currency_id;
    public $subtotal;
    public $discount;
    public $discount_percent;
    public $taxes;
    public $total;
    public $invoiceable_type=null;
    public $invoiceable_id=null;
    public $lines=null;
    public $invoice_source='';
    public $invoice_source_id=0;
    public $invoiceowner=null;
    public $hideselectsource=false;

    public $showSourceData=false;

    /* Customers */

    public $showCustomers=false;
    public $showCustomersSearch=false;
    public $searchcustomer='';

    /* Suppliers */

    public $showSuppliers=false;
    public $showSuppliersSearch=false;
    public $searchsupplier='';

    /* Students */

    public $showStudents=false;
    public $showStudentsSearch=false;
    public $searchstudent='';
    public $student=null;

    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',


        'eventsetcountry'               => 'eventSetCountry',
        'eventsettype'                  => 'eventSetType',
        'eventsetuserprofileemail'      => 'eventSetUserProfileEmail',
        'eventsetinvoicedate'           => 'eventSetInvoiceDate',
        'eventsetinvoicedue'            => 'eventSetInvoiceDue',


        /* Invoice */
        'invoicedataupdated'            =>  'invoiceDataSync',
        'dropdownupdated'               =>  'dropdownSync',

        /* Customers */

        'customerhidesearchdialog'      => 'hideCustomersDialog',
        'customersearchupdated'         => 'customerSearchUpdated',
        'customerdialogclosed'          => 'customerDialogClosed',
        'customerselected'              => 'customerSelected',

        /* Suppliers */

        'supplierhidesearchdialog'      => 'hideSuppliersDialog',
        'suppliersearchupdated'         => 'supplierSearchUpdated',
        'supplierdialogclosed'          => 'supplierDialogClosed',
        'supplierselected'              => 'supplierSelected',

        /* Students */

        'studenthidesearchdialog'      => 'hideStudentsDialog',
        'studentsearchupdated'         => 'studentSearchUpdated',
        'studentdialogclosed'          => 'studentDialogClosed',
        'studentselected'              => 'studentSelected',

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

        if ($this->invoice_source=='')
        {
            $this->invoice_source='customers';
        }
        else
        {
            if ($this->invoice_source=='customers') $this->customerSelected($this->invoice_source_id);
            if ($this->invoice_source=='suppliers') $this->supplierSelected($this->invoice_source_id);
            if ($this->invoice_source=='students') $this->studentSelected($this->invoice_source_id);
        }

        if ($this->mode=='show' || $this->mode=='edit')
        {
            $this->hideselectsource=true; // Cant modify this part
        }
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
        $this->ref='-';
        $this->description='';
        $this->lines=collect([]); // Make emit event
        $this->emit('setvaluelines', 'invoiceinlinecomponent', $this->lines);
    }

    public function loadRecordDef()
    {
        $this->ref=$this->record->ref;
        $this->description=$this->record->description;
        $this->currency_id=$this->record->currency_id;
        $this->invoice_date=$this->record->invoice_date;
        //$this->emit('setvalue', 'invoicedatecomponent', getDateString($this->invoice_date));
        $this->invoice_due=$this->record->invoice_due;
        //$this->emit('setvalue', 'invoiceduecomponent', getDateString($this->invoice_due));
        $this->lines=$this->record->lines->toArray();

        /* Load Customer data */

        $this->invoiceowner=[];
        $this->invoiceowner['code']=$this->record->source_code;
        if ($this->record->invoiceable_type==Customer::class)
        {
            $this->invoiceowner['customer']=$this->record->source_source;
        }
        if ($this->record->invoiceable_type==Supplier::class)
        {
            $this->invoiceowner['supplier']=$this->record->source_source;
        }
        if ($this->record->invoiceable_type==Student::class)
        {
            $this->invoiceowner['customer']=$this->record->source_source;
            $this->student=Student::find($this->record->invoiceable_id);
        }
        $this->invoiceowner['rnc']=$this->record->source_rnc;
        $this->invoiceowner['address1']=$this->record->source_address1;
        $this->invoiceowner['address2']=$this->record->source_address2;
        $this->invoiceowner['city']=$this->record->source_city;
        $this->invoiceowner['state']=$this->record->source_state;
        $this->invoiceowner['pbox']=$this->record->source_pbox;
        $this->invoiceowner['country_id']=$this->record->country_id;


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
            'invoice_date'           => $this->invoice_date,
            'invoice_due'            => $this->invoice_due,
            'currency_id'            => $this->currency_id,
            'source_code'            => $this->invoiceowner['code'],
            'source_rnc'             => $this->invoiceowner['rnc'],
            'source_source'          => ( $this->invoice_source=='customers' || $this->invoice_source=='students' )?$this->invoiceowner['customer']:$this->invoiceowner['supplier'],
            'source_address1'        => $this->invoiceowner['address1'],
            'source_address2'        => $this->invoiceowner['address2'],
            'source_city'            => $this->invoiceowner['city'],
            'source_state'           => $this->invoiceowner['state'],
            'source_pbox'            => $this->invoiceowner['pbox'],
            'country_id'             => $this->invoiceowner['country_id'],
            'subtotal'               => $this->subtotal,
            'discount'               => $this->discount,
            'discount_percent'       => $this->discount_percent,
            'taxes'                  => $this->taxes,
            'total'                  => $this->total,
            'paid'                   => 0,
            'pending'                => $this->total,
            'status'                 => 2, // Pending

       ];
    }

    public function generateCodeStore()
    {
        if ($this->ref=='-')
        {
            $newcode=$this->generateNewCode(
                'ref',
                appsetting('invoices_ref_prefix'),
                appsetting('invoices_ref_long'),
                appsetting('invoices_ref_sufix')
            );

            $this->ref=$newcode;
        }
    }



    /* Events */

    public function eventSetInvoiceDate($date)
    {
        if ($date!=null)
        {
            $this->invoice_date=getDateFromFormat($date);
        }

    }

    public function eventSetInvoiceDue($date)
    {
        if ($date!=null)
        {
            $this->invoice_due=getDateFromFormat($date);
        }

    }

    public function eventSetCountry($country, $change)
    {
        if ($this->invoiceowner==null) return;
        $this->invoiceowner['country_id']=$country;
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
                    'quantity'              =>  $this->normalizeNumber($line['quantity']),
                    'price'                 =>  $this->normalizeNumber($line['price']),
                    'discount'              =>  $this->normalizeNumber($line['discount']),
                    'discount_percent'      =>  $line['discount_percent'],
                    'tax'                   =>  $this->normalizeNumber($line['tax']),
                    'amount'                =>  $this->normalizeNumber($line['amount']),
                    'invoice_id'            =>  $storedRecord->id,
                ]);
            }
        }

        // Attach invoice

        if ($this->invoice_source=='customers')
        {
            $source=Customer::find($this->invoice_source_id);
        }

        if ($this->invoice_source=='suppliers')
        {
            $source=Supplier::find($this->invoice_source_id);
        }

        if ($this->invoice_source=='students')
        {
            $source=Student::find($this->invoice_source_id);
        }

        $source->invoices()->save($storedRecord);
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
                    'quantity'              =>  $this->normalizeNumber($line['quantity']),
                    'price'                 =>  $this->normalizeNumber($line['price']),
                    'discount'              =>  $this->normalizeNumber($line['discount']),
                    'discount_percent'      =>  $line['discount_percent'],
                    'tax'                   =>  $this->normalizeNumber($line['tax']),
                    'amount'                =>  $this->normalizeNumber($line['amount']),
                    'invoice_id'            =>  $updatedRecord->id,
                ]);
            }
            else
            {
                $row=InvoiceLine::where('id',$line['id'])->update([
                    'code'                  =>  $line['code'],
                    'item'                  =>  $line['item'],
                    'currency_id'           =>  $line['currency_id'],
                    'quantity'              =>  $this->normalizeNumber($line['quantity']),
                    'price'                 =>  $this->normalizeNumber($line['price']),
                    'discount'              =>  $this->normalizeNumber($line['discount']),
                    'discount_percent'      =>  $line['discount_percent'],
                    'tax'                   =>  $this->normalizeNumber($line['tax']),
                    'amount'                =>  $this->normalizeNumber($line['amount']),
                    'invoice_id'            =>  $updatedRecord->id,
                ]);
            }
        }
    }

    public function updatedInvoiceSource()
    {
        $this->showCustomers=false;
        $this->showSuppliers=false;
        $this->invoice_source_id=0;
        $this->invoiceowner=null;
    }

    public function showSourceDataInfo()
    {
        $this->showSourceData=true;
    }

    public function hideSourceDataInfo()
    {
        $this->showSourceData=false;
    }

    public function checkSource()
    {
        if ($this->invoice_source=='customers')
        {
            $this->showCustomersSearch=true;
            $this->showSuppliersSearch=false;
            $this->showStudentsSearch=false;
        }
        if ($this->invoice_source=='suppliers')
        {
            $this->showCustomersSearch=false;
            $this->showSuppliersSearch=true;
            $this->showStudentsSearch=false;
        }
        if ($this->invoice_source=='students')
        {
            $this->showCustomersSearch=false;
            $this->showSuppliersSearch=false;
            $this->showStudentsSearch=true;
        }
    }

    public function normalizeNumber($value)
    {
        $retvalue=$value;
        //Trim
        $retvalue=trim($retvalue);
        //Only numbers
        $retvalue=preg_replace("/[a-zA-Z,]/","",$retvalue);
        //Double
        $retvalue=doubleval($retvalue);
        return $retvalue;
    }



    /* Search Customers */

    public function customerDialogClosed()
    {
        $this->showCustomers=false;
        $this->showCustomersSearch=false;
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
        $this->invoice_source_id=$id;
        $this->invoiceowner=Customer::find($id)->toArray();
        $this->emit('setvalue', 'countrycomponent', $this->invoiceowner['country_id']);
    }

    /* Search Suppliers */

    public function supplierDialogClosed()
    {
        $this->showSuppliers=false;
        $this->showSuppliersSearch=false;
    }

    public function supplierSearchUpdated($search)
    {
        $this->searchsupplier=$search;
    }

    public function showSuppliersDialog()
    {
        $this->emit('showsupplierdialog');
        $this->showSuppliers=true;
    }
    public function hideSuppliersDialog()
    {
        $this->emit('hidesupplierdialog');
    }

    public function supplierSelected($id)
    {
        $this->invoice_source_id=$id;
        $this->invoiceowner=Supplier::find($id)->toArray();
        $this->emit('setvalue', 'countrycomponent', $this->invoiceowner['country_id']);
    }

    /* Search Students */

    public function studentDialogClosed()
    {
        $this->showStudents=false;
        $this->showStudentsSearch=false;
    }

    public function studentSearchUpdated($search)
    {
        $this->searchsupplier=$search;
    }

    public function showStudentsDialog()
    {
        $this->emit('showstudentdialog');
        $this->showStudents=true;
    }
    public function hideStudentsDialog()
    {
        $this->emit('hidestudentdialog');
    }

    public function studentSelected($id)
    {
        $this->invoice_source_id=$id;
        $this->student=Student::find($id);
        if ( $this->student==null ) return;
        $this->invoiceowner=Customer::find($this->student->customer_id)->toArray(); // Student's customer
        $this->student=$this->student->toArray();
        $this->emit('setvalue', 'countrycomponent', $this->invoiceowner['country_id']);
    }

}
