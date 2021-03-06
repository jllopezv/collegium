<?php

namespace App\Http\Livewire\School;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\School\SchoolBatch;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\HasPriority;
use App\Http\Livewire\Traits\HasAvailable;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithAnnoSupport;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class SchoolBatchComponent extends Component
{
    use WithPagination;
    use HasCommon;
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;
    use HasPriority;
    use HasAvailable;
    use WithAnnoSupport;

    public  $batch;

    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',
        'activateRecordInAnnoAction' => 'activateRecordInAnnoAction',
        'deactivateRecordInAnnoAction' => 'deactivateRecordInAnnoAction',
    ];

    /**
     * Mount function
     *
     * @return void
     */
    public function mount()
    {
        $this->table='school_batches';
        $this->module='school';
        $this->commonMount();
        // Default order for table
        $this->sortorder='priority';
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
            'batch'             => 'required|string|max:255',
            'priority'          => 'required|numeric',
        ];
    }

    public function loadDefaults()
    {
        $anno=getUserAnnoSession();
        $batchs=$anno->schoolBatches;
        $this->priority=max(count($batchs), $batchs->max('pivot.priority'))+1;
    }

    public function resetForm()
    {
        $this->priority='';
        $this->batch='';
        $this->loadDefaults();
    }

    public function loadRecordDef()
    {
        $this->batch=$this->record->batch;
        $this->priority=$this->record->priority;
    }

    public function getKeyNotification($record)
    {
        return ($record->batch);
    }

    /**
     * Validate only some fields
     *
     * @return void
     */
    public function validateFields()
    {
        return [
            'batch'                 =>  $this->batch,
            'priority'              =>  $this->priority,
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
            'batch'                 =>  $this->batch,
        ];
    }

    public function postStore($storedRecord)
    {
        $storedRecord->priority=$this->priority;    // Pivot value
    }

    public function postUpdate($updatedRecord)
    {
        $updatedRecord->priority=$this->priority;    // Pivot value
    }

        /**
     * Anno Support
     */

    public function forceGetQueryData($ret)
    {
        if ($this->showOnlyAnno)
        {
            $subset=getUserAnnoSession()->schoolBatches();
        }
        else
        {
            $subset=SchoolBatch::query();
            $this->resetFilter();
        }
        return $this->annoSupportForceGetQueryData($ret, $subset );
    }

    public function activateRecordInAnnoAction($id)
    {
        $anno=getUserAnnoSession();
        $item=$this->model::find($id);
        $anno->schoolBatches()->attach($id);
    }

    public function deactivateRecordInAnnoAction($id)
    {
        $anno=getUserAnnoSession();
        $anno->schoolBatches()->detach($id);
    }

}
