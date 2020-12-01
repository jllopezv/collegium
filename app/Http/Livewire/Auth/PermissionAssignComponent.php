<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\Auth\PermissionGroup;

class PermissionAssignComponent extends Component
{
    public $permissionsselected=[];
    public $permissiongroups;
    public $mode;

    protected $listeners=[
        'permissionsset'    =>  'permissionsSet'
    ];

    public function mount()
    {
        $this->permissiongroups=PermissionGroup::active()->orderBy('priority')->orderBy('group')->get();
        $this->permissionsselected=array_map('strval',$this->permissionsselected);
    }

    public function updatedPermissionsselected()
    {
        $this->emit("permissionschanged", $this->permissionsselected);
    }

    public function permissionsSet($permissions)
    {
        $this->permissionsselected=array_map('strval',$permissions);
    }

    public function render()
    {
        return view('livewire.auth.permissions.permission-assign-component');
    }
}
