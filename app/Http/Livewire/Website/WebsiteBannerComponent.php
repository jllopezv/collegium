<?php

namespace App\Http\Livewire\Website;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class WebsiteBannerComponent extends Component
{
    use WithPagination;
    use HasCommon;
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;

    public  $banner;
    public  $width;
    public  $height;

    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',


    ];

    /**
     * Mount function
     *
     * @return void
     */
    public function mount()
    {
        $this->table='website_banners';
        $this->module='website';
        $this->commonMount();
        // Default order for table
        $this->sortorder='banner';
        if ($this->mode=='create')
        {
            // default create options
            $this->loadDefaults();
        }
    }


    /**
     * Rules to validate model
     *
     * @return array
     */
    public function validateRules() : array
    {
        return [
            'banner'      => 'required|string|max:255|unique:website_banners,banner,'.$this->recordid,
            'width'       => 'required|numeric',
            'height'      => 'required|numeric',
        ];
    }

    public function loadDefaults()
    {
        $this->banner='';
    }

    public function resetForm()
    {

        $this->loadDefaults();
    }

    public function loadRecordDef()
    {
        $this->banner=$this->record->banner;
        $this->width=$this->record->width;
        $this->height=$this->record->height;
    }

    public function getKeyNotification($record)
    {
        return ($record->banner);
    }

    /**
     * Save or Update record data
     *
     * @return void
     */
    public function saveRecord()
    {
        return [
            'banner'                =>  $this->banner,
            'width'                 =>  $this->width,
            'height'                =>  $this->height,
        ];
    }

}
