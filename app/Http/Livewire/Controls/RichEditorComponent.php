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

    protected $listeners=[
        'richeditor-update' =>  'updateValue',
        'setvalue'  =>  'setValue',
        'getvalue'  =>  'getValue',
    ];

    public function updateValue($modelid, $value)
    {
        if ($modelid==$this->modelid || $modelid=='*')
        {
            $this->content=$value;
            $this->emit($this->event,$value);
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

    public function getValue($modelid)
    {
        if ($modelid==$this->modelid || $modelid=='*')
        {
            $this->emit( $this->event, $this->content );
        }
    }


    public function render()
    {
        return view('livewire.rich-editor-component');
    }
}
