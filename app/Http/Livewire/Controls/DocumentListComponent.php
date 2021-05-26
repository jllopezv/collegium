<?php

namespace App\Http\Livewire\Controls;

use App\Http\Livewire\Traits\WithAlertMessage;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Aux\Document;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Http\Livewire\Traits\WithModalConfirm;

class DocumentListComponent extends Component
{
    use WithModalConfirm;
    use WithFileUploads;
    use WithAlertMessage;

    public $documentable_type;
    public $documentable_id;
    public $documentlist=[];
    public $openModal=false;
    public $mode;
    public $table;
    public $document;
    public $filedocument;
    public $description;
    public $uuid;
    public $record=null;
    public $record_id=0;
    public $record_index=0;
    public $documents_root='/';
    public $inputfile=null;


    private $firsttime=true;

    protected $listeners=[
        'filemanagerselect'             => 'filemanagerSelect',
        'filemanager-upload-postprocess'=> 'filemanagerUploadFile',
        'setvalue'                      =>  'setValue',
        'deleteDocumentAction'          =>  'deleteDocumentAction',
    ];

    public function mount()
    {
        if ($this->mode!='create')
        {
            $this->documentlist=[];
            foreach($this->record->documents as $doc)
            {
                $this->documentlist[]=[
                    'id'            =>  $doc->id,
                    'document'      =>  $doc->document,
                    'description'   =>  $doc->description,
                    'data'          =>  $doc->data,
                ];
            }
        }
    }

    public function updatedInputfile()
    {
        $name='document_'.getNowFile();//.now()->format('YmdHis');
        $ext=Str::afterLast($this->inputfile->getClientOriginalName(), '.');
        $this->document=$name.'.'.$ext;
    }

    public function setValue($uuid, $documentlist)
    {
        if ($uuid==$this->uuid || $uuid=='*')
        {
            $this->documentlist=$documentlist;
        }
    }

    public function filemanagerSelect($uuid, $currendir, $file)
    {
        if ($uuid=='filemanager-'.$this->table || $uuid=='*')
        {
            $this->document=$currendir.$file[0]['basename'];
        }
    }

    public function filemanagerUploadFile($file, $dir, $path)
    {
        //$handlerdoc=documentdocument::make($path)->fit( $this->width??config('lopsoft.banners_default_width'), $this->height??config('lopsoft.banners_default_height') );

        // resize($this->width??config('lopsoft.banners_default_width'), $this->height??config('lopsoft.banners_default_height'), function ($constraint) {
        //     $constraint->aspectRatio();
        //     $constraint->upsize();
        // });
        //$ret=$handlerdoc->save();
        $this->emit("filemanager-refresh");
    }

    public function cancelDocument()
    {
        $this->openModal=false;
    }

    public function addDocument()
    {
        $this->document=null;
        $this->filedocument=null;
        $this->description='';
        $this->record_id=0;
        $this->openModal=true;

    }

    public function uploadDocument($documentdata)
    {
        if ($this->inputfile==null) return false;

        if (!Storage::disk('public')->exists($this->documents_root)) mkdir(Storage::disk('public')->path($this->documents_root.'/'));

        try
        {
            copy(Storage::disk(config('lopsoft.temp_disk'))->path(config('lopsoft.temp_dir').DIRECTORY_SEPARATOR.basename($this->inputfile->getFileName())) , Storage::disk('public')->path($this->documents_root.'/'.basename($this->document)));
            unlink(Storage::disk(config('lopsoft.temp_disk'))->path(config('lopsoft.temp_dir').DIRECTORY_SEPARATOR.basename($this->inputfile->getFileName())));
            $this->emit("document-documentadded", $documentdata);
            $this->document='';
            $this->description='';
            return true;
        }
        catch(\Exception $e)
        {
            $this->ShowError($e->getMessage());
        }
        return false;
    }

    public function storeDocument($cancel=true)
    {
        if ($this->document!='')
        {
            $documentdata=[
                'id'            =>  0,
                'document'      =>  $this->documents_root.'/'.$this->document,
                'description'   =>  $this->description??'',
                'data'          =>  '',
            ];
            //$this->emit("document-documentadded", $documentdata);
            if ($this->uploadDocument($documentdata))   $this->documentlist[]=$documentdata;
        }
        if ($cancel) $this->openModal=false;

    }

    public function updateDocument()
    {
        if ($this->document!='')
        {
            $documentdata=[
                'id'            =>  $this->record_id,
                'document'      =>  $this->document,
                'description'   =>  $this->description??'',
                'data'          =>  '',
            ];
            $this->emit("document-documentupdated", $documentdata);
            $this->documentlist[$this->record_index]=$documentdata;
        }
        $this->document='';
        $this->description='';
        $this->openModal=false;
    }

    public function deleteDocument($id)
    {
        $this->showConfirm("error","¿SEGURO QUE DESEA BORRAR EL DOCUMENTO SELECCIONADO?","BORRAR DOCUMENTO","deleteDocumentAction","close","$id");
    }

    public function deleteDocumentAction($id)
    {
        $doc=Document::find($id);
        if ($doc==null) return;
        try
        {
            unlink(Storage::disk('public')->path($doc->document));
        }
        catch(\Exception $e)
        {

        }
        $doc->delete();
        foreach($this->documentlist as $index => $doc)
        {
            if ($doc['id']==$id)
            {
                unset($this->documentlist[$index]);
            }
        }
        $this->emit("document-documentdeleted", $this->uuid, $id);
    }

    public function close()
    {
        $this->openModal=false;
    }

    public function editDocument($id, $index)
    {
        $this->openModal=true;
        $doc=Document::find($id);
        if ($doc==null) return;
        $this->document=$doc->document;
        $this->description=$doc->description;
        $this->record_id=$doc->id;
        $this->record_index=$index;
    }

    public function render()
    {
        if ($this->firsttime)
        {
            $this->firsttime=false;
            $this->emit('document-refresh', $this->uuid, $this->documentlist);
        }
        return view('livewire.controls.document-list-component');
    }
}
