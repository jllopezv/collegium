<?php

namespace App\Http\Livewire\Search;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\School\Student;

class SearchStudentsComponent extends Component
{
    use WithPagination;

    public $search;
    private $data=[];
    public $uid;
    public $showdialog=false;

    protected $listeners=[
        'setvalue'              =>  'setValue',
        'showstudentdialog'     =>  'open',
        'hidestudentdialog'     =>  'close',
    ];

    public function open()
    {
        $this->showdialog=true;
    }

    public function close()
    {
        $this->showdialog=false;
        $this->emit('studentdialogclosed');
    }

    public function setValue($uid, $value)
    {
        if ($this->uid==$uid)
        {
            $this->search=$value;
            $this->searchStudent();
        }
    }

    public function searchStudent()
    {
        if ($this->search=='')
        {
            $this->data=[];
            return;
        }
        $this->data=Student::search($this->search)->get();
        if ($this->search=='*') $this->data=Student::all();
        $this->emit('studentsearchupdated', $this->search);

    }

    public function updatedSearch()
    {
        $this->searchStudent();
    }

    public function selectStudent($id)
    {
        //$this->search='';
        $this->emit('studentselected',$id);
        $this->close();
    }

    public function resetDialog()
    {
        $this->close();
        $this->search="";
        $this->emit('studentsearchupdated', $this->search);
    }


    public function render()
    {
        return view('livewire.search.search-students-component', [
            'data'      =>  $this->data,
        ]);
    }
}
