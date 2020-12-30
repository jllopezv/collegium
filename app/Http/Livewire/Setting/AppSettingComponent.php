<?php

namespace App\Http\Livewire\Setting;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Setting\AppSetting;
use Intervention\Image\Facades\Image;
use App\Http\Livewire\Traits\HasCommon;
use Illuminate\Support\Facades\Storage;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class AppSettingComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    use HasCommon;
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;

    public $settingkey;
    public $settingdesc;
    public $settingvalue;
    public $type;
    public $typecheckbox;
    public $typeimage;
    public $filetypeimage;
    public $page_id;
    public $root='/';

    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',      // Refresh all components in index mode
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',
        'eventsetpage'          => 'eventSetPage',
        'eventsettype'          => 'eventSetType',
        'filemanagerselect'     => 'filemanagerSelect',
        'filemanager_uploadfile'=> 'filemanagerUploadFile',
        'disable_loading'       => 'disableLoading'
    ];

    /**
     * Mount function
     *
     * @return void
     */
    public function mount()
    {
        $this->table='app_settings';
        $this->module='setting';
        $this->commonMount();
        // Default order for table
        $this->sortorder='settingkey';
        if ($this->mode=='create') $this->priority=AppSetting::count()+1;   // Default falue
        //$this->root=Str::after($this->root,"/");
    }

    /**
     * Rules to validate model
     *
     * @return array
     */
    public function validateRules() : array
    {
        return [
            'settingkey'        => 'required|string|max:255|unique:app_settings,settingkey,'.$this->recordid,
            'settingdesc'       => 'required|string|max:255',
            'settingvalue'      => 'required|string|max:255',
        ];
    }


    /**
     * Reset fields of form
     *
     * @return void
     */
    public function resetForm()
    {
        $this->settingkey = '';
        $this->settingdesc = '';
        $this->settingvalue = '';
        $this->type='text';
    }

    /**
     * Return the value of the field to notifications
     *
     * @param  mixed $record
     * @return String
     */
    public function getKeyNotification($record)
    {
        return ($record->settingkey);
    }

    /**
     * Load fields
     *
     * @return void
     */
    public function loadRecordDef()
    {
        $this->settingkey = $this->record->settingkey;
        $this->settingdesc = $this->record->settingdesc;
        $this->settingvalue = $this->record->settingvalue;
        $this->type = $this->record->type;
        $this->page_id = $this->record->page_id;
        if ($this->type=='boolean') $this->typecheckbox=$this->settingvalue==='true'?1:0;
        if ($this->type=='image') $this->typeimage=$this->settingvalue;
        $this->emit('setvalue','appsettingcomponent', $this->page_id);
    }

    /**
     * Save or Update record data
     *
     * @return void
     */
    public function saveRecord()
    {
        return [
            'settingkey'            =>  $this->settingkey,
            'settingdesc'           =>  $this->settingdesc,
            'settingvalue'          =>  $this->settingvalue,
            'type'                  =>  $this->type,
            'page_id'               =>  $this->page_id,
        ];
    }


    public function eventSetPage($id)
    {
        $this->page_id=$id;
    }

    public function eventSetType($type)
    {
        $this->type=$type;
    }


    /*** restrictions ***/

    public function customStoreValidation()
    {
        return $this->validateValue();
    }

    public function customUpdateValidation()
    {
        return $this->validateValue();
    }

    public function validateValue()
    {
        $this->syncValue();
        $errorvalidation=false;
        $this->resetValidation();
        switch($this->type)
        {
            case 'number':
                if (!is_numeric($this->settingvalue))
                {
                    $this->ShowError("EL VALOR TIENE QUE SER NUMÉRICO");
                    $this->addError('settingvalue', 'SE ESPERABA UN NÚMERO');
                    $errorvalidation=true;
                }
                break;
        }
        if ($errorvalidation)
        {
            $this->emit('validationerror',$this->getErrorBag());
            $this->showFlashError($this->flashmessageid,"ERROR EN LOS DATOS");
            return false;
        }
        return true;
    }

    public function updatedFiletypeimage()
    {
        $this->typeimage=$this->filetypeimage->getFileName();
    }

    public function filemanagerSelect($uuid, $currendir, $file)
    {
        if ($uuid=='filemanager-'.$this->table || $uuid=='*')
        {
            $this->typeimage=$currendir.$file[0]['basename'];
        }

    }

    public function filemanagerUploadFile($file)
    {
        $handlerimg=Image::make(Storage::disk(config('lopsoft.temp_disk'))->path($file))->fit(300);
        $ret=$handlerimg->save();
        copy(Storage::disk(config('lopsoft.temp_disk'))->path(config('lopsoft.temp_dir').DIRECTORY_SEPARATOR.$ret->basename), Storage::disk(config('lopsoft.filemanager_disk'))->path(config('lopsoft.filemanager_storage_folder').$this->root.basename($ret->basename)));
        //$this->emit('filemanager_update');
        $this->ShowAlertInfo("probando...");
    }

    /**
     * Sync stringvalue to the correct value depend his type
     *
     * @return void
     */
    public function syncValue()
    {
        if ($this->type=='boolean')
        {
            $this->settingvalue=$this->typecheckbox?'true':'false';
        }
        if ($this->type=='image')
        {
            $this->settingvalue=$this->typeimage;
        }
    }

}
