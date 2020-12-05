<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\Auth\Role;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class RoleComponent extends Component
{
    use WithPagination;
    use HasCommon;
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;

    public  $role;
    public  $level;
    public  $dashboard;
    public  $color_id;
    public  $quota;
    public  $unlimited_quota;
    public  $permissions=[];

    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',
        'eventsetcolor'         => 'eventSetColor',
        'permissionschanged'    => 'permissionsChanged',
    ];

    /**
     * Mount function
     *
     * @return void
     */
    public function mount()
    {
        $this->table='roles';
        $this->module='auth';
        $this->commonMount();
        $this->multiple=true;
        // Default order for table
        $this->sortorder='level';
        $this->flashmessageid='rolesaved';
        if ($this->mode=='create')
        {
            //$this->level=config('lopsoft.maxlevelVIPUsers');
            $this->level=Role::active()->select('level')->pluck('level')->max()+1;
        }
    }

    public function getQueryData()
    {
        return $this->model::with([ 'color', 'permissions' ]);
    }

    /**
     * Rules to validate model
     *
     * @return array
     */
    public function validateRules() : array
    {
        return [
            'role'              => 'required|string|max:255|unique:roles,role,'.$this->recordid,
            'level'             => 'required|numeric|max:50000|unique:roles,level,'.$this->recordid,
            'dashboard'         => 'string',
            'color_id'          => 'exists:colors,id'              // Validte foreignid
            //'quota'             => 'integer',
            //'unlimited_quota'   => 'boolean'
        ];
    }

    public function resetForm()
    {
        $this->role='';
        $this->level=config('lopsoft.maxlevelVIPUsers');
        $this->dashboard='';
        $this->color_id=null;
        $this->quota=10000000;
        $this->unlimited_quota=false;
        $this->permissions=[];
        $this->emit("permissionsset", $this->permissions);
        $this->emit("eventsetcolor", $this->color_id);
    }

    public function loadRecordDef()
    {
        $this->role=$this->record->role;
        $this->level=$this->record->level;
        $this->dashboard=$this->record->dashboard;
        $this->color_id=$this->record->color_id;
        $this->quota=$this->record->quota;
        $this->unlimited_quota=$this->record->unlimited_quota;
        $this->permissions=$this->record->permissionsArray();
        $this->emit("permissionsset", $this->permissions);
        $this->emit("eventsetcolor", $this->color_id);
    }

    public function getKeyNotification($record)
    {
        return ($record->role);
    }

    /**
     * Event listener to set dropdown value
     *
     * @param  mixed $key
     * @return void
     */
    public function eventSetColor($key)
    {
        $this->color_id=$key;
        $this->emit('setvalue','colorcomponent', $key);
    }

    /**
     * Save or Update record data
     *
     * @return void
     */
    public function saveRecord()
    {
        return [
            'role'              =>  $this->role,
            'level'             =>  $this->level,
            'dashboard'         =>  $this->dashboard,
            'color_id'          =>  $this->color_id,
        ];
    }

    public function postStore($recordstored)
    {
        $recordstored->permissions()->sync($this->permissions);
    }

    public function postUpdate($recordupdated)
    {
        $recordupdated->permissions()->sync($this->permissions);
    }

    public function permissionsChanged($permissions)
    {
        $this->permissions=array_map('intval',$permissions);
    }

    public function setDataFilter()
    {
        $this->data->where('level','>=', Auth::user()->level);
    }


}
