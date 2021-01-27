<?php

namespace App\Http\Livewire\Controls;

use Livewire\Component;
use App\Models\Aux\Image;
use App\Http\Livewire\Aux\ImageComponent;
use App\Http\Controllers\Aux\ImageController;
use App\Http\Livewire\Traits\WithModalConfirm;
use Intervention\Image\Facades\Image as ImageImage;

class ImageListComponent extends Component
{
    use WithModalConfirm;

    public $imageable_type;
    public $imageable_id;
    public $imagelist=[];
    public $openModal=false;
    public $mode;
    public $table;
    public $image;
    public $fileimage;
    public $tag;
    public $uuid;
    public $record=null;
    public $width=null;
    public $height=null;

    private $firsttime=true;

    protected $listeners=[
        'filemanagerselect'     => 'filemanagerSelect',
        'filemanager-upload-postprocess'=> 'filemanagerUploadFile',
        'setvalue'              =>  'setValue',
        'deleteImageAction'     =>  'deleteImageAction',
    ];

    public function mount()
    {
        if ($this->mode!='create')
        {
            $this->imagelist=[];
            foreach($this->record->images as $img)
            {
                $this->imagelist[]=[
                    'id'    =>  $img->id,
                    'image' =>  $img->image,
                    'tag'   =>  $img->tag,
                    'data'  =>  $img->data,
                ];
            }
        }
    }

    public function setValue($uuid, $imagelist)
    {
        if ($uuid==$this->uuid || $uuid=='*')
        {
            $this->imagelist=$imagelist;
        }
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
        $handlerimg=ImageImage::make($path)->fit( $this->width??config('lopsoft.banners_default_width'), $this->height??config('lopsoft.banners_default_height') );

        // resize($this->width??config('lopsoft.banners_default_width'), $this->height??config('lopsoft.banners_default_height'), function ($constraint) {
        //     $constraint->aspectRatio();
        //     $constraint->upsize();
        // });
        $ret=$handlerimg->save();
        $this->emit("filemanager-refresh");
    }

    public function cancelImage()
    {
        $this->openModal=false;
    }

    public function addImage()
    {
        $this->image=null;
        $this->fileimage=null;
        $this->tag='';
        $this->openModal=true;
    }

    public function storeImage()
    {
        $this->openModal=false;
        if ($this->image!='')
        {
            $imagedata=[
                'id'    =>  0,
                'image' =>  $this->image,
                'tag'   =>  $this->tag??'',
                'data'  =>  '',
            ];
            $this->emit("image-imageadded", $imagedata);
            $this->imagelist[]=$imagedata;
        }
    }

    public function deleteImage($id)
    {
        $this->showConfirm("error","¿SEGURO QUE DESEA BORRAR LA IMAGEN SELECCIONADA?","BORRAR IMAGEN","deleteImageAction","close","$id");
    }

    public function deleteImageAction($id)
    {
        $img=Image::find($id);
        if ($img==null) return;
        $img->delete();
        foreach($this->imagelist as $index => $img)
        {
            if ($img['id']==$id)
            {
                unset($this->imagelist[$index]);
            }
        }
        $this->emit("image-imagedeleted", $this->uuid, $id);
    }

    public function render()
    {
        if ($this->firsttime)
        {
            $this->firsttime=false;
            $this->emit('image-refresh', $this->uuid, $this->imagelist);
        }
        return view('livewire.controls.image-list-component');
    }
}
