<?php

namespace App\Http\Livewire\Controls;

use Livewire\Component;
use Illuminate\Support\Str;

class PhonesTableComponent extends Component
{
    public $phones=[];
    public $mode;
    public $uid;
    public $model;

    protected $listeners=[
        'setphones' => 'setPhones',
    ];

    public function mount()
    {
        if ($this->mode=='create') $this->PhoneAdd();
        if ($this->mode=='edit' && count($this->phones)==0) $this->PhoneAdd();
    }

    public function setPhones($uid, $phones)
    {
        if ($this->uid==$uid)
        {
            $this->phones=$phones;
        }

    }

    public function PhoneAdd()
    {
        $newphone=[
            'id'            =>  0,
            'phone'         =>  '',
            'description'   =>  '',
        ];
        $this->phones[]=$newphone;
    }

    public function PhoneDelete($index)
    {
        $this->model::where('id', $this->phones[$index]['id'])->delete();
        $this->updatedPhones();
        array_splice($this->phones,$index,1);
    }

    public function updatedPhones()
    {
        $this->emit('eventsetphones',$this->phones);
    }

    public function render()
    {
        return view('livewire.controls.phones-table-component');
    }
}
