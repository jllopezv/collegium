<?php

namespace App\Http\Livewire\Website;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use App\Http\Livewire\Traits\HasCommon;
use Illuminate\Support\Facades\Storage;
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
    }

    public function resetForm()
    {
        $this->posttitle='';
        $this->published=false;
        $this->top=false;
        $this->fixed=false;
        $this->starred=false;
        $this->website_post_cat_id=0;
        $this->body='';
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
            'published'             =>  $this->published,
            'top'                   =>  $this->top,
            'fixed'                 =>  $this->fixed,
            'starred'               =>  $this->starred,
            'website_post_cat_id'   =>  $this->website_post_cat_id,
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
        $handlerimg=Image::make($path)->resize(800, 600, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $ret=$handlerimg->save();
        //copy(Storage::disk(config('lopsoft.temp_disk'))->path(config('lopsoft.temp_dir').DIRECTORY_SEPARATOR.$ret->basename), Storage::disk(config('lopsoft.filemanager_disk'))->path(config('lopsoft.filemanager_storage_folder').$this->root.basename($ret->basename)));
    }

    public function eventSetBody($body)
    {
        $this->body=$body;
    }

    public function eventSetCat($cat)
    {
        $this->website_post_cat_id=$cat;
    }
}