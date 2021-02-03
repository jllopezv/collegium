<?php

namespace App\Http\Livewire\School;

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

    public  $level;
    public  $priority;

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
            'level'             => 'required|string|max:255|unique:school_levels,level,'.$this->recordid,
            'priority'         => 'required|numeric',
        ];
    }

    public function loadDefaults()
    {
        $levels=SchoolLevel::active()->count();
        $this->priority=$levels+1;
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
     * Save or Update record data
     *
     * @return void
     */
    public function saveRecord()
    {
        return [
            'level'                 =>  $this->level,
            'priority'             =>  $this->priority,
        ];
    }


    public function updated()
    {
        $record=new SchoolLevel;
        $record->level=$this->level;
        $record->priority=$this->priority;
    }

}
