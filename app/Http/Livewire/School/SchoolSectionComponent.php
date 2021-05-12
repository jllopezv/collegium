<?php

namespace App\Http\Livewire\School;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\School\SchoolSection;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\HasPriority;
use App\Http\Livewire\Traits\HasAvailable;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAnnoSupport;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class SchoolSectionComponent extends Component
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

    public  $section;
    public  $grade_id;

    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',
        'eventsetgrade'         => 'eventSetGrade',
        'eventfiltergrade'      => 'eventFilterGrade',
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
        $this->table='school_sections';
        $this->module='school';
        $this->commonMount();
        // Default order for table
        $this->sortorder='priority';
        if ($this->mode=='create')
        {
            // default create options
            $this->loadDefaults();
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
            'section'           => 'required|string|max:255',
            'priority'          => 'required|numeric',
            'grade_id'          => 'required',
        ];
    }

    public function loadDefaults()
    {
        $anno=getUserAnnoSession();
        $sections=$anno->schoolSections;
        $this->priority=max(count($sections), $sections->max('pivot.priority'))+1;
    }

    public function resetForm()
    {
        $this->priority='';
        $this->section='';
        $this->loadDefaults();
    }

    public function loadRecordDef()
    {
        $this->section=$this->record->section;
        $this->priority=$this->record->priority;
        $this->grade_id=$this->record->grade_id;
        $this->emit('setvalue', 'gradecomponent', $this->grade_id);
    }

    public function getKeyNotification($record)
    {
        return ($record->section);
    }

    /**
     * Validate only some fields
     *
     * @return void
     */
    public function validateFields()
    {
        return [
            'section'               =>  $this->section,
            'priority'              =>  $this->priority,
            'grade_id'              =>  $this->grade_id,
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
            'section'                 =>  $this->section,
            'grade_id'                =>  $this->grade_id,
        ];
    }


    public function postStore($storedRecord)
    {
        $storedRecord->priority=$this->priority;    // Pivot value
    }

    public function postUpdate($updatedRecord)
    {
        $updatedRecord->priority=$this->priority;    // Pivot value
    }

    public function eventSetGrade($grade_id)
    {
        $this->grade_id=$grade_id;
    }

    /*************************************
     * FILTERS
     */

    public function eventFilterGrade($grade_id)
    {
        $this->filterdata='';
        if ($grade_id=='*')
        {
            $this->filterdata='';
        }
        else
        {
            $this->filterdata="grade_id=".$grade_id;
        }
    }

    public function setDataFilter()
    {
        if ($this->filterdata!='') $this->data->whereRaw( $this->filterdata );
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
        return $this->annoSupportForceGetQueryData($ret, SchoolSection::query() );
    }

    public function activateRecordInAnnoAction($id)
    {
        $anno=getUserAnnoSession();
        $item=$this->model::find($id);
        $anno->schoolSections()->attach([$id => ['priority' => $item->annos->last()->pivot->priority??1]]);
    }

    public function deactivateRecordInAnnoAction($id)
    {
        $anno=getUserAnnoSession();
        $anno->schoolSections()->detach($id);
    }
}
