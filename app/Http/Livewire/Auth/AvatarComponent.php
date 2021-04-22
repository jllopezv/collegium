<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class AvatarComponent extends Component
{
    use WithFileUploads;

    public  $canmodify;
    public  $image=null;              // input file
    public  $ext;                     // File extension
    public  $preview=null;             // Image preview
    public  $currentavatar=null;       // Current loaded avatar
    public  $tempavatar=null;          // Avatar temporary file
    public  $tempfilename=null;        // temporary filename of avatar
    public  $foldertemp;
    public  $mode;

    protected $listeners=[

        'storeavatar'           =>  'storeavatar',
        'updateavatar'          =>  'updateAvatar',
        'avatarrefresh'         =>  'avatarrefresh',
        'avatarreset'           =>  'avatarreset',
        'avatarcleartemporary'  =>  'avatarcleartemporary',

    ];

    public function mount()
    {
        $this->foldertemp=uniqid()."-".now()->format('H-m-s');
        if ($this->preview==null) $this->preview=Storage::disk('public')->url(config('lopsoft.default_avatar'));
    }

    public function updatedImage()
    {
        $this->validate([
            'image' => 'nullable|image|mimes:jpg,gif,jpeg,bmp,png|file|max:'.config('lopsoft.avatar_max_size')
        ]);

        if (Storage::disk(config('lopsoft.temp_disk'))->exists($this->tempavatar)) Storage::disk(config('lopsoft.temp_disk'))->delete($this->tempavatar);

        if ($this->image)
        {
            $this->savetemporary();
            $this->emit('avatarupdated', $this->tempfilename, $this->ext);
        }

    }
    public function savetemporary()
    {
        $filename=$this->image->getFileName();
        $this->ext=$this->image->getClientOriginalExtension();
        $savedimage=$this->image->store(config('lopsoft.temp_dir'),config('lopsoft.temp_disk'));
        $handlerimg=Image::make($this->image->getRealPath())->fit(300);
        $ret=$handlerimg->save(Storage::disk(config('lopsoft.temp_disk'))->path($savedimage));
        $this->preview=Storage::disk(config('lopsoft.temp_disk'))->url($savedimage);
        $this->tempavatar=$savedimage;
        Storage::disk(config('lopsoft.temp_disk'))->delete(config('lopsoft.temp_dir').'/'.$filename);
        $this->tempfilename=basename($savedimage);
    }

    public function avatarreset()
    {
        $this->preview=Storage::disk('public')->url(config('lopsoft.default_avatar'));
        $this->avatarpath=null;
    }

    public function resetAvatar()
    {
        if ($this->tempavatar!=null)
        {
            // Delete temp avatar
            Storage::disk(config('lopsoft.temp_disk'))->delete($this->tempavatar);
        }
        $this->avatarreset();
        $this->tempavatar=null;
        $this->emit('useravatarreset');
    }

    public function updateAvatar($img)
    {
        $this->tempavatar=$img;
        $this->preview=$img;
    }

    public function render()
    {
        return view('components.lopsoft.avatar');
    }
}
