<?php

namespace App\Http\Livewire\Crm;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;


class CustomerTypeComponent extends Component
{
    use WithPagination;
    use HasCommon;
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;


    public  $type;

    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',
        'eventfilterorder'      => 'eventFilterOrder',

    ];

    /**
     * Mount function
     *
     * @return void
     */
    public function mount()
    {
        $this->table='customer_types';
        $this->module='crm';
        $this->commonMount();
        // Default order for table
        $this->sortorder='type';
        if ($this->mode=='create')
        {
            // default create options
            $this->loadDefaults();
            $this->multiple=true;
        }

        $this->canShowSortButton=true;

    }

    /**
     * Rules to validate model
     *
     * @return array
     */
    public function validateRules() : array
    {
        return [
            'type'              => 'required|string|max:255|unique:customer_types,type,'.$this->recordid, //|unique:school_grades,grade,'.$this->recordid,
        ];
    }

    public function loadDefaults()
    {

    }

    public function resetForm()
    {
        $this->type='';
        $this->loadDefaults();
    }

    public function loadRecordDef()
    {
        $this->type=$this->record->type;
    }

    public function getKeyNotification($record)
    {
        return ($record->type);
    }

    /**
     * Validate only some fields
     *
     * @return void
     */
    public function validateFields()
    {
        return [
            'type'                  =>  $this->type,
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
            'type'                =>  $this->type,
        ];
    }


    /*********************************
     * Sorts
     */

    public function eventFilterOrder($field, $change)
    {
        if ($change)
        {

            if ($this->sortorder==$field)
            {
                $this->sortorder='-'.$field;
            }
            else
            {
                $this->sortorder=$field;
            }

            $this->refreshDatatable();
        }
    }

}
