<?php

namespace App\Http\Livewire\Search;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\School\Teacher;

class SearchTeachersComponent extends Component
{
    use WithPagination;

    public $search;
    private $data=[];
    public $uid;
    public $showdialog=false;

    protected $listeners=[
        'setvalue'  =>  'setValue',
        'showteacherdialog'  =>  'open',
        'hideteacherdialog'  =>  'close',
    ];

    public function open()
    {
        $this->showdialog=true;
    }

    public function close()
    {
        $this->showdialog=false;
        $this->emit('teacherdialogclosed');
    }

    public function setValue($uid, $value)
    {
        if ($this->uid==$uid)
        {
            $this->search=$value;
            $this->searchTeacher();
        }
    }

    public function searchTeacher()
    {
        if ($this->search=='')
        {
            $this->data=[];
            return;
        }
        $this->data=Teacher::search($this->search)->get();
        $this->emit('teachersearchupdated', $this->search);

    }

    public function updatedSearch()
    {
        $this->searchTeacher();
    }

    public function selectTeacher($id)
    {
        //$this->search='';
        $this->emit('teacherselected',$id);
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
        return view('livewire.search.search-teachers-component', [
            'data'      =>  $this->data,
        ]);
    }
}
