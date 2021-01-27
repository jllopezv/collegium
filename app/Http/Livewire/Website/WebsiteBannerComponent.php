<?php

namespace App\Http\Livewire\Website;

use Livewire\Component;
use App\Models\Aux\Image;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
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
    public  $imagelist=[];

    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',
        'image-imageadded'      => 'imageAdded',
        'image-imagedeleted'    => 'imageDeleted',
        'image-refresh'         => 'imageRefresh',
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
        $this->width=config('lopsoft.banners_default_width');
        $this->height=config('lopsoft.banners_default_height');
        $this->imagelist=[];
        $this->emit('setvalue','image-website-banner',$this->imagelist);
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

    public function imageAdded($imagedata)
    {
        if ($this->mode=='edit')
        {
            $newImage=new Image;
            $newImage->image=$imagedata['image'];
            $newImage->tag=$imagedata['tag'];
            $newImage->data='';
            $newImage->created_by=Auth::user()->id;
            $this->record->images()->save($newImage);
            $imagedata['id']=$newImage->id;
        }

        $this->imagelist[]=$imagedata;

        if ($this->mode=='edit')
        {
            $this->emit("setvalue","image-website-banner", $this->imagelist);
        }


    }

    public function postStore($record)
    {
        foreach($this->imagelist as $item)
        {
            $newImage=new Image;
            $newImage->image=$item['image'];
            $newImage->tag=$item['tag'];
            $newImage->data='';
            $newImage->created_by=Auth::user()->id;
            $record->images()->save($newImage);
        }
    }

    public function imageRefresh($uuid, $imagelist)
    {
        $this->imagelist=$imagelist;
    }

    public function imageDeleted($uuid, $id)
    {
        foreach($this->imagelist as $index => $img)
        {
            if ($img['id']==$id)
            {
                unset($this->imagelist[$index]);
            }
        }
    }

}
