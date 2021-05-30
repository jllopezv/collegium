<?php

namespace App\Http\Livewire\Controls;

use Livewire\Component;
use Illuminate\Support\Arr;


class IndexFilterComponent extends Component
{
    protected $listeners=[
        'setvalue'          =>  'setValue',
        'getvalue'          =>  'getValue',
        'setoptions'        =>  'setOptions',
        'validationerror'   =>  'validationError',
        'enablefilter'      =>  'enableFilter',
    ];

    public $options=[];
    //[ 'value' => '1', 'text' => "<div class='flex items-center justify-start'><div class='pr-1'><img class='w-6 h-auto rounded-full' src='http://collegium.devel:8000/storage/system/userdefault.png' /></div><div><span class=''>OPCION 1</span></div></div>" ],
    public $showcontent=false;
    public $contenttoshow;          // Content to show in select
    public $text;
    public $value;
    public $defaultvalue;
    public $classchevron='';
    public $label;
    public $sublabel="";
    public $requiredfield=false;
    public $help='';
    public $cansearch=false;
    public $classdropdown='w-full';
    public $isTop=false;            // where show seach list
    public $eventname='';
    public $readonly=false;
    public $validationerror='';
    public $uid='';
    public $modelid='';
    public $template='';
    public $mode='';
    public $firsttime=true;
    public $enabled=true;

    public function mount()
    {
        $this->text='';
        $this->index=0;
        if ($this->mode=='show') $this->readonly=true;
        if ($this->readonly || !$this->enabled)
        {
            $this->classchevron='text-gray-300 hover:text-gray-300';
        }
        else
        {
            $this->classchevron='text-gray-300 '.(($this->enabled)?'hover:text-gray-700':'hover:text-gray-300');

        }
        if ($this->defaultvalue!="")
        {
            foreach($this->options as $index => $option)
            {
                if ($option['value']==$this->defaultvalue)
                {
                    $this->value=$option['value'];
                    $this->text=$option['text'];
                    if ($this->template!="")
                    {

                        $this->contenttoshow=view($this->template, [ 'option' => $this->options[$index], 'index' => $index ])->render();
                    }
                    else
                    {
                        $this->contenttoshow=$this->text;
                    }
                }
            }
        }

        $this->classchevron='text-gray-300 '.(($this->enabled)?'hover:text-gray-700':'hover:text-gray-300');
    }

    public function enableFilter($uid, $value)
    {
        if ($uid==$this->uid || $uid=='*')
        {

            $this->enabled=$value;
        }
    }

    public function showbody()
    {
        if (!$this->enabled) return;
        $this->showcontent=true;
        $this->classchevron='text-gray-700';

    }
    public function hidebody()
    {
        if (!$this->enabled) return;
        $this->showcontent=false;
        $this->classchevron='text-gray-300 '.(($this->enabled)?'hover:text-gray-300':'');

    }
    public function togglebody()
    {
        if (!$this->enabled) return;
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

    /**
     * Set value
     *
     * @param  mixed $index
     * @return void
     */
    public function setValue($uid, $value)
    {
        if ($uid==$this->uid || $uid=='*')
        {
            foreach($this->options as $index => $option)
            {
                if ($option['value']==$value)
                {
                    $this->select($index,false);
                }
            }

        }
    }

    public function getValue($uid)
    {
        if ($uid==$this->uid || $uid=='*')
        {
            $this->emit( $this->eventname, $this->value, false );
        }
    }

    public function validationError($errors)
    {
        $this->validationerror='';
        if (Arr::has($errors,$this->modelid))
        {
            $this->validationerror=$errors[$this->modelid][0];
        }
    }

    public function selectchange($index)
    {
        if (!$this->enabled) return;
        $this->select($index,true);
    }

    public function select($index, $change=false)
    {
        if (!$this->enabled) return;
        if (!count($this->options)) return;
        if ($index==null)
        {
            // First Element
            $this->text=$this->options[0]['text'];
            $this->value=$this->options[0]['value'];
        }
        else
        {
            $this->text=$this->options[$index]['text'];
            $this->value=$this->options[$index]['value'];
        }
        $this->showcontent=false;
        if ($this->template!="")
        {
            $this->contenttoshow=view($this->template, [ 'option' => $this->options[$index??0], 'index' => $index??0 ])->render();
        }
        else
        {
            $this->contenttoshow=$this->text;
        }
        $this->emit( $this->eventname, $this->value, $change );
    }

    public function render()
    {
        return view('livewire.controls.index-filter-component');
    }


    public function setOptions($uid, $newoptions)
    {
        if ($uid==$this->uid || $uid=='*')
        {
            $this->options=$newoptions;
            $this->select(null,false); // First Value available
        }
    }
}
