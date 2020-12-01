<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class PermissionComponent extends Component
{
    use WithPagination;
    use HasCommon;
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;

    public  $slug;
    public  $name;
    public  $description;
    public  $group;

    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',
        'eventsetgroup'         => 'eventSetGroup',

    ];

    /**
     * Mount function
     *
     * @return void
     */
    public function mount()
    {
        $this->table='permissions';
        $this->module='auth';
        $this->commonMount();
        $this->multiple=true;
        $this->sortorder='slug';
        $this->flashmessageid='permissionsaved';
    }

    /**
     * Rules to validate model
     *
     * @return array
     */
    public function validateRules() : array
    {
        return [
            'slug'          => 'required|string|max:255|unique:permissions,slug,'.$this->recordid,
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string|max:255',
        ];
    }

    /**
     * Event listener to set group value
     *
     * @param  mixed $key
     * @return void
     */
    public function eventSetGroup($key)
    {
        $this->group=$key;
    }

    /**
     * Reset fields of form
     *
     * @return void
     */
    public function resetForm()
    {
        $this->slug='';
        $this->name='';
        $this->description='';
    }

    /**
     * Return the value of the field to notifications
     *
     * @param  mixed $record
     * @return String
     */
    public function getKeyNotification($record)
    {
        return ($record->slug);
    }

    /**
     * Load fields
     *
     * @return void
     */
    public function loadRecordDef()
    {
        $this->slug=$this->record->slug;
        $this->name=$this->record->name;
        $this->description=$this->record->description;
        $this->group=$this->record->group;
        $this->emit('setvalue', 'groupcomponent', $this->group);
    }

    /**
     * Save or Update record data
     *
     * @return void
     */
    public function saveRecord()
    {
        return [
            'slug'              =>  $this->slug,
            'name'              =>  $this->name,
            'description'       =>  $this->description,
            'group'             =>  $this->group,
        ];
    }





}
