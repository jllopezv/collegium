<?php

namespace App\Http\Livewire\Website;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Website\WebsiteAdvertisementCat;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\HasPriority;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class WebsiteAdvertisementCatComponent extends Component
{
    use WithPagination;
    use HasCommon;
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;
    use HasPriority;

    public  $category;
    public  $color_id;

    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',
        'eventsetcolor'         => 'eventSetColor',
    ];

    /**
     * Mount function
     *
     * @return void
     */
    public function mount()
    {
        $this->table='website_advertisement_cats';
        $this->module='website';
        $this->commonMount();
        // Default order for table
        $this->sortorder='priority';
        if ($this->mode=='create')
        {
            // default create options
            $this->loadDefaults();
        }

        $this->showPriority=true;
    }

    /**
     * Rules to validate model
     *
     * @return array
     */
    public function validateRules() : array
    {
        return [
            'category'         => 'required|string|max:255|unique:website_advertisement_cats,category,'.$this->recordid,
            'priority'         => 'required|numeric',
            'color_id'         => 'exists:colors,id'              // Validte foreignid
        ];
    }

    public function loadDefaults()
    {
        $levels=WebsiteAdvertisementCat::active()->count();
        $this->priority=$levels+1;
    }

    public function resetForm()
    {
        $this->priority='';
        $this->category='';
        $this->color_id=0;
        $this->loadDefaults();
    }

    public function loadRecordDef()
    {
        $this->category=$this->record->category;
        $this->priority=$this->record->priority;
        $this->color_id=$this->record->color_id;
    }

    public function getKeyNotification($record)
    {
        return ($record->category);
    }

    /**
     * Save or Update record data
     *
     * @return void
     */
    public function saveRecord()
    {
        return [
            'category'             =>  $this->category,
            'priority'             =>  $this->priority,
            'color_id'             =>  $this->color_id,
        ];
    }

    /**
     * Event listener to set dropdown value
     *
     * @param  mixed $key
     * @return void
     */
    public function eventSetColor($key)
    {
        $this->color_id=$key;
        $this->emit('setvalue','colorcomponent', $key);
    }

}
