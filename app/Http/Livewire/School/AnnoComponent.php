<?php

namespace App\Http\Livewire\School;

use Livewire\Component;
use App\Models\School\Anno;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class AnnoComponent extends Component
{
    use WithPagination;
    use HasCommon;
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;

    public  $anno;
    public  $anno_start;
    public  $anno_end;
    public  $current=false;

    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',
        'eventsetstart'         => 'eventSetStart',
        'eventsetend'           => 'eventSetEnd',
    ];

    /**
     * Mount function
     *
     * @return void
     */
    public function mount()
    {
        $this->table='annos';
        $this->module='school';
        $this->commonMount();
        // Default order for table
        $this->sortorder='anno_start';
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
            'anno'              => 'required|string|max:255|unique:annos,anno,'.$this->recordid,
        ];
    }

    public function loadDefaults()
    {
        $this->anno_start=getToday();
        $this->anno_end=getToday();
        $this->current=false;
        $this->emit('setvalue', 'annostartcomponent', getDateString($this->anno_start));
        $this->emit('setvalue', 'annoendcomponent', getDateString($this->anno_end));
    }

    public function resetForm()
    {
        $this->anno='';
        $this->current=false;
        $this->loadDefaults();
    }

    public function loadRecordDef()
    {
        $this->anno=$this->record->anno;
        $this->anno_start=$this->record->anno_start??getToday();
        $this->anno_end=$this->record->anno_end??getToday();
        $this->current=$this->record->current;
    }

    public function getKeyNotification($record)
    {
        return ($record->anno);
    }

    /**
     * Save or Update record data
     *
     * @return void
     */
    public function saveRecord()
    {
        return [
            'anno'                  =>  $this->anno,
            'anno_start'            =>  $this->anno_start,
            'anno_end'              =>  $this->anno_end,
            'current'               =>  $this->current,
        ];
    }


    public function updated()
    {
        $record=new Anno;
        $record->anno=$this->anno;
        $record->anno_start=$this->anno_start;
        $record->anno_end=$this->anno_end;
        $record->current=$this->current;
    }

    public function eventSetStart($date)
    {
        if ($date!=null)
        {
            $this->anno_start=getDateFromFormat($date);
        }
    }

    public function eventSetEnd($date)
    {
        if ($date!=null)
        {
            $this->anno_end=getDateFromFormat($date);
        }
    }

    public function setCurrent($id)
    {
        $anno=Anno::find($id);

        if ($anno==null) return;
        $anno->setCurrent();
    }

    public function preSortOrder()
    {
        $this->data->orderBy('current','desc');
    }

    public function lockingRecord($record)
    {
        if ($record->current) return false;
        return true;
    }


}
