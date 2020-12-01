<?php

namespace App\Http\Livewire\Traits;

use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Else_;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

Trait HasCommon
{

    /**
     * MANDATORY TO DECLARE IN CLASS
     *
     * @var array
     */
    /*
    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',
    ];*/


    public $mode;       // Component Mode ( 'index', 'create', 'show', 'edit' )
    public $table;      // Table name
    public $module;     // Module Name
    public $model;      // Model Class
    public $record;     // Record info
    public $recordid=0; // Current Record ID
    public $first=null; // First Record for navigation keys
    public $last=null;  // Last Record for navigation keys
    public $search='';
    public $flashmessageid='';
    public $title;
    public $subtitle;
    public $sortorder;   // column, -column
    public $multiple;
    public $minwidth='700px';
    public $minheight='500px';
    public $canadd=true;
    public $canselect=true;
    public $actioncandelete='true';
    public $actioncanedit='true';
    public $actioncanlock='true';
    public $showactions='true';
    public $cansearch='true';
    public $slave='false';
    public $showlocks=false;
    public $rowselectpage=false;
    public $rowselectall=false;
    public $rowselected=[];
    public $callforward=null;
    public $callback=null;
    public $paramscallforward;
    public $paramscallback;

    private $data=null;

    /**
     * Common functions to mount. Must be into the mount function of the class. Set default values.
     *
     * @return void
     */
    public function commonMount()
    {
        $this->multiple=false;
        $this->record=null;
        $this->sortorder='id';
        if ($this->callforward==null) $this->callforward=$this->table.'.index';
        if ($this->callback==null) $this->callback=$this->table.'.index';
        if ($this->mode=='index')
        {
            if (property_exists($this->model,'hasactive'))
            {
                $this->data=$this->model::active();
            }
            else
            {
                $this->data=$this->model::query();
            }
        }
        if ($this->mode=='edit' || $this->mode=='show') $this->loadRecord();
    }

    /*******************************************************************************
     * FUNCTIONS TO OVERRIDE IF IS NECESSARY
     *******************************************************************************/

    /**
     * Rules to validate model
     *
     * @return array
     */
    public function validateRules() : array
    {
        return [];
    }

    /**
     * Validation Messages
     *
     * @return array
     */
    public function validateMessages() : array
    {
        return [];
    }

    /**
     * Validation Attributes
     *
     * @return array
     */
    public function validateAttributes() : array
    {
        return [];
    }

    /**
     * Validation Attributes
     *
     * @return array
     */
    public function validateDefaultMessages() : array
    {
        return [
            'max'       =>
            [
                'string'    =>  'LA LONGITUD MÁXIMA ES DE :max',
                'numeric'   =>  'EL VALOR MÁXIMO ES :max',
            ],
            'min'       =>
            [
                'string'    =>  'LA LONGITUD MÍNIMA ES DE :min',
                'numeric'   =>  'EL VALOR MÍNIMO ES :min',
            ],
            'required'  =>  'EL CAMPO NO PUEDE QUEDAR VACÍO',
            'unique'    =>  'EL VALOR YA EXISTE. DEBE SER ÚNICO',
            'integer'   =>  'ESTE CAMPO DEBE SER UN NÚMERO',
            'string'    =>  'ESTE CAMPO DEBE SER UN TEXTO',
            'exists'    =>  'VALOR NO VÁLIDO',
            'array_size'=>  'DEBE SER UN ARRAY',
            'numeric'   =>  'DEBE INTRODUCIR UN NÚMERO',
            'date'      =>  'LA FECHA NO ES CORRECTA'
        ];
    }

    /**
     * Field to validate. By default are the same in saveRecord
     *
     * @return array
     */
    public function validateFields()
    {
        return $this->saveRecord();
    }

    /**
     * Reset fields of form
     *
     * @return void
     */
    public function resetForm()
    {
        return;
    }

    /**
     * Return the value of the field to notifications
     *
     * @param  mixed $record
     * @return String
     */
    public function getKeyNotification($record) : String
    {
        return '';
    }

     /**
     * Load fields
     *
     * @return void
     */
    public function loadRecord()
    {
        $this->resetForm();
        $this->findRecord();
        if ( !is_null($this->record) )
        {
            $this->loadRecordDef();
        }
        else
        {
            return redirect()->back();
        }
    }

    /**
     * Save or Update record data
     *
     * @return void
     */
    public function saveRecord()
    {
        return;
    }

    /**
     * Post Save Data
     *
     * @return void
     */
    public function postStore()
    {
        return;
    }

    /**
     * Post Save Data
     *
     * @return void
     */
    public function postUpdate()
    {
        return;
    }

    /**
     * Pre Save Data
     *
     * @return void
     */
    public function preStore()
    {
        return;
    }

    /**
     * Pre Save Data
     *
     * @return void
     */
    public function preUpdate()
    {
        return;
    }

    /**
     * Post Save Data
     *
     * @return boolean
     */
    public function canStore()
    {
        return true;
    }

    /**
     * Post Save Data
     *
     * @return boolean
     */
    public function canUpdate()
    {
        return true;
    }

    /**
     * Post VAlidation for special fields
     *
     * @return boolean
     */
    public function validateCustomFields()
    {
        return true;
    }


    /**
     * Updated Core Event
     *
     * @return void
     */
    public function updatedCore()
    {
        return;
    }

    /**
     * Listen delete record
     *
     * @param  mixed $table
     * @param  mixed $id
     * @return void
     */
    public function deletedRecord($table,$id)
    {
        return;
    }


    /*******************************************************************************
     * CORE FUNCTIONS
     *******************************************************************************/

    /**
     * When component is updated... then emit broadcast message to all components to set values to parent
     *
     * @return void
     */
    public function updated()
    {
        // Request report from children
        $this->emit("getvalue","*");
        $this->updatedCore();
    }

    /**
     * Find recordid record in the current model and store in $record
     *
     * @return Model
     */
    public function findRecord()
    {
        $this->record=$this->model::find($this->recordid);
        //if ( is_null($this->record) ) abort(404);
        if ( is_null($this->record) )
        {
            $this->ShowError("NO SE PUDIERON CARGAR LOS DATOS");
        }
        $this->updateFirstLast();
        return($this->record);
    }

    /**
     * Clear search input
     *
     * @return void
     */
    public function clearSearch() : void
    {
        $this->search='';
    }

    /**
     * Force refresh component and reset page
     *
     * @return void
     */
    public function refreshDatatable() : void
    {
        if ($this->mode!='index') return;   // Only accepted if is in index mode
        $this->resetPage();
    }

    /**
     * Force refresh component and reset page
     *
     * @return void
     */
    public function refreshForm() : void
    {
        if ($this->mode!='show' && $this->mode!='edit') return;   // Only accepted if is in show or edit mode
        $this->loadRecord();
    }

    /**
     * Set Data and paginate it
     *
     * @return void
     */
    public function getData() : void
    {
        $this->querySearch();
        $this->data=$this->data->paginate(config('lopsoft.default_paginate'));
    }

    /**
     * Sort data by columnname
     *
     * columnname 'field' | '-field'
     *
     * @param  mixed $columnname
     * @return void
     */
    public function sortBy($columnname) : void
    {
        if ($columnname==$this->sortorder || '-'.$columnname==$this->sortorder)
        {
            if (Str::startsWith($this->sortorder,"-"))
            {
                $this->sortorder=$columnname;
            }
            else
            {
                $this->sortorder='-'.$columnname;
            }
        }
        else
        {
            $this->sortorder=$columnname;
        }
        $this->getData();
        $this->resetPage();
    }

    public function setDataFilter()
    {

    }

    public function setDataFilterOwner()
    {
        $command=$this->mode;
        if ($this->mode=='index') $command='show';

        if (Auth::user()->hasAbility($this->table.'.'.$command.'.owner') && !Auth::user()->isAdmin())
        {
            // Only if I am the owner
            $this->data->where('created_by',Auth::user()->id);
        }
    }

    /**
     * Search in field
     *
     * @return void
     */
    public function querySearch()
    {
        if ($this->showlocks)
        {
            $this->data=$this->model::query();
        }
        else
        {
            if (property_exists($this->model,'hasactive'))
            {
                $this->data=$this->model::active();
            }
            else
            {
                $this->data=$this->model::query();
            }
        }

        if ($this->search)
        {
            $this->data=$this->data->search($this->search);
        }

        // Order
        if($this->sortorder!='')
        {
            if (Str::startsWith($this->sortorder,'-'))
            {
                $dir='desc';
                $field=Str::substr($this->sortorder,1,Str::of($this->sortorder)->length-1);
            }
            else
            {
                $dir='asc';
                $field=$this->sortorder;
            }
            $this->data->orderBy($field,$dir);
        }

        $this->setDataFilterOwner();
        $this->setDataFilter();
    }

    /**
     * Delete temp files. Valid if the component has temporary files to load like avatars
     *
     * @return void
     */
    public function deleteTemp()
    {
        collect(Storage::disk('public')->listContents(config('lopsoft.temp_dir'), true))
	        ->each(function($file) {
		        if ($file['type'] == 'file' && $file['timestamp'] < now()->subDays(config('lopsoft.garbagecollection_days'))->getTimestamp()) {
			        Storage::disk('public')->delete($file['path']);
		        }
	    });
    }

    /**
     * Update Search
     *
     * @return void
     */
    public function updatedSearch()
    {
        $this->resetPage();
        // Deselect all
        //$this->rowselectpage=false;
        //$this->rowselectall=false;
        //$this->rowselected=[];
    }


    /**
     * Update Datatable
     *
     * @return void
     */
    public function updateDatatable()
    {
        $this->getData();
        $this->resetPage();
        $this->rowselectpage=false;
        $this->rowselectall=false;
        $this->rowselected=[];

    }

    /**
     * Update First and Last params
     *
     * @return void
     */
    public function updateFirstLast()
    {
        // $this->first=$this->last=null;
        // $records=$this->model::all();
        // if (!is_null($records) && count($records)>0)
        // {
        //     $this->first=$records->first()->id;
        //     $this->last=$records->last()->id;
        // }
    }


    /**
     * Select all rows in page
     *
     * @return void
     */
    public function updatedRowSelectPage()
    {
        $this->rowselectall=false;
        $this->getData();
        if ($this->data==null) return;

        $this->rowselected=[];

        if ($this->rowselectpage)
        {
            foreach($this->data as $index => $item)
            {
                $this->rowselected[]="$item->id"; // Must be string
            }
        }
    }

    /**
     * Select all rows in database
     *
     * @return void
     */
    public function updatedRowSelectAll()
    {
        $this->rowselectpage=false;
        $this->querySearch();
        if ($this->data==null) return;

        $this->rowselected=[];

        if ($this->rowselectall)
        {
            foreach($this->data->get() as $index => $item)
            {
                $this->rowselected[]="$item->id";   // Must be string
            }
        }
    }

    /**
     * Show Exception message
     *
     * @param  mixed $e
     * @return void
     */
    public function showException(\Exception $e)
    {
        $this->showAlertError('SE PRODUJO UN ERROR INESPERADO<br/><br/>'.$e->getMessage(),"ERROR INESPERADO");
    }

    /*******************************************************************************
     * REDIRECT FUNCTIONS
     *******************************************************************************/

    /**
     * Control if can redirect
     *
     * @return bool
     */
    public function canGoForward()
    {
        return true;
    }

    /**
     * Control if can redirect to back
     *
     * @return bool
     */
    public function canGoBack()
    {
        return true;
    }

    /**
     * To do before go forward
     *
     * @return void
     */
    public function beforeGoForward()
    {
        return;
    }

    /**
     * To do before go back
     *
     * @return void
     */
    public function beforeGoBack()
    {
        return;
    }

    /**
     * Go to forward
     *
     * @return void
     */
    public function goForward()
    {
        $this->beforeGoForward();

        if ($this->canGoForward())
        {
            if ($this->paramscallforward)
            {
                return redirect()->route($this->callforward);
            }
            return redirect()->route($this->callforward, [ $this->paramscallforward ]);
        }
    }

    /**
     * Go to back
     *
     * @return void
     */
    public function goBack()
    {
        // can do go back?

        $this->beforeGoBack();

        if ($this->canGoBack())
        {
            if (!$this->callback) return redirect()->back();

            if ($this->paramscallback)
            {
                return redirect()->route($this->callback);
            }
            return redirect()->route($this->callback, [ $this->paramscallback ]);

        }

    }

    /*******************************************************************************
     * RECORDS ACTIONS
     *******************************************************************************/

    /**
     * Control if actives are showed
     *
     * @param  mixed $value
     * @return void
     */
    public function showLock($value) : void
    {
        $this->showlocks=$value;
    }

    /**
     * Controls if is possible to delete record ( must be override in class to obtain a diferent behavior)
     *
     * @return void
     */
    public function deleting()
    {
        return true;
    }

    /**
     * Entry point to delete action
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $this->showConfirm("error","¿SEGURO QUE DESEA BORRAR EL REGISTRO?","BORRAR REGISTRO","deleteRecord","close","$id");
    }

    /**
     * Destroy Record $id
     *
     * return bool
     */
    public function deleteRecord($id, $batch=false)
    {
        $record=$this->model::find($id);
        if ($record==null)
        {
            //$this->showError("[DRC] HUBO UN PROBLEMA AL RECUPERAR EL REGISTRO");
            return false;
        }
        try
        {
            if ($this->deleting($record))
            {
                if ( $record->delete() )
                {
                    $this->emit("refreshForm");  // Broadcast to all components in form mode ( show or edit )
                    if (!$batch)
                    {
                        $this->showSuccess("REGISTRO BORRADO CON ÉXITO");
                        $this->resetPage();
                    }
                    return true;
                }
                else
                {
                    $this->ShowError("NO SE PUDO BORRAR EL REGISTRO ".$this->getKeyNotification($record));
                }
            }
        }
        catch(\Exception $e)
        {
            $this->showException($e);
        }
        return false;

    }

    /**
     * Entry point to destroy in batch
     *
     * @return void
     */
    public function destroyBatch()
    {
        $this->showConfirm("error","¿SEGURO QUE DESEA BORRAR ".count($this->rowselected)." REGISTROS?","BORRAR REGISTROS","actionDestroyBatch","close","");
    }

    /**
     * Delete batch records
     *
     * @return void
     */
    public function actionDestroyBatch()
    {
        $deletedrecords=0;
        foreach($this->rowselected as $index => $id)
        {
            if ($this->deleteRecord($id, true)) $deletedrecords++;
        }
        $this->emit("refreshForm");  // Broadcast to all components in form mode ( show or edit )
        $this->updateDatatable();
        $this->showSuccess($deletedrecords." REGISTROS BORRADOS");
    }

    /**
     * Lock Single Record from Index
     *
     * @param  mixed $id
     * @return void
     */
    public function lock($id)
    {
        $record=$this->model::find($id);
        if($record==null)
        {
            //$this->showError("[LCKC] HUBO UN PROBLEMA AL RECUPERAR EL REGISTRO");
            return false;
        }
        try
        {
            if ($record->lock())
            {
                $this->emit("refreshForm");  // Broadcast to all components in form mode ( show or edit )
                $this->updateDatatable();
                return true;
            }
            else
            {
                return false;
            }
        }
        catch(\Exception $e)
        {
            $this->showException($e);
        }
        return false;

    }

    /**
     * Unlock record
     *
     * @param  mixed $id
     * @return void
     */
    public function unlock($id)
    {
        $record=$this->model::find($id);
        if($record==null)
        {
            //$this->showError("[ULCKC] HUBO UN PROBLEMA AL RECUPERAR EL REGISTRO");
            return false;
        }
        try
        {
            if ($record->unlock())
            {
                $this->emit("refreshForm");  // Broadcast to all components in form mode ( show or edit )
                $this->updateDatatable();
                return true;
            }
            else
            {
                return false;
            }
        }
        catch(\Exception $e)
        {
            $this->showException($e);
        }
        return false;

    }

    /**
     * Lock records in batch
     *
     * @return void
     */
    public function lockBatch()
    {
        $this->showConfirm("error","¿SEGURO QUE DESEA BLOQUEAR ".count($this->rowselected)." REGISTROS?","BLOQUEAR REGISTROS","actionLockBatch","close","");

    }

    /**
     * Unlock records in batch
     *
     * @return void
     */
    public function unlockBatch()
    {
        $this->showConfirm("error","¿SEGURO QUE DESEA DESBLOQUEAR ".count($this->rowselected)." REGISTROS?","DESBLOQUEAR REGISTROS","actionUnLockBatch","close","");

    }

    /**
     * Lock action
     *
     * @return void
     */
    public function actionLockBatch()
    {
        $lockedrecords=0;
        foreach($this->rowselected as $index => $id)
        {
            if ($this->lockRecord($id, true)) $lockedrecords++;
        }
        $this->emit("refreshForm");  // Broadcast to all components in form mode ( show or edit )
        $this->updateDatatable();
        $this->showSuccess($lockedrecords." REGISTROS BLOQUEADOS");
    }

    /**
     * Unlock Action
     *
     * @return void
     */
    public function actionUnLockBatch()
    {
        $unlockedrecords=0;
        foreach($this->rowselected as $index => $id)
        {
            if ($this->unlockRecord($id, true)) $unlockedrecords++;
        }
        $this->emit("refreshForm");  // Broadcast to all components in form mode ( show or edit )
        $this->updateDatatable();
        $this->showSuccess($unlockedrecords." REGISTROS DESBLOQUEADOS");
    }

    /**
     * Lock Record $id
     *
     * return bool
     */
    public function lockRecord($id, $batch=false)
    {
        $record=$this->model::find($id);
        if($record==null)
        {
            //$this->showError("[LOCKC] HUBO UN PROBLEMA AL RECUPERAR EL REGISTRO");
            return false;
        }
        try
        {
            if ( $record->lock() )
            {
                if (!$batch)
                {
                    $this->showSuccess("REGISTRO BLOQUEADO CON ÉXITO");
                    $this->resetPage();
                }
                return true;
            }
            else
            {
                //$this->showError("NO SE PUDO BLOQUEAR EL REGISTRO ".$this->getKeyNotification($record));
            }
        }
        catch(\Exception $e)
        {
            $this->showException($e);
        }
        return false;

    }

    /**
     * Unlock Record $id
     *
     * return bool
     */
    public function unlockRecord($id, $batch=false)
    {
        $record=$this->model::find($id);
        if($record==null)
        {
            //$this->showError("[UNLOCKC] HUBO UN PROBLEMA AL RECUPERAR EL REGISTRO");
            return false;
        }
        try
        {
            if ( $record->unlock() )
            {
                if (!$batch)
                {
                    $this->showSuccess("REGISTRO DESBLOQUEADO CON ÉXITO");
                    $this->resetPage();
                }
                return true;
            }
            else
            {
                //$this->showError("NO SE PUDO DESBLOQUEAR EL REGISTRO ".$this->getKeyNotification($record));
            }
        }
        catch(\Exception $e)
        {
            $this->showException($e);
        }
        return false;

    }

    /*******************************************************************************
     * NAVIGATION FUNCTIONS
     *******************************************************************************/

    /**
     * Navigate to the previous record ( ordered by id )
     *
     * @return void
     */
    public function navPrevious() : void
    {
        $previous = $this->model::where('id', '<', $this->recordid)->max('id');
        if ( !is_null($previous) )
        {
            $this->record=$this->model::find($previous);
            $this->recordid=$this->record->id;
            $this->loadRecord();
        }
        else
        {
            $this->showInfo("ESTE ES EL PRIMER REGISTRO");
        }
    }


    /**
     * Navigate to the next record ( ordered by id )
     *
     * @return void
     */
    public function navNext() : void
    {
        $next = $this->model::where('id', '>', $this->recordid)->min('id');
        if ( !is_null($next) )
        {
            $this->record=$this->model::find($next);
            $this->recordid=$this->record->id;
            $this->loadRecord();
        }
        else
        {
            $this->showInfo("ESTE ES EL ÚLTIMO REGISTRO");
        }

    }


    /*******************************************************************************
     * STORE FUNCTIONS
     *******************************************************************************/

    /**
     * Store Procedure
     *
     * @return void
     */
    public function store()
    {
        $this->resetValidation();
        if (!$this->canStore())
        {
            $this->ShowError("NO SE PUEDE GUARDAR EL REGISTRO");
            $this->emit('validationerror',$this->getErrorBag());
            return;
        }
        $this->preStore();
        $this->showFlashError($this->flashmessageid,"ERROR EN LOS DATOS");
        $validator=Validator::make(
            $this->validateFields(),
            $this->validateRules(),
            array_merge($this->validateMessages(), $this->validateDefaultMessages())
        );
        $this->emit('validationerror',$validator->messages());
        $validator->validate();

        if (!$this->validateCustomFields())
        {
            $this->emit('validationerror',$this->getErrorBag());
            return;
        }
        $this->hideFlashMessage($this->flashmessageid);

        try
        {
            $storedrecord=$this->model::create($this->saveRecord());
            if ($storedrecord)
            {
                $this->postStore($storedrecord);
                $this->showSuccess("REGISTRO ".$this->getKeyNotification($storedrecord)." CREADO CORRECTAMENTE");
            }
            if (!$this->multiple)
            {
                session()->flash('status_success', "REGISTRO ".$this->getKeyNotification($storedrecord)." CREADO CORRECTAMENTE");
                return $this->goForward();
            }
            $this->resetForm();
        }
        catch(\Exception $e)
        {
            $this->showException($e);
        }
        $this->emit('refreshDatatable');

    }

    /**
     * Update procedure
     *
     * @return void
     */
    public function update($exit=false)
    {
        $this->resetValidation();
        if (!$this->canUpdate())
        {
            $this->ShowError("NO SE PUEDE GUARDAR EL REGISTRO");
            $this->emit('validationerror',$this->getErrorBag());
            return;
        }
        $this->preUpdate();
        $this->showFlashError($this->flashmessageid,"ERROR EN LOS DATOS");
        $validator=Validator::make(
            $this->validateFields(),
            $this->validateRules(),
            array_merge($this->validateMessages(), $this->validateDefaultMessages())
        );
        $this->emit('validationerror',$validator->messages());
        $validator->validate();
        if (!$this->validateCustomFields())
        {
            $this->emit('validationerror',$this->getErrorBag());
            return;
        }
        $this->hideFlashMessage($this->flashmessageid);

        try
        {
            $record=$this->model::find($this->recordid);
            if ($record==null)
            {
                $this->ShowError("HUBO UN PROBLEMA AL RECUPERAR EL REGISTRO");
                return;
            }
            $updatedrecord=$record->update( $this->saveRecord() );
            if ($updatedrecord)
            {
                $this->postUpdate($record);
                $this->showSuccess("REGISTRO ".$this->getKeyNotification($record)." ACTUALIZADO CORRECTAMENTE");
            }
        }
        catch(\Exception $e)
        {
            $this->showException($e);
        }
        $this->emit('refreshDatatable');
        if ($exit) $this->goForward();
    }


    /*******************************************************************************
     * DEFAULT RENDER FUNCTION
     *******************************************************************************/

    /**
     * Render function
     *
     * @return void
     */
    public function render()
    {
        if ($this->mode=='index')
        {
            $this->querySearch();
            $this->data=$this->data->paginate(config('lopsoft.default_paginate'));
        }
        else
        {
            $this->data=null;
        }
        return view('livewire.'.$this->module.'.'.$this->table.'.'.$this->table.'-'.$this->mode, [
            'data'      =>  $this->data,

        ]);
    }







}