<?php

namespace App\Http\Livewire\School;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\School\SchoolModality;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\HasPriority;
use App\Http\Livewire\Traits\HasAvailable;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAnnoSupport;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class SchoolModalityComponent extends Component
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

    public  $modality;

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
        $this->table='school_modalities';
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
            'modality'          => 'required|string|max:255',
            'priority'          => 'required|numeric',
        ];
    }

    public function loadDefaults()
    {
        $anno=getUserAnnoSession();
        $modalities=$anno->schoolModalities;
        $this->priority=max(count($modalities), $modalities->max('pivot.priority'))+1;
    }

    public function resetForm()
    {
        $this->priority='';
        $this->modality='';
        $this->loadDefaults();
    }

    public function loadRecordDef()
    {
        $this->batch=$this->record->batch;
        $this->priority=$this->record->priority;
    }

    public function getKeyNotification($record)
    {
        return ($record->modality);
    }

    /**
     * Validate only some fields
     *
     * @return void
     */
    public function validateFields()
    {
        return [
            'modality'              =>  $this->modality,
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
            'modality'                 =>  $this->modality,
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
            $subset=getUserAnnoSession()->schoolModalities();
        }
        else
        {
            $subset=SchoolModality::query();
            $this->resetFilter();
        }
        return $this->annoSupportForceGetQueryData($ret, $subset );
    }

    public function activateRecordInAnnoAction($id)
    {
        $anno=getUserAnnoSession();
        $item=$this->model::find($id);
        $anno->schoolModalities()->attach($id);
    }

    public function deactivateRecordInAnnoAction($id)
    {
        $anno=getUserAnnoSession();
        $anno->schoolModalities()->detach($id);
    }
}
