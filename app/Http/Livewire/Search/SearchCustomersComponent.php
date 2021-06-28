<?php

namespace App\Http\Livewire\Search;

use Livewire\Component;
use App\Models\Crm\Customer;
use Livewire\WithPagination;

class SearchCustomersComponent extends Component
{
    use WithPagination;

    public $search;
    private $data=[];
    public $uid;
    public $showdialog=false;

    protected $listeners=[
        'setvalue'              =>  'setValue',
        'showcustomerdialog'    =>  'open',
        'hidecustomerdialog'    =>  'close',
    ];

    public function open()
    {
        $this->showdialog=true;
    }

    public function close()
    {
        $this->showdialog=false;
        $this->emit('customerdialogclosed');
    }

    public function setValue($uid, $value)
    {
        if ($this->uid==$uid)
        {
            $this->search=$value;
            $this->searchSearch();
        }
    }

    public function searchCustomer()
    {
        if ($this->search=='')
        {
            $this->data=[];
            return;
        }
        $this->data=Customer::search($this->search)->get();
        $this->emit('customersearchupdated', $this->search);

    }

    public function updatedSearch()
    {
        $this->searchCustomer();
    }

    public function selectCustomer($id)
    {
        //$this->search='';
        $this->emit('customerselected',$id);
        $this->close();
    }

    public function resetDialog()
    {
        $this->close();
        $this->search="";
        $this->emit('customersearchupdated', $this->search);
    }


    public function render()
    {
        return view('livewire.search.search-customers-component', [
            'data'      =>  $this->data,
        ]);
    }
}
