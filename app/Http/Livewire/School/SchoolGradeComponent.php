<?php

namespace App\Http\Livewire\School;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\School\SchoolGrade;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class SchoolGradeComponent extends Component
{
    use WithPagination;
    use HasCommon;
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;

    public  $grade;
    public  $showorder;
    public  $level_id;

    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',
        'eventsetlevel'         => 'eventSetLevel',
    ];

    /**
     * Mount function
     *
     * @return void
     */
    public function mount()
    {
        $this->table='school_grades';
        $this->module='school';
        $this->commonMount();
        // Default order for table
        $this->sortorder='showorder';
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
            'grade'             => 'required|string|max:255|unique:school_grades,grade,'.$this->recordid,
            'showorder'         => 'required|numeric',
        ];
    }

    public function loadDefaults()
    {
        $grades=SchoolGrade::active()->count();
        $this->showorder=$grades+1;
    }

    public function resetForm()
    {
        $this->showorder='';
        $this->grade='';
        $this->loadDefaults();
    }

    public function loadRecordDef()
    {
        $this->grade=$this->record->grade;
        $this->showorder=$this->record->showorder;
        $this->level_id=$this->record->level_id;
        $this->emit('setvalue', 'levelcomponent', $this->level_id);
    }

    public function getKeyNotification($record)
    {
        return ($record->grade);
    }

    /**
     * Save or Update record data
     *
     * @return void
     */
    public function saveRecord()
    {
        return [
            'grade'                 =>  $this->grade,
            'showorder'             =>  $this->showorder,
            'level_id'              =>  $this->level_id,
        ];
    }


    public function updated()
    {
        $record=new SchoolGrade;
        $record->grade=$this->grade;
        $record->showorder=$this->showorder;
        $record->level_id=$this->level_id;
    }

    public function eventSetLevel($level_id)
    {
        $this->level_id=$level_id;
    }


}
