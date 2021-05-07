<?php

namespace App\Http\Livewire\Search;

use Livewire\Component;
use App\Models\School\SchoolParent;
use Livewire\WithPagination;

class SearchSchoolParentsComponent extends Component
{
    use WithPagination;

    public $search;
    private $data=[];
    public $uid;
    public $showdialog=false;

    protected $listeners=[
        'setvalue'  =>  'setValue',
        'showparentdialog'  =>  'open',
        'hideparentdialog'  =>  'close',
    ];

    public function open()
    {
        $this->showdialog=true;
    }

    public function close()
    {
        $this->showdialog=false;
        $this->emit('parentdialogclosed');
    }

    public function setValue($uid, $value)
    {
        if ($this->uid==$uid)
        {
            $this->search=$value;
            $this->searchParent();
        }
    }

    public function searchParent()
    {
        if ($this->search=='')
        {
            $this->data=[];
            return;
        }
        $this->data=SchoolParent::search($this->search)->get();
        $this->emit('parentsearchupdated', $this->search);

    }

    public function updatedSearch()
    {
        $this->searchParent();
    }

    public function selectParent($id)
    {
        //$this->search='';
        $this->emit('parentselected',$id);
        $this->close();
    }

    public function resetDialog()
    {
        $this->close();
        $this->search="";
        $this->emit('parentsearchupdated', $this->search);
    }


    public function render()
    {
        return view('livewire.search.search-school-parents-component', [
            'data'      =>  $this->data,
        ]);
    }
}
