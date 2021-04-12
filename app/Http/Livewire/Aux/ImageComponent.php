<?php

namespace App\Http\Livewire\Aux;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class ImageComponent extends Component
{
    use WithPagination;
    use HasCommon;
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;
    use WithFileUploads;

    public  $image;
    public  $imagedata;
    public  $tag;
    public  $imageable_type=null;
    public  $imageable_id=null;

    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',
        'filemanagerselect'     => 'filemanagerSelect',
        'filemanager-upload-postprocess'=> 'filemanagerUploadFile',
        'eventsetdata'          =>  'eventSetData',
    ];

    /**
     * Mount function
     *
     * @return void
     */
    public function mount()
    {
        $this->table='images';
        $this->module='aux';
        $this->commonMount();
        // Default order for table
        $this->sortorder='id';
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

        ];
    }

    public function loadDefaults()
    {
        $this->image=null;
        $this->tag='';
    }

    public function resetForm()
    {

        $this->loadDefaults();
    }

    public function loadRecordDef()
    {
        $this->image=$this->record->image;
        $this->imagedata=$this->record->imagedata;
        $this->tag=$this->record->tag;
        $this->imageable_type=$this->record->imageable_type;
        $this->imageable_id=$this->record->imageable_id;
        $this->dispatchBrowserEvent('richeditor-setdefault',[ 'modelid' => 'data', 'content' => '']);
    }

    public function getKeyNotification($record)
    {
        return ($record->id);
    }

    /**
     * Save or Update record data
     *
     * @return void
     */
    public function saveRecord()
    {
        return [
            'image'                =>  $this->image,
            'tag'                  =>  $this->tag,
            'data'                 =>  $this->imagedata,
            'imageable_type'       =>  $this->imageable_type,
            'imageable_id'         =>  $this->imageable_id,
        ];
    }


    public function filemanagerSelect($uuid, $currendir, $file)
    {
        if ($uuid=='filemanager-'.$this->table || $uuid=='*')
        {
            $this->image=$currendir.$file[0]['basename'];
        }
    }

    public function filemanagerUploadFile($file, $dir, $path)
    {
        // $handlerimg=Image::make($path)->resize(800, 600, function ($constraint) {
        //     $constraint->aspectRatio();
        //     $constraint->upsize();
        // });
        // $ret=$handlerimg->save();
    }

    public function eventSetData($data, $command=false, $param=false)
    {
        $this->imagedata=$data;
        if ($command!=false)
        {
            if ($command=='store') $this->store();
            if ($command=='update') $this->update($param);
        }
    }

    public function initStore()
    {
        // Before save update values...
        $this->custommessage="GUARDANDO DATOS";
        $this->showcustommessage=true;
        $this->dispatchBrowserEvent('richeditor-request-update',[ 'modelid' => 'body', 'command' => 'store', 'param' => '' ]);
    }

    public function initUpdate($exit=false)
    {
        // Before save update values...
        $this->custommessage="ACTUALIZANDO DATOS";
        $this->showcustommessage=true;
        $this->dispatchBrowserEvent('richeditor-request-update',[ 'modelid' => 'body', 'command' => 'update', 'param' => $exit ]);
    }

}
