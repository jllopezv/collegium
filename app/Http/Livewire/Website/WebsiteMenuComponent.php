<?php

namespace App\Http\Livewire\Website;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Website\WebsiteMenu;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\HasPriority;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class WebsiteMenuComponent extends Component
{
    use WithPagination;
    use HasCommon;
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;
    use HasPriority;

    public  $menu;
    public  $label;
    public  $parent_id;
    public  $menulink='';
    public  $website_page_id;

    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',
        'eventsetparent'        => 'eventSetParent',
        'eventsetpage'          => 'eventSetPage',
        'eventfiltermenu'       => 'eventFilterMenu',
    ];

    /**
     * Mount function
     *
     * @return void
     */
    public function mount()
    {
        $this->table='website_menus';
        $this->module='website';
        $this->commonMount();
        // Default order for table
        $this->sortorder='priority';
        if ($this->mode=='create')
        {
            // default create options
            $this->loadDefaults();
        }

        // Filter and sorts
        $this->canShowFilterButton=true;
    }

    /**
     * Rules to validate model
     *
     * @return array
     */
    public function validateRules() : array
    {
        return [
            'menu'         => 'required|string|max:255|unique:website_menus,menu,'.$this->recordid,
            'label'        => 'required|string|max:255',
            'priority'     => 'required|numeric',
            'parent_id'    => 'exists:website_menus,id'              // Validte foreignid
        ];
    }

    public function loadDefaults()
    {
        $levels=WebsiteMenu::active()->count();
        $this->priority=$levels+1;
    }

    public function resetForm()
    {
        $this->priority='';
        $this->menu='';
        $this->label='';
        $this->parent_id=0;
        $this->menulink='';
        $this->website_page_id=null;
        $this->loadDefaults();
    }

    public function loadRecordDef()
    {
        $this->menu=$this->record->menu;
        $this->label=$this->record->label;
        $this->priority=$this->record->priority;
        $this->parent_id=$this->record->parent_id;
        $this->website_page_id=$this->record->website_page_id;
        $this->menulink=$this->record->link;
    }

    public function getKeyNotification($record)
    {
        return ($record->menu);
    }

    /**
     * Save or Update record data
     *
     * @return void
     */
    public function saveRecord()
    {
        return [
            'menu'              =>  $this->menu,
            'label'             =>  $this->label,
            'priority'          =>  $this->priority,
            'parent_id'         =>  $this->parent_id,
            'website_page_id'   =>  $this->website_page_id,
            'link'              =>  $this->menulink,
        ];
    }

    /**
     * Event listener to set dropdown value
     *
     * @param  mixed $key
     * @return void
     */
    public function eventSetParent($key)
    {
        $this->parent_id=$key;
        $this->emit('setvalue','parentcomponent', $key);
    }

    /**
     * Event listener to set dropdown value
     *
     * @param  mixed $key
     * @return void
     */
    public function eventSetPage($key)
    {
        $this->website_page_id=$key;
        $this->emit('setvalue','pagecomponent', $key);
    }

    public function eventFilterMenu($menu)
    {
        if ($menu=='*')
        {
            $this->filterdata='';
        }
        else
        {
            $websitemenu=WebsiteMenu::where('menu',$menu)->first();
            if ($websitemenu!=null) $this->filterdata='parent_id='.$websitemenu->id;
        }
    }

    public function setDataFilter()
    {
        if ($this->filterdata!='') $this->data->whereRaw( $this->filterdata );
    }

}

