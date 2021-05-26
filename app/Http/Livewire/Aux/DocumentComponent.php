<?php

namespace App\Http\Livewire\Aux;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class DocumentComponent extends Component
{
    use WithPagination;
    use HasCommon;
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;
    use WithFileUploads;

    public  $document;
    public  $documentdata;
    public  $description;
    public  $documentable_type=null;
    public  $documentable_id=null;

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
        $this->table='documents';
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
        $this->document=null;
        $this->description='';
    }

    public function resetForm()
    {

        $this->loadDefaults();
    }

    public function loadRecordDef()
    {
        $this->document=$this->record->document;
        $this->documentdata=$this->record->documentdata;
        $this->description=$this->record->description;
        $this->documentable_type=$this->record->documentable_type;
        $this->documentable_id=$this->record->documentable_id;
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
            'document'             =>  $this->document,
            'description'          =>  $this->description,
            'data'                 =>  $this->documentdata,
            'documentable_type'    =>  $this->documentable_type,
            'documentable_id'      =>  $this->documentable_id,
        ];
    }


    public function filemanagerSelect($uuid, $currendir, $file)
    {
        if ($uuid=='filemanager-'.$this->table || $uuid=='*')
        {
            $this->document=$currendir.$file[0]['basename'];
        }
    }

    public function filemanagerUploadFile($file, $dir, $path)
    {
    }

    public function eventSetData($data, $command=false, $param=false)
    {
        $this->documentdata=$data;
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

    }

    public function initUpdate($exit=false)
    {
        // Before save update values...
        $this->custommessage="ACTUALIZANDO DATOS";
        $this->showcustommessage=true;

    }

}
