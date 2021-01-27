<?php

namespace App\Http\Livewire\Setting;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class ModelConfigComponent extends Component
{
    use WithPagination;
    use HasCommon;
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;

    public $configable_type;
    public $configable_id;
    public $datafield;

    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',
    ];

    /**
     * Mount function
     *
     * @return void
     */
    public function mount()
    {
        $this->table='model_configs';
        $this->module='setting';
        $this->commonMount();
        // Default order for table
        $this->sortorder='id';
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
            'configable_type'       =>  'required|max:255',
            'configable_id'         =>  'required|numeric',
        ];
    }

    public function loadDefaults()
    {
        $this->configable_type='';
        $this->configable_id='';
        $this->datafield='';
    }

    public function resetForm()
    {
        $this->loadDefaults();
    }

    public function loadRecordDef()
    {
        $this->configable_type=$this->record->configable_type;
        $this->configable_id=$this->record->configable_id;
        $this->datafield=$this->record->data;
    }

    public function getKeyNotification($record)
    {
        return ($record->id);
    }

    /**
     * Save or Update record data
     *
     * @return void
     */
    public function saveRecord()
    {
        return [
            'configable_type'       =>  $this->configable_type,
            'configable_id'         =>  $this->configable_id,
            'data'                  =>  $this->datafield,
        ];
    }

}
