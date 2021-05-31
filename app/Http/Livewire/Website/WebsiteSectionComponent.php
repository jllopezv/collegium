<?php

namespace App\Http\Livewire\Website;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use App\Http\Livewire\Traits\HasImage;
use App\Models\Website\WebsiteSection;
use App\Http\Livewire\Traits\HasCommon;
use Illuminate\Support\Facades\Storage;
use App\Http\Livewire\Traits\HasPriority;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class WebsiteSectionComponent extends Component
{
    use WithPagination;
    use HasCommon;
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;
    use HasPriority;
    use WithFileUploads;
    use HasImage;

    public  $sectiontitle;
    public  $image;
    public  $published;
    public  $top;
    public  $starred;
    public  $fixed;
    public  $body;
    public  $fileimage;
    public  $description;
    public  $website_section_cat_id;
    public  $totaleditorstosave=2;    // Contador para esperar que se guarden todos los cambios, sino no sale del formulario.

    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',
        'eventsetpage'          => 'eventSetPage',
        'filemanagerselect'     => 'filemanagerSelect',
        'filemanager-upload-sectionprocess'=> 'filemanagerUploadFile',
        'eventsetbody'          =>  'eventSetBody',
        'eventsetdescription'   =>  'eventSetDescription',
        'eventsetcat'           =>  'eventSetCat',
        'eventfiltercat'        =>  'eventFilterCat',

    ];

    /**
     * Mount function
     *
     * @return void
     */
    public function mount()
    {
        $this->table='website_sections';
        $this->module='website';
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

        $this->showPriority=true;
    }

    /**
     * Rules to validate model
     *
     * @return array
     */
    public function validateRules() : array
    {
        return [
            'priority'                     => 'required|numeric',
            'website_section_cat_id'       => 'exists:website_section_cats,id'              // Validte foreignid
        ];
    }

    public function loadDefaults()
    {
        $this->published=false;
        $this->top=false;
        $this->starred=false;
        $this->fixed=false;
        $this->body='';
        $this->description='';
        $this->image=null;

        $levels=WebsiteSection::active()->count();
        $this->priority=$levels+1;

        $this->totaleditorstosave=2;
    }

    public function resetForm()
    {
        $this->priority='';
        $this->sectiontitle='';
        $this->published=false;
        $this->top=false;
        $this->fixed=false;
        $this->starred=false;
        $this->image=null;
        $this->body='';
        $this->description='';
        $this->dispatchBrowserEvent('richeditor-setdefault',[ 'modelid' => 'body', 'content' => '']);
        $this->dispatchBrowserEvent('richeditor-setdefault',[ 'modelid' => 'description', 'content' => '']);
        $this->loadDefaults();
    }

    public function loadRecordDef()
    {
        $this->sectiontitle=$this->record->title;
        $this->priority=$this->record->priority;
        $this->published=$this->record->published;
        $this->top=$this->record->top;
        $this->fixed=$this->record->fixed;
        $this->starred=$this->record->starred;
        $this->website_section_cat_id=$this->record->website_section_cat_id;
        $this->body=$this->record->body;
        $this->description=$this->record->description;
        $this->image=$this->record->image;

    }

    public function getKeyNotification($record)
    {
        return ($record->title);
    }

    /**
     * Save or Update record data
     *
     * @return void
     */
    public function saveRecord()
    {
        return [
            'title'                 =>  $this->sectiontitle,
            'priority'              =>  $this->priority,
            'image'                 =>  $this->image,
            'published'             =>  $this->published,
            'top'                   =>  $this->top,
            'fixed'                 =>  $this->fixed,
            'starred'               =>  $this->starred,
            'website_section_cat_id'=>  $this->website_section_cat_id,
            'body'                  =>  $this->body,
            'description'           =>  $this->description,
        ];
    }

    /**
     * Event listener to set dropdown value
     *
     * @param  mixed $key
     * @return void
     */
    public function eventSetPage($key)
    {
        $this->website_section_cat_id=$key;
    }

    public function filemanagerSelect($uuid, $currendir, $file)
    {
        if ($uuid=='filemanager-'.$this->table || $uuid=='*')
        {
            $this->image=$currendir.$file[0]['basename'];
        }
    }

    public function filemanagerUploadFile($file, $dir, $path)
    {
        $handlerimg=Image::make($path)->resize(config('lopsoft.sections_default_width'), config('lopsoft.sections_default_height'), function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $ret=$handlerimg->save();
        $this->emit('filemanager-refresh');
    }

    public function eventSetBody($body, $command=false, $param=false)
    {
        $this->body=$body;
        $this->totaleditorstosave-=1;
        if ($command!=false && $this->totaleditorstosave==0)
        {
            if ($command=='store') $this->store();
            if ($command=='update') $this->update($param);
        }
    }

    public function eventSetDescription($description, $command=false, $param=false)
    {
        $this->description=$description;
        $this->totaleditorstosave-=1;
        if ($command!=false && $this->totaleditorstosave==0)
        {
            if ($command=='store') $this->store();
            if ($command=='update') $this->update($param);
        }
    }

    public function eventSetCat($cat)
    {
        $this->website_section_cat_id=$cat;
    }

    public function initStore()
    {
        // Before save update values...
        $this->custommessage="GUARDANDO DATOS";
        $this->showcustommessage=true;
        $this->dispatchBrowserEvent('richeditor-request-update',[ 'modelid' => 'body', 'command' => 'store', 'param' => '' ]);
        $this->dispatchBrowserEvent('richeditor-request-update',[ 'modelid' => 'description', 'command' => 'store', 'param' => '' ]);
    }

    public function initUpdate($exit=false)
    {
        // Before save update values...
        $this->custommessage="ACTUALIZANDO DATOS";
        $this->showcustommessage=true;
        $this->dispatchBrowserEvent('richeditor-request-update',[ 'modelid' => 'body', 'command' => 'update', 'param' => $exit ]);
        $this->dispatchBrowserEvent('richeditor-request-update',[ 'modelid' => 'description', 'command' => 'update', 'param' => $exit ]);
    }

    public function eventFilterCat($cat)
    {
        if ($cat=='*')
        {
            $this->filterdata='';
        }
        else
        {
            $this->filterdata='website_section_cat_id='.$cat;
        }
    }

    public function setDataFilter()
    {
        if ($this->filterdata!='') $this->data->whereRaw( $this->filterdata );
    }



}
