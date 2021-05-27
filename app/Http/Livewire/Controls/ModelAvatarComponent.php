<?php

namespace App\Http\Livewire\Controls;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ModelAvatarComponent extends Component
{
    use WithFileUploads;

    protected $listeners=[
        'modelavatarreset'   =>  'resetAvatar',
    ];

    public $tempfoldername='';
    public $canmodify=false;    // Can click on image to change
    public $mode;               // Mode
    public $preview=null;       // URL to show
    public $image;              // image object
    public $foldertemp='';      // Temporary folder
    public $tempavatar=null;    // Temporary file
    public $avatarpath=null;    // Profile Photo Path

    public function mount()
    {
        $this->tempfoldername=uniqid()."-".now()->format('H-m-s');
        if ($this->preview==null) $this->preview=$this->getDefaultAvatar();
        $this->tempavatar=$this->avatarpath;
        //Storage::disk(config('lopsoft.temp_disk'))->makeDirectory(config('lopsoft.temp_dir').'/'.$this->tempfoldername);

        if ($this->mode=='edit')
        {
            if (!Storage::disk('public')->exists(config('lopsoft.temp_dir').'/'.basename($this->tempavatar))) Storage::disk('public')->copy($this->tempavatar,config('lopsoft.temp_dir').'/'.basename($this->tempavatar));
            $this->tempavatar=config('lopsoft.temp_dir').'/'.basename($this->tempavatar);
        }
    }

    public function resetAvatar()
    {
        // Clear avatar

        $this->preview=$this->getDefaultAvatar();
        $this->image=null;
        $this->tempavatar=null;
        //$this->emit('avatarreseted');
    }

    public function getDefaultAvatar()
    {
        return Storage::disk('public')->url(config('lopsoft.default_avatar'));
    }

    public function updatedImage()
    {
        $this->validate([
            'image' => 'nullable|image|mimes:jpg,gif,jpeg,bmp,png|file|max:'.config('lopsoft.avatar_max_size')
        ]);

        if (Storage::disk(config('lopsoft.temp_disk'))->exists(config('lopsoft.temp_dir').'/'.$this->tempavatar)) Storage::disk(config('lopsoft.temp_disk'))->delete(config('lopsoft.temp_dir').'/'.$this->tempavatar);

        if ($this->image)
        {
            $this->savetemporary(true);

        }

    }

    public function savetemporary($emitevent=false)
    {
        $filename=$this->image->getFileName();
        $this->ext=$this->image->getClientOriginalExtension();
        $savedimage=$this->image->store( config('lopsoft.temp_dir').$this->foldertemp,config('lopsoft.temp_disk') );
        $handlerimg=Image::make($this->image->getRealPath())->fit(300);
        $ret=$handlerimg->save(Storage::disk(config('lopsoft.temp_disk'))->path($savedimage));
        $this->preview=Storage::disk(config('lopsoft.temp_disk'))->url($savedimage);
        $this->tempavatar=$savedimage;
        Storage::disk(config('lopsoft.temp_disk'))->delete(config('lopsoft.temp_dir').'/'.$filename);
        $this->tempfilename=basename($savedimage);

        if ($emitevent)  $this->emit('avatarupdated', $this->tempfilename, $this->ext);
    }

    public function rotateAvatar()
    {
        if ($this->preview==$this->getDefaultAvatar()) return;

        $disk=config('lopsoft.filemanager_disk');
        $basename=Str::random(40).'.jpg';
        $path=Str::before($this->tempavatar,basename($this->tempavatar));
        try{
            $handle=Image::make(Storage::disk($disk)->path($this->tempavatar));
            $handle->rotate(90);
            $handle->save(Storage::disk($disk)->path($path.$basename));
            Storage::disk($disk)->delete($this->tempavatar);
            $this->tempavatar=$path.$basename; // $this->tempavatar=$path.$basename;
        }
        catch(\Exception $e)
        {
            $this->tempavatar=null;
            $path='';
            $basename=config('lopsoft.default_avatar');
        }

        $this->preview=Storage::disk($disk)->url($path.$basename);
        $this->emit('avatarupdated', $basename,'jpg'); // $this->emit('avatarupdated', $path.$basename);

    }

    public function render()
    {
        return view('livewire.controls.model-avatar-component');
    }
}
