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
    public  $process=[
        'anno_id'       =>  0,
        'periods'       =>  true,
        'levels'        =>  true,
        'grades'        =>  true,
        'sections'      =>  true,
        'batches'       =>  true,
        'modalities'    =>  true,
        'subjects'      =>  true,
        'employees'     =>  true,
    ];

    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',
        'eventsetannostart'     => 'eventSetStart',
        'eventsetannoend'       => 'eventSetEnd',
        'eventsetanno'          => 'eventSetProcessAnno',
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
            'anno_start'        => 'required|date',
            'anno_end'          => 'required|date|after:anno_start'
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

    public function showStudentsAnno($id)
    {
        return redirect()->route('showstudentsanno', ['id' => $id]);
    }

    public function eventSetProcessAnno($anno_id)
    {
        $this->process['anno_id']=$anno_id;
    }

    public function postStore($recordstored)
    {
        if ($this->process['anno_id']==0) return;

        /* Process */
        $anno=Anno::where('id',$this->process['anno_id'])->first();
        if ($anno==null) return;

        // Periods
        if ($this->process['periods'])
        {
            foreach($anno->schoolPeriods as $record)
            {
                $recordstored->schoolPeriods()->attach([$record->id =>
                [
                    'priority'  =>  $record->pivot->priority,
                    'available' =>  $record->pivot->available,
                ]]);
            }
        }

        // Levels
        if ($this->process['levels'])
        {
            foreach($anno->schoolLevels as $record)
            {
                $recordstored->schoolLevels()->attach([$record->id =>
                [
                    'priority'  =>  $record->pivot->priority,
                    'available' =>  $record->pivot->available,
                ]]);
            }
        }

        // Grades
        if ($this->process['grades'])
        {
            foreach($anno->schoolGrades as $record)
            {
                $recordstored->schoolGrades()->attach([$record->id =>
                [
                    'priority'  =>  $record->pivot->priority,
                    'available' =>  $record->pivot->available,
                ]]);
            }
        }

        // Sections
        if ($this->process['sections'])
        {
            foreach($anno->schoolSections as $record)
            {
                $recordstored->schoolSections()->attach([$record->id =>
                [
                    'priority'  =>  $record->pivot->priority,
                    'available' =>  $record->pivot->available,
                ]]);
            }
        }

        // Batches
        if ($this->process['batches'])
        {
            foreach($anno->schoolBatches as $record)
            {
                $recordstored->schoolBatches()->attach([$record->id =>
                [
                    'priority'  =>  $record->pivot->priority,
                    'available' =>  $record->pivot->available,
                ]]);
            }
        }

        // Modalities
        if ($this->process['modalities'])
        {
            foreach($anno->schoolModalities as $record)
            {
                $recordstored->schoolModalities()->attach([$record->id =>
                [
                    'priority'  =>  $record->pivot->priority,
                    'available' =>  $record->pivot->available,
                ]]);
            }
        }

        // Subjects
        if ($this->process['subjects'])
        {
            foreach($anno->schoolSubjects as $record)
            {
                $recordstored->schoolSubjects()->attach([$record->id =>
                [
                    'priority'  =>  $record->pivot->priority,
                    'available' =>  $record->pivot->available,
                    'grade_id'  =>  $record->pivot->grade_id,
                    'period_id' =>  $record->pivot->period_id,
                ]]);
            }
        }

        // Employees
        if ($this->process['employees'])
        {
            foreach($anno->employees as $record)
            {
                $recordstored->employees()->attach([$record->id =>
                [
                    'priority'  =>  $record->pivot->priority,
                    'available' =>  $record->pivot->available,
                ]]);
            }
        }


    }


}
