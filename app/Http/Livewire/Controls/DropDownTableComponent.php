<?php

namespace App\Http\Livewire\Controls;

use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class DropDownTableComponent extends Component
{
    public $uid='';                 // Unique ID in components in page
    public $modelid;                // Bind model
    public $mode='';                // Mode
    public $showcontent=false;      // trigger fot show box content
    public $text;                   // text input value
    public $contenttoshow;          // Content to show in select
    public $value;                  // key selected
    public $defaultvalue;           // default key. null to select first
    public $classchevron='';        // class for chevron ( hover or not hover )
    public $label;                  // label for inputgroup
    public $requiredfield=false;    // show info
    public $help='';                // show help for requiredfield
    public $cansearch=true;         // can show search box
    public $search='';              // string to search
    public $readonly=false;         // Readonly property
    public $validationerror='';     // VAlidation errors
    public $classdropdown='w-full'; // Class for container

    /* table */
    private $data=null;             // data to show
    public $model='';               // Table Model
    public $filterraw='';           // raw applies whereRaw
    public $sortorder='';           // orderby
    public $onlyactives=true;       // Show only active records
    public $key='';                 // key field
    public $field='';               // field to text
    public $template='';            // template to show
    public $eventname='';           // eventname to fire in parent component
    public $isTop=false;            // where show seach list
    public $searchInField=false;     // Search only in indicated field or use search scope of model. If model has translations then set to false.
    public $linknew='';             // Link to create new

    protected $listeners=[
        'setvalue'  =>  'setValue',
        'getvalue'  =>  'getValue',
        'validationerror'   =>  'validationError'
    ];

    /**
     * Initial values
     *
     * @return void
     */
    public function mount()
    {
        if ($this->readonly)
        {
            $this->classchevron='text-gray-300 hover:text-gray-300';
        }
        else
        {
            $this->classchevron='text-gray-300 hover:text-gray-700';

        }
        $this->select($this->defaultvalue); // Default Value
    }

    /**
     * Emit his value everytime is refreshed
     *
     * @return void
     */
    /*
    public function hydrate()
    {
        // Send value everytime is hydrated
        $this->emit( $this->eventname, $this->value );
    }*/

    /**
     * Set value
     *
     * @param  mixed $index
     * @return void
     */
    public function setValue($uid, $index)
    {
        if ($uid==$this->uid || $uid=='*')
        {
            $this->select($index,false);
        }
    }

    public function getValue($uid)
    {
        if ($uid==$this->uid || $uid=='*')
        {
            $this->emit( $this->eventname, $this->value );
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

    /**
     * Update date to show where search changes
     *
     * @return void
     */
    public function updatedSearch()
    {
        $this->getData();
    }

    /**
     * Clear box search when escape key is pressed
     *
     * @return void
     */
    public function clearSearch()
    {
        $this->search='';
    }

    /**
     * Show Box of search
     *
     * @return void
     */
    public function showbody()
    {
        $this->showcontent=true;
        $this->classchevron='text-gray-700';

    }

    /**
     * Hide Box of Search
     *
     * @return void
     */
    public function hidebody()
    {
        $this->showcontent=false;
        $this->classchevron='text-gray-300 hover:text-gray-700';

    }


    /**
     * Toggle box of search visibility
     *
     * @return void
     */
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

    /**
     * Select Item
     *
     * @param  mixed $index         // Key of selected item
     * @return void
     */
    public function select($index, $emitevent=true)
    {
        $this->getData();
        if (is_null($index) && ($this->mode=='edit' || $this->mode=='show') )
        {
            $this->value=null;
            $this->text='';
            $this->contenttoshow='';
            return;
        }
        if (is_null($index))
        {
            $record=$this->data->first();
        }
        else
        {
            $record=$this->data->where($this->key, $index)->first();
        }

        if (!is_null($record) )
        {
            $this->text=$record[$this->field];
            $this->value=$record[$this->key];
            if ($this->template!="")
            {

                $this->contenttoshow=view($this->template, [ 'record' => $record ])->render();
            }
            else
            {
                $this->contenttoshow=$this->text;
            }
            $this->showcontent=false;
            if ($emitevent) $this->emit( $this->eventname, $this->value );
        }
        else
        {
            $this->text="";
            $this->value=null;
            $this->contenttoshow="";
        }
    }

    /**
     * Get data to show
     *
     * @return void
     */
    public function getData()
    {
        if ($this->onlyactives)
        {
            if (property_exists($this->model,'hasactive'))
            {
                $this->data=$this->model::active();
            }
            else
            {
                $this->data=$this->model::query();
            }
        }
        else
        {
            $this->data=$this->model::query();
        }

        if($this->filterraw)
        {
            $this->data->whereRaw($this->filterraw);
        }

        if ($this->search)
        {
            if ($this->searchInField)
            {
                $this->data->where($this->field,'like','%'.$this->search.'%');
            }
            else
            {
                $this->data->search($this->search);
            }
        }

        // Order
        if($this->sortorder!='')
        {
            if (Str::startsWith($this->sortorder,'-'))
            {
                $dir='desc';
                $field=Str::substr($this->sortorder,1,Str::of($this->sortorder)->length-1);
            }
            else
            {
                $dir='asc';
                $field=$this->sortorder;
            }
            $this->data->orderBy($field,$dir);
        }
    }

    /**
     * Render view function
     *
     * @return void
     */
    public function render()
    {
        $this->getData();
        $records=$this->data->get()->toArray();
        return view('livewire.controls.drop-down-table-component',
        [ 'records' => $records ] );
    }
}