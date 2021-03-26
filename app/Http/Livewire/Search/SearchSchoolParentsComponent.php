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

    protected $listeners=[
        'setvalue'  =>  'setValue',
    ];

    public function setValue($uid, $value)
    {
        if ($this->uid==$uid)
        {
            $this->search=$value;
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
    }

    public function updatedSearch()
    {
        $this->searchParent();
    }

    public function selectParent($id)
    {
        $this->search='';
        $this->emit('parentselected',$id);
    }

    public function render()
    {
        return view('livewire.search.search-school-parents-component', [
            'data'      =>  $this->data,
        ]);
    }
}
