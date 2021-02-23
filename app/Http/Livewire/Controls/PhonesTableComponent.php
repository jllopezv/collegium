<?php

namespace App\Http\Livewire\Controls;

use Livewire\Component;
use Illuminate\Support\Str;

class PhonesTableComponent extends Component
{
    public $phones=[];
    public $mode;
    public $uid;

    protected $listeners=[
        'setphones' => 'setPhones',
    ];

    public function mount()
    {
        if ($this->mode=='create') $this->PhoneAdd();
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
            'phone' =>  '',
            'description'  =>  '',
        ];
        $this->phones[]=$newphone;
    }

    public function PhoneDelete($index)
    {
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
