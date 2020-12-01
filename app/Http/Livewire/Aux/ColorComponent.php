<?php

namespace App\Http\Livewire\Aux;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class ColorComponent extends Component
{
    use WithPagination;
    use HasCommon;
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;

    public  $name;
    public  $textcolor;
    public  $background;
    public  $muestra;
    public  $previewmodel=null;

    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',      // Refresh all components in index mode
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
        $this->table='colors';
        $this->module='aux';
        $this->commonMount();
        $this->multiple=true;
        // Default order for table
        $this->sortorder='name';
        $this->flashmessageid='colorsaved';
        $this->previewmodel=new $this->model;
    }

    /**
     * Rules to validate model
     *
     * @return array
     */
    public function validateRules() : array
    {
        return [
            'name'      => 'required|string|max:100|unique:colors,name,'.$this->recordid,
            'textcolor' => 'required|string|max:30',
            'background'=> 'required|string|max:30',
        ];
    }

    /**
     * Reset fields of form
     *
     * @return void
     */
    public function resetForm()
    {
        $this->name='';
        $this->textcolor='';
        $this->background='';
    }

    /**
     * Return the value of the field to notifications
     *
     * @param  mixed $record
     * @return String
     */
    public function getKeyNotification($record)
    {
        return ($record->name);
    }

    /**
     * Load fields
     *
     * @return void
     */
    public function loadRecordDef()
    {
        $this->name=$this->record->name;
        $this->textcolor=$this->record->textcolor;
        $this->background=$this->record->background;
        $this->muestra=$this->record->tag;
    }

    /**
     * Save or Update record data
     *
     * @return void
     */
    public function saveRecord()
    {
        return [
            'name'          =>  $this->name,
            'textcolor'     =>  $this->textcolor,
            'background'    =>  $this->background,
        ];
    }


    public function updatedCore()
    {
        $this->previewmodel->textcolor=$this->textcolor;
        $this->previewmodel->background=$this->background;
        $this->previewmodel->name=$this->name;
        $this->muestra=$this->previewmodel->tag;
    }

    // public function deletedRecord($table,$id)
    // {
    //     if ($this->table!=$table) return;

    //     if ($this->mode=='edit'  || $this->mode=='show')
    //     {
    //         if ($this->recordid==$id)
    //         {
    //             dd("estoy viendo el que se ha borrado");
    //         }
    //     }
    // }

}
