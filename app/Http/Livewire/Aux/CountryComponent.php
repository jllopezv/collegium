<?php

namespace App\Http\Livewire\Aux;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class CountryComponent extends Component
{
    use WithPagination;
    use HasCommon;
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;

    public  $country;
    public  $iso;
    public  $iso3;
    public  $numcode;
    public  $phonecode;
    public  $language;
    public  $nicename;
    public  $flag;
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
        $this->table='countries';
        $this->module='aux';
        $this->commonMount();
        $this->multiple=true;
        // Default order for table
        $this->sortorder='country';
        $this->flashmessageid='countrysaved';
        $this->previewmodel=new $this->model;
    }

    public function getQueryData()
    {
        return $this->model::with([ 'translations' ]);
    }

    /**
     * Rules to validate model
     *
     * @return array
     */
    public function validateRules() : array
    {
        return [
            'country'      => 'required|string|max:100|unique:countries,country,'.$this->recordid,
            'iso'          => 'required|string|max:2',
            'iso3'         => 'required|string|max:3',
            'numcode'      => 'numeric',
            'phonecode'    => 'numeric',
            'language'     => 'required|string',
            'nicename'     => 'string',

        ];
    }

    /**
     * Reset fields of form
     *
     * @return void
     */
    public function resetForm()
    {
        $this->country='';
        $this->iso='';
        $this->iso3='';
        $this->numcode='';
        $this->phonecode='';
        $this->language='';
        $this->nicename='';
    }

    /**
     * Return the value of the field to notifications
     *
     * @param  mixed $record
     * @return String
     */
    public function getKeyNotification($record)
    {
        return ($record->country);
    }

    /**
     * Load fields
     *
     * @return void
     */
    public function loadRecordDef()
    {
        $this->country=$this->record->country;
        $this->nicename=$this->record->nicename;
        $this->iso=$this->record->iso;
        $this->iso3=$this->record->iso3;
        $this->numcode=$this->record->numcode;
        $this->phonecode=$this->record->phonecode;
        $this->language=$this->record->language;
        $this->flag=$this->record->flag;
    }

    /**
     * Save or Update record data
     *
     * @return void
     */
    public function saveRecord()
    {
        return [
            'country'           =>  $this->country,
            'nicename'          =>  $this->nicename,
            'iso'               =>  $this->iso,
            'iso3'              =>  $this->iso3,
            'numcode'           =>  $this->numcode,
            'phonecode'         =>  $this->phonecode,
            'language'          =>  $this->language,
        ];
    }

    public function updatedCore()
    {
        $this->previewmodel->country=$this->country;
        $this->previewmodel->iso=$this->iso;
        $this->flag=$this->previewmodel->flag;
    }

    public function deletingRecord($record)
    {
        return $record->canBeDeleted();
    }


}
