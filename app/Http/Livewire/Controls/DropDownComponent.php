<?php

namespace App\Http\Livewire\Controls;

use Livewire\Component;

/**
 * DropDownComponent
 *
 *  Dropdown for arrayobjects
 */
class DropDownComponent extends Component
{
    public $options=[];
    //[ 'value' => '1', 'text' => "<div class='flex items-center justify-start'><div class='pr-1'><img class='w-6 h-auto rounded-full' src='http://collegium.devel:8000/storage/system/userdefault.png' /></div><div><span class=''>OPCION 1</span></div></div>" ],
    public $showcontent=false;
    public $text;
    public $value;
    public $defaultvalue;
    public $classchevron='';
    public $label;
    public $requiredfield=false;
    public $help='';
    public $cansearch=false;
    public $classdropdown='w-full';
    public $isTop=false;            // where show seach list
    public $eventname='';
    public $readonly=false;

    public function mount()
    {
        $this->text='';
        $this->index=0;
        if ($this->readonly)
        {
            $this->classchevron='text-gray-300 hover:text-gray-300';
        }
        else
        {
            $this->classchevron='text-gray-300 hover:text-gray-700';

        }
        if ($this->defaultvalue!="")
        {
            foreach($this->options as $option)
            {
                if ($option['value']==$this->defaultvalue)
                {
                    $this->value=$option['value'];
                    $this->text=$option['text'];
                }
            }
        }

        $this->classchevron='text-gray-300 hover:text-gray-700';
    }

    public function showbody()
    {
        $this->showcontent=true;
        $this->classchevron='text-gray-700';

    }
    public function hidebody()
    {
        $this->showcontent=false;
        $this->classchevron='text-gray-300 hover:text-gray-700';

    }
    public function togglebody()
    {
        if ($this->readonly) return;
        if (!$this->showcontent)
        {
            $this->showbody();
        }
        else
        {
            $this->hidebody();
        }
    }

    public function select($index)
    {
        $this->text=$this->options[$index]['text'];
        $this->value=$this->options[$index]['value'];;
        $this->showcontent=false;
        $this->emit( $this->eventname, $this->value );
    }

    public function render()
    {
        return view('livewire.controls.drop-down-component');
    }
}
