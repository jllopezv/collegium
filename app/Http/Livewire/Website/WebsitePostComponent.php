<?php

namespace App\Http\Livewire\Website;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use App\Http\Livewire\Traits\HasCommon;
use App\Http\Livewire\Traits\HasPriority;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class WebsitePostComponent extends Component
{
    use WithPagination;
    use HasCommon;
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;
    use HasPriority;
    use WithFileUploads;

    public  $posttitle;
    public  $image;
    public  $published;
    public  $top;
    public  $starred;
    public  $fixed;
    public  $body;
    public  $fileimage;
    public  $website_post_cat_id;
    public  $showed;

    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',
        'eventsetpage'          => 'eventSetPage',
        'filemanagerselect'     => 'filemanagerSelect',
        'filemanager-upload-postprocess'=> 'filemanagerUploadFile',
        'eventsetbody'          =>  'eventSetBody',
        'eventsetcat'           =>  'eventSetCat'

    ];

    /**
     * Mount function
     *
     * @return void
     */
    public function mount()
    {
        $this->table='website_posts';
        $this->module='website';
        $this->commonMount();
        // Default order for table
        $this->sortorder='title';
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
            'title'                     => 'required|string|max:255',
            'showed'                    => 'numeric',
            'website_post_cat_id'       => 'exists:website_post_cats,id'              // Validte foreignid
        ];
    }

    public function loadDefaults()
    {
        $this->published=false;
        $this->top=false;
        $this->starred=false;
        $this->fixed=false;
        $this->body='';
        $this->showed=0;
        $this->image=null;

    }

    public function resetForm()
    {
        $this->posttitle='';
        $this->published=false;
        $this->top=false;
        $this->fixed=false;
        $this->starred=false;
        $this->image=null;
        //$this->emit('setvalue','website_post_cat_component',null);
        // $this->website_post_cat_id=0;
        $this->body='';
        $this->showed=0;
        $this->dispatchBrowserEvent('richeditor-setdefault',[ 'modelid' => 'body', 'content' => '']);
        $this->loadDefaults();
    }

    public function loadRecordDef()
    {
        $this->posttitle=$this->record->title;
        $this->published=$this->record->published;
        $this->top=$this->record->top;
        $this->fixed=$this->record->fixed;
        $this->starred=$this->record->starred;
        $this->website_post_cat_id=$this->record->website_post_cat_id;
        $this->body=$this->record->body;
        $this->showed=$this->record->showed;
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
            'title'                 =>  $this->posttitle,
            'image'                 =>  $this->image,
            'published'             =>  $this->published,
            'top'                   =>  $this->top,
            'fixed'                 =>  $this->fixed,
            'starred'               =>  $this->starred,
            'website_post_cat_id'   =>  $this->website_post_cat_id,
            'showed'                =>  $this->showed,
            'body'                  =>  $this->body,
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
        $this->website_post_cat_id=$key;
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
        $handlerimg=Image::make($path)->resize(config('lopsoft.posts_default_width'), config('lopsoft.posts_default_height'), function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $ret=$handlerimg->save();
        $this->emit('filemanager-refresh');
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

    public function eventSetCat($cat)
    {
        $this->website_post_cat_id=$cat;
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
