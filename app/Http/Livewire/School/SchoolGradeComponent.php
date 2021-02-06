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
    public  $priority;
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
        $this->sortorder='priority';
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
            'grade'             => 'required|string|max:255', //|unique:school_grades,grade,'.$this->recordid,
            'priority'          => 'required|numeric',
            'level_id'          => 'required',
        ];
    }

    public function loadDefaults()
    {
        $grades=SchoolGrade::active()->count();
        $this->priority=$grades+1;
    }

    public function resetForm()
    {
        $this->priority='';
        $this->grade='';
        $this->loadDefaults();
    }

    public function loadRecordDef()
    {
        $this->grade=$this->record->grade;
        $this->priority=$this->record->priority;
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
            'priority'             =>  $this->priority,
            'level_id'              =>  $this->level_id,
        ];
    }


    public function updated()
    {
        $record=new SchoolGrade;
        $record->grade=$this->grade;
        $record->priority=$this->priority;
        $record->level_id=$this->level_id;
    }

    public function eventSetLevel($level_id)
    {
        $this->level_id=$level_id;
    }

    public function showStudentsGrade($id)
    {
        return redirect()->route('showstudentsgrade', ['id' => $id]);
    }


}
