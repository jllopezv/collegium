<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Auth\PermissionGroup;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class PermissionGroupComponent extends Component
{
    use WithPagination;
    use HasCommon;
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;

    public  $group;
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
        $this->table='permission_groups';
        $this->module='auth';
        $this->commonMount();
        // Default order for table
        $this->sortorder='priority';
        if ($this->mode=='create') $this->priority=PermissionGroup::count()+1;   // Default falue
    }

    /**
     * Rules to validate model
     *
     * @return array
     */
    public function validateRules() : array
    {
        return [
            'group'      => 'required|string|max:255|unique:permission_groups,group,'.$this->recordid,
            'priority'   => 'required|numeric|min:1',
        ];
    }

    /**
     * Reset fields of form
     *
     * @return void
     */
    public function resetForm()
    {
        $this->group='';

    }

    /**
     * Return the value of the field to notifications
     *
     * @param  mixed $record
     * @return String
     */
    public function getKeyNotification($record)
    {
        return ($record->group);
    }

    /**
     * Load fields
     *
     * @return void
     */
    public function loadRecordDef()
    {
        $this->group=$this->record->group;
        $this->priority=$this->record->priority;
    }

    /**
     * Save or Update record data
     *
     * @return void
     */
    public function saveRecord()
    {
        return [
            'group'     =>  $this->group,
            'priority'  =>  $this->priority,
        ];
    }



}
