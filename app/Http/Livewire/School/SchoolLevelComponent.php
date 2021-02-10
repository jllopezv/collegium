<?php

namespace App\Http\Livewire\School;

use App\Http\Livewire\Traits\HasAvailable;
use Livewire\Component;
use App\Models\School\Anno;
use Livewire\WithPagination;
use App\Models\School\SchoolLevel;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\HasAvatar;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\HasPriority;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class SchoolLevelComponent extends Component
{
    use WithPagination;
    use HasCommon;
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;
    use HasPriority;
    use HasAvailable;

    public  $level;

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
        $this->table='school_levels';
        $this->module='school';
        $this->commonMount();
        $this->multiple=true;
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
            'level'             => 'required|string|max:255',//|unique:school_levels,level,'.$this->recordid,
            'priority'          => 'required|numeric',
        ];
    }

    public function loadDefaults()
    {
        $anno=getUserAnnoSession();
        $levels=$anno->schoolLevels;
        $this->priority=max(count($levels), $levels->max('pivot.priority'))+1;
    }

    public function resetForm()
    {
        $this->priority='';
        $this->level='';
        $this->loadDefaults();
    }

    public function loadRecordDef()
    {
        $this->level=$this->record->level;
        $this->priority=$this->record->priority;
    }

    public function getKeyNotification($record)
    {
        return ($record->level);
    }

    /**
     * Validate only some fields
     *
     * @return void
     */
    public function validateFields()
    {
        return [
            'level'                 =>  $this->level,
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
            'level'                 =>  $this->level,
        ];
    }


    public function updated()
    {
        $record=new SchoolLevel;
        $record->level=$this->level;
        $record->priority=$this->priority;
    }

    public function showStudentsLevel($id)
    {
        return redirect()->route('showstudentslevel', ['id' => $id]);
    }

    public function postStore($storedRecord)
    {
        $storedRecord->priority=$this->priority;    // Pivot value
    }

    public function postUpdate($updatedRecord)
    {
        $updatedRecord->priority=$this->priority;    // Pivot value
    }


}
