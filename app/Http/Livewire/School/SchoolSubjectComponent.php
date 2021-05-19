<?php

namespace App\Http\Livewire\School;

use Livewire\Component;
use App\Lopsoft\LopHelp;
use Livewire\WithPagination;
use App\Models\School\SchoolLevel;
use App\Models\School\SchoolSubject;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\HasPriority;
use App\Http\Livewire\Traits\HasAvailable;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAnnoSupport;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class SchoolSubjectComponent extends Component
{
    use WithPagination;
    use HasCommon;
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;
    use HasPriority;
    use HasAvailable;
    use WithAnnoSupport;

    public  $code;
    public  $subject;
    public  $level_id;
    public  $grade_id;
    public  $period_id;

    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',
        'eventsetlevel'         => 'eventSetLevel',
        'eventsetgrade'         => 'eventSetGrade',
        'eventsetperiod'        => 'eventSetPeriod',
        'eventfilterlevel'      => 'eventFilterLevel',
        'eventfiltergrade'      => 'eventFilterGrade',
        'eventfilterperiod'     => 'eventFilterPeriod',
        'eventfilterorder'      => 'eventFilterOrder',
        'activateRecordInAnnoAction' => 'activateRecordInAnnoAction',
        'deactivateRecordInAnnoAction' => 'deactivateRecordInAnnoAction',
    ];

    /**
     * Mount function
     *
     * @return void
     */
    public function mount()
    {
        $this->table='school_subjects';
        $this->module='school';
        $this->commonMount();
        // Default order for table
        $this->sortorder='priority';
        if ($this->mode=='create')
        {
            // default create options
            $this->loadDefaults();
        }

        if ($this->mode=='index')
        {
            $this->initFilter();
        }

        // Filter and sorts
        $this->canShowFilterButton=true;
        $this->canShowSortButton=true;
    }

    /**
     * Rules to validate model
     *
     * @return array
     */
    public function validateRules() : array
    {
        return [
            'code'              => 'required|string|max:255|unique:school_subjects,code,'.$this->recordid,
            'subject'           => 'required|string|max:255',
            'priority'          => 'required|numeric',
        ];
    }

    public function loadDefaults()
    {
        $anno=getUserAnnoSession();
        $subjects=$anno->schoolSubjects;
        $this->priority=max(count($subjects), $subjects->max('pivot.priority'))+1;
        $this->code='-';

    }

    public function resetForm()
    {
        $this->priority='';
        $this->subject='';
        $this->code='';
        $this->loadDefaults();
    }

    public function loadRecordDef()
    {
        $this->code=$this->record->code;
        $this->subject=$this->record->subject;
        $this->priority=$this->record->priority;
        $this->emit('setvalue', 'gradecomponent', $this->grade_id);
    }

    public function getKeyNotification($record)
    {
        return ($record->subject);
    }

    /**
     * Validate only some fields
     *
     * @return void
     */
    public function validateFields()
    {
        return [
            'code'                  =>  $this->code,
            'subject'               =>  $this->subject,
            'priority'              =>  $this->priority,
        ];
    }

    /**
     * Save or Update record data
     *
     * @return void
     */
    public function saveRecord()
    {
        return [
            'code'                    =>  $this->code,
            'subject'                 =>  $this->subject,
        ];
    }


    public function postStore($storedRecord)
    {
        $storedRecord->priority=$this->priority;    // Pivot value
        $storedRecord->annos()->updateExistingPivot(getUserAnnoSessionId(), [
            'grade_id'  =>  $this->grade_id,
            'period_id' =>  $this->period_id,
        ]);
    }

    public function postUpdate($updatedRecord)
    {
        $updatedRecord->priority=$this->priority;    // Pivot value
        $updatedRecord->annos()->updateExistingPivot(getUserAnnoSessionId(), [
            'grade_id'  =>  $this->grade_id,
            'period_id' =>  $this->period_id,
        ]);
    }

    public function eventSetPeriod($period_id, $change)
    {
        $this->period_id=$period_id;
    }

    public function eventSetGrade($grade_id, $change)
    {
        $this->grade_id=$grade_id;
    }

    public function eventSetLevel($level_id, $change)
    {
        $this->level_id=$level_id;
    }

    /*************************************
     * FILTERS
     */

    public function eventFilterLevel($level_id)
    {
        $this->filterdata='';
        $this->level_id=$level_id;
        if ($level_id=='*')
        {
            $datafiltered=getUserAnnoSession()->schoolGrades();
        }
        else
        {
            $datafiltered=SchoolLevel::find($level_id)->grades();
        }
        /*
        foreach($datafiltered->get() as $item)
        {
            if ($this->filterdata!='') $this->filterdata.=' or ';
            $this->filterdata.=' grade_id='.$item->id.' ';
        }*/
        $this->createFilter();
        $newoptions=LopHelp::getFilterDropdownBuilder($datafiltered, 'id', 'grade', '', true, '');
        $this->emit('setoptions','filtergradecomponent',$newoptions);

    }

    public function eventFilterGrade($grade_id)
    {
        $this->grade_id=$grade_id;
        /*
        $this->filterdata='';
        if ($grade_id!='*')
        {
            $this->filterdata="grade_id=".$grade_id;
        }
        else
        {
            if ($this->level_id=='*')
            {
                $datafiltered=getUserAnnoSession()->schoolGrades();
            }
            else
            {
                $datafiltered=SchoolLevel::find($this->level_id)->grades();
            }
            foreach($datafiltered->get() as $item)
            {
                if ($this->filterdata!='') $this->filterdata.=' or ';
                $this->filterdata.=' grade_id='.$item->id.' ';
            }
        }*/
        $this->createFilter();
    }

    public function eventFilterPeriod($period_id)
    {
        $this->period_id=$period_id;
        $this->createFilter();
    }

    public function createFilter()
    {

        $this->filterdata='';

        // LEVELS

        if ($this->level_id=='*')
        {
            $datafiltered=getUserAnnoSession()->schoolGrades();
        }
        else
        {
            $datafiltered=SchoolLevel::find($this->level_id)->grades();
        }
        foreach($datafiltered->get() as $item)
        {
            if ($this->filterdata!='') $this->filterdata.=' or ';
            $this->filterdata.=' grade_id='.$item->id.' ';
        }

        // GRADES

        if ($this->grade_id!='*')
        {
            $this->filterdata="grade_id=".$this->grade_id;
        }

        // PERIODS

        if ($this->period_id!='*')
        {
            $this->filterdata='('.$this->filterdata.') and period_id='.$this->period_id;
        }

    }

    public function initFilter()
    {
        $this->level_id='*';
        $this->grade_id='*';
        $this->period_id='*';
    }

    public function setDataFilter()
    {

        if ($this->filterdata!='')
        {

            $this->data->whereRaw( $this->filterdata );
        }
    }

    /*********************************
     * SORTS
     */

    public function eventFilterOrder($field, $change=false)
    {
        if ($change)
        {
            if ($this->sortorder==$field)
            {
                $this->sortorder='-'.$field;
            }
            else
            {
                $this->sortorder=$field;
            }

            $this->refreshDatatable();
        }

    }


    /**
     * Anno Support
     */

    public function forceGetQueryData($ret)
    {
        if (!$this->showOnlyAnno)
        {
            if ($this->sortorder=='grade_id' || $this->sortorder=='-grade_id') $this->sortorder='-id';
            if ($this->sortorder=='period_id' || $this->sortorder=='-period_id') $this->sortorder='-id';
        }
        if ($this->showOnlyAnno)
        {
            $subset=getUserAnnoSession()->schoolSubjects();
        }
        else
        {
            $subset=SchoolSubject::query();
            $this->resetFilter();
        }
        return $this->annoSupportForceGetQueryData($ret, $subset );
    }

    public function activateRecordInAnnoAction($id)
    {
        $anno=getUserAnnoSession();
        $item=$this->model::find($id);
        $anno->schoolSubjects()->attach([$id => [
            'priority' => $item->annos->last()->pivot->priority??1,
            'grade_id' => $item->annos()->withPivot('grade_id')->get()->last()->pivot->grade_id??null,
            'period_id' => $item->annos()->withPivot('period_id')->get()->last()->pivot->period_id??null,
            ]]);
    }

    public function deactivateRecordInAnnoAction($id)
    {
        $anno=getUserAnnoSession();
        $anno->schoolSubjects()->detach($id);
    }
}
