<?php

namespace App\Http\Livewire\Website;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\HasPriority;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class WebsitePageComponent extends Component
{
    use WithPagination;
    use HasCommon;
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;
    use HasPriority;
    use WithFileUploads;

    public  $pagetitle;
    public  $body;


    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',
        'eventsetbody'          => 'eventSetBody',

    ];

    /**
     * Mount function
     *
     * @return void
     */
    public function mount()
    {
        $this->table='website_pages';
        $this->module='website';
        $this->commonMount();
        // Default order for table
        $this->sortorder='page';
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
            'page'                     => 'required|string|max:255',
        ];
    }

    public function loadDefaults()
    {
        $this->body='';
    }

    public function resetForm()
    {
        $this->pagetitle='';
        $this->body='';
        $this->dispatchBrowserEvent('richeditor-setdefault',[ 'modelid' => 'body', 'content' => '']);
        $this->loadDefaults();
    }

    public function loadRecordDef()
    {
        $this->pagetitle=$this->record->page;
        $this->body=$this->record->body;
    }

    public function getKeyNotification($record)
    {
        return ($record->pagetitle);
    }

    /**
     * Save or Update record data
     *
     * @return void
     */
    public function saveRecord()
    {
        return [
            'page'                  =>  $this->pagetitle,
            'body'                  =>  $this->body,
        ];
    }

    public function eventSetBody($body, $command=false, $param=false)
    {
        $this->body=$body;
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
