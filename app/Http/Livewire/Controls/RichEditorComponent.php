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
    ];

    public function mount()
    {
        $this->content=$this->default;
    }

    public function updateValue($modelid, $value)
    {
        if ($modelid==$this->modelid || $modelid=='*')
        {
            $this->content=$value;
            $this->emit($this->event,$value);
            $this->dispatchBrowserEvent('richeditor-updated');
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
        if ($modelid==$this->modelid || $modelid=='*')
        {
            $this->content=$value;
            $this->emit($this->event,$value);
        }
    }

    public function getValue($modelid, $param=false)
    {
        if ($modelid==$this->modelid || $modelid=='*')
        {
            $this->emit( $this->event, $this->content, $param );
        }
    }

    public function render()
    {
        return view('livewire.rich-editor-component');
    }
}
