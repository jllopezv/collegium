<?php

namespace App\Http\Livewire\Crm;

use Livewire\Component;
use Livewire\WithPagination;
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

    public $ref;
    public $description;


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
            'description'           => 'required|string|max:255',
        ];
    }

    public function loadDefaults()
    {

    }

    public function resetForm()
    {
        $this->ref='';
    }

    public function loadRecordDef()
    {
        $this->ref=$this->record->ref;
        $this->description=$this->record->description;
        $this->rnc=$this->record->rnc;

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

}
