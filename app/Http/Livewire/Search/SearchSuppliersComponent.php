<?php

namespace App\Http\Livewire\Search;

use Livewire\Component;
use App\Models\Crm\Supplier;
use Livewire\WithPagination;

class SearchSuppliersComponent extends Component
{
    use WithPagination;

    public $search;
    private $data=[];
    public $uid;
    public $showdialog=false;

    protected $listeners=[
        'setvalue'              =>  'setValue',
        'showsupplierdialog'    =>  'open',
        'hidesupplierdialog'    =>  'close',
    ];

    public function open()
    {
        $this->showdialog=true;
    }

    public function close()
    {
        $this->showdialog=false;
        $this->emit('supplierdialogclosed');
    }

    public function setValue($uid, $value)
    {
        if ($this->uid==$uid)
        {
            $this->search=$value;
            $this->searchSearch();
        }
    }

    public function searchsupplier()
    {
        if ($this->search=='')
        {
            $this->data=[];
            return;
        }
        $this->data=Supplier::search($this->search)->get();
        if ($this->search=='*') $this->data=Supplier::all();
        $this->emit('suppliersearchupdated', $this->search);

    }

    public function updatedSearch()
    {
        $this->searchSupplier();
    }

    public function selectSupplier($id)
    {
        //$this->search='';
        $this->emit('supplierselected',$id);
        $this->close();
    }

    public function resetDialog()
    {
        $this->close();
        $this->search="";
        $this->emit('suppliersearchupdated', $this->search);
    }


    public function render()
    {
        return view('livewire.search.search-suppliers-component', [
            'data'      =>  $this->data,
        ]);
    }
}
