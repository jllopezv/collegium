<?php

namespace App\Http\Livewire\Controls;

use App\Http\Livewire\Traits\WithAlertMessage;
use Livewire\Component;
use App\Models\School\Anno;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DropDownTableComponent extends Component
{

    use WithAlertMessage;

    public $uid='';                 // Unique ID in components in page
    public $modelid;                // Bind model
    public $mode='';                // Mode
    public $showcontent=false;      // trigger fot show box content
    public $text='';                   // text input value
    public $contenttoshow;          // Content to show in select
    public $value;                  // key selected
    public $defaultvalue;           // default key. null to select first
    public $classchevron='';        // class for chevron ( hover or not hover )
    public $label;                  // label for inputgroup
    public $sublabel="";
    public $requiredfield=false;    // show info
    public $help='';                // show help for requiredfield
    public $cansearch=true;         // can show search box
    public $search='';              // string to search
    public $readonly=false;         // Readonly property
    public $validationerror='';     // VAlidation errors
    public $classdropdown='w-full'; // Class for container
    public $table='';
    public $onlyanno=true;          // Only session current

    /* table */
    private $data=null;             // data to show
    public $lastcachekey='';
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
    public $linkshow='';            // Show info circle button to show record
    public $linkshowtable='';
    public $enabled=true;

    protected $listeners=[
        'setvalue'          =>  'setValue',
        'getvalue'          =>  'getValue',
        'setfilterraw'      =>  'setFilterraw',
        'validationerror'   =>  'validationError',
        'enabledropdown'    =>  'enableDropDown',
    ];

    /**
     * Initial values
     *
     * @return void
     */
    public function mount()
    {
        $object=new $this->model;
        $this->table=$object->getTable();
        if ($this->mode=='show') $this->readonly=true;
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
     * Set value
     *
     * @param  mixed $index
     * @return void
     */
    public function setValue($uid, $index,$change=false)
    {
        if ($uid==$this->uid || $uid=='*')
        {
            $this->select($index,false, $change);
        }
    }

    public function getValue($uid)
    {
        if ($uid==$this->uid || $uid=='*')
        {
            $this->emit( $this->eventname, $this->value, false );
        }
    }

    public function enableDropDown($uid, $value)
    {
        if ($uid==$this->uid || $uid=='*')
        {
            $this->enabled=$value;
        }
    }

    public function setFilterraw($uid,$filter, $index=null)
    {
        if ($uid==$this->uid || $uid=='*')
        {
            $this->filterraw=$filter;
            if ($index!==false) $this->select(null,false); // Select first if change filterraw
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
        if (!$this->enabled) return;
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
        if (!$this->enabled) return;
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

    public function selectchange($index)
    {
        if (!$this->enabled) return;
        $this->select($index,true,true);
    }

    /**
     * Select Item
     *
     * @param  mixed $index         // Key of selected item
     * @return void
     */
    public function select($index, $emitevent=true, $change=false)
    {
        if (!$this->enabled) return;
        $this->getData();

        if (is_null($index))
        {

            try
            {
                $record=$this->data->first();
            }
            catch(\Exception $e)
            {
                $record=null;
            }

        }
        else
        {
            if ( property_exists($this->model,'hasAnno') )
            {
                $record=$this->data->get()->where($this->key, $index)->first();
            }
            else
            {
                $record=$this->data->where($this->key, $index)->first();
            }
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
            if ($emitevent) $this->emit( $this->eventname, $this->value, $change );
        }
        else
        {
            $this->text="";
            $this->value=null;
            $this->contenttoshow="SIN SELECCIÓN";
        }

        $this->emit('dropdownupdated',$this->uid,$this->value);

        if ($this->linkshowtable!='' && Auth::user()->hasAbility($this->linkshowtable.'.show'))
        {
            if ($this->value!=null && $this->value!='' && $this->value!='*')
            {
                $this->linkshow=route($this->linkshowtable.'.show', [ 'id' => $this->value ]);
            }
        }
    }

    /**
     * Get data to show
     *
     * @return void
     */
    public function getData()
    {
        $this->data=$this->model::query();

        // Anno depend

        if ($this->onlyanno)
        {
            if ( property_exists($this->model,'hasAnno') )
            {
                $anno=getUserAnnoSession();
                $this->data=$anno->belongsToMany($this->model);
            }
        }

        if ($this->onlyactives)
        {
            if (property_exists($this->model,'hasactive'))
            {
                $this->data=$this->data->where('active',1);
            }
        }

        if (property_exists($this->model,'hasAvailable'))
        {
            $this->data=$this->data->where('available',1);
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

    public function setCacheKey()
    {
        // It depends of:     onlyactives, filterraw, search, sortorder

        return $this->model."-".$this->onlyactives."-".$this->filterraw."-".$this->search."-".$this->sortorder;
    }

    /**
     * Render view function
     *
     * @return void
     */
    public function render()
    {
        $this->getData();
        $data=$this->data;
        try
        {
            $records=$data->get()->toArray();
        }
        catch(\Exception $e)
        {
            $records=[];
        }


        return view('livewire.controls.drop-down-table-component',
        [ 'records' => $records ] );
    }
}
