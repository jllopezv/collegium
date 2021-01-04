<?php

namespace App\Http\Livewire\Setting;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Setting\AppSettingPage;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\HasPriority;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class AppSettingPageComponent extends Component
{
    use WithPagination;
    use HasCommon;
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;
    use HasPriority;

    public $settingpage;
    public $priority;
    public $description;
    public $onlysuperadmin;

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
        $this->table='app_setting_pages';
        $this->module='setting';
        $this->commonMount();
        // Default order for table
        $this->sortorder='priority';
        if ($this->mode=='create')
        {
            $this->priority=AppSettingPage::count()+1;   // Default falue
            $this->onlysuperadmin=false;
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
            'settingpage'       => 'required|string|max:100|unique:app_setting_pages,settingpage,'.$this->recordid,
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
        $this->settingpage = '';
        $this->description = "";
        $this->onlysuperadmin=false;
        $this->priority = AppSettingPage::count()+1;
    }

    /**
     * Return the value of the field to notifications
     *
     * @param  mixed $record
     * @return String
     */
    public function getKeyNotification($record)
    {
        return ($record->settingpage);
    }

    /**
     * Load fields
     *
     * @return void
     */
    public function loadRecordDef()
    {
        $this->settingpage = $this->record->settingpage;
        $this->description = $this->record->description;
        $this->onlysuperadmin = $this->record->onlysuperadmin;
        $this->priority = $this->record->priority;
    }

    /**
     * Save or Update record data
     *
     * @return void
     */
    public function saveRecord()
    {
        return [
            'settingpage'          =>  $this->settingpage,
            'priority'             =>  $this->priority,
            'description'          =>  $this->description,
            'onlysuperadmin'       =>  $this->onlysuperadmin,
        ];
    }

}
