<?php

namespace App\Http\Livewire\Setting;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Setting\AppSetting;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Http\Livewire\Traits\HasCommon;
use Illuminate\Support\Facades\Storage;
use App\Http\Livewire\Traits\HasPriority;
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
    use HasPriority;

    public $settingkey;
    public $settingdesc;
    public $settingvalue;
    public $type;
    public $level;
    public $typecheckbox;
    public $typeimage;
    public $filetypeimage;
    public $page_id;
    public $root='/';
    public $filterdata="";

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
        'filemanager-upload-postprocess'=> 'filemanagerUploadFile',
        'disable_loading'       => 'disableLoading',
        'eventfilterpage'       => 'eventFilterPage',
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
        $this->sortorder='priority';
        if ($this->mode=='create')
        {
            $this->priority=AppSetting::count()+1;   // Default falue
            $this->level=Auth::user()->level;
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
            'settingkey'        => 'required|string|max:255|unique:app_settings,settingkey,'.$this->recordid,
            'settingdesc'       => 'required|string|max:255',
            'settingvalue'      => 'required|string|max:255',
            'level'             => 'required|numeric|min:'.Auth::user()->level.'|max:50000',
            'priority'          => 'required|numeric|min:1',
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
        $this->level=Auth::user()->level;
        $this->priority = AppSetting::count()+1;
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
        $this->priority = $this->record->priority;
        $this->type = $this->record->type;
        $this->level=$this->record->level;
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
            'level'                 =>  $this->level,
            'page_id'               =>  $this->page_id,
            'priority'             =>  $this->priority,
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


    public function eventFilterPage($page_id)
    {
        if ($page_id=='*')
        {
            $this->filterdata='';
        }
        else
        {
            $this->filterdata='page_id='.$page_id;
        }
    }

    public function setDataFilter()
    {
        if ($this->filterdata!='') $this->data->whereRaw( $this->filterdata );
    }

    public function forceFilter()
    {
        if (Auth::user()->level==1) return;

        $items=$this->data->get();
        $ids=[];
        foreach($items as $item)
        {
            if ($item->page->onlysuperadmin==0) $ids[]=$item->id;
        }
        $this->data->whereIn('id', $ids );
    }


}
