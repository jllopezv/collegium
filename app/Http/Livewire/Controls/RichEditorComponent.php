<?php

namespace App\Http\Livewire\Controls;

use Livewire\Component;

class RichEditorComponent extends Component
{
    public $uuid;       // Filemanager uuid to show
    public $modelid;    // Model to store data
    public $content;
    public $default;
    public $label;
    public $sublabel;
    public $event;
    public $mode;

    protected $listeners=[
        'richeditor-update' =>  'updateValue',
        'setvalue'  =>  'setValue',
        'getvalue'  =>  'getValue',
        'setdefault' => 'setDefault',
    ];


    public function mount()
    {
        $this->content=$this->default;
    }

    public function updateValue($modelid, $value, $command=false, $param=false)
    {
        // NO run on "*"
        if ($modelid==$this->modelid)
        {

            $this->content=$value;
            $this->emit($this->event,$value,$command, $param);
            //$this->dispatchBrowserEvent('richeditor-updated', ['modelid' => $modelid]);
        }
    }

    /**
     * Set value
     *
     * @param  mixed $date
     * @return void
     */
    public function setDefault($modelid)
    {
        // NO run on "*"
        if ($modelid==$this->modelid)
        {
            $this->content=$this->default;
            //$this->emit($this->event,$this->default);
            $this->dispatchBrowserEvent('richeditor-setdefault', [ 'modelid' => $modelid, 'content' => $this->default ]);
        }
    }

    /**
     * Set value
     *
     * @param  mixed $date
     * @return void
     */
    public function setValue($modelid, $value)
    {
        // NO run on "*"
        if ($modelid==$this->modelid)
        {
            $this->content=$value;
            $this->emit($this->event,$value);
        }
    }

    public function getValue($modelid, $param=false)
    {
        // NO run on "*"
        if ($modelid==$this->modelid)
        {
            $this->emit( $this->event, $this->content, $param );
        }
    }

    public function render()
    {
        return view('livewire.rich-editor-component');
    }
}
