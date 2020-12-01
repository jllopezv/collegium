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

    protected $listeners=[

        'storeavatar'           =>  'storeavatar',
        'updateavatar'          =>  'updateavatar',
        'avatarrefresh'         =>  'avatarrefresh',
        'avatarreset'           =>  'avatarreset',
        'avatarcleartemporary'  =>  'avatarcleartemporary',

    ];

    public function mount()
    {
        if ($this->preview==null) $this->preview=Storage::disk('public')->url(config('lopsoft.default_avatar'));
    }

    public function updatedImage()
    {
        $this->validate([
            'image' => 'nullable|image|mimes:jpeg,bmp,png|file|max:'.config('lopsoft.avatar_max_size')
        ]);

        if (Storage::disk(config('lopsoft.temp_disk'))->exists($this->tempavatar)) Storage::disk(config('lopsoft.temp_disk'))->delete($this->tempavatar);

        if ($this->image)
        {
            $this->savetemporary();
            $this->emit('avatar_updated', $this->tempfilename, $this->ext);
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

    /*

    public function avatarcleartemporary()
    {
        Storage::disk('public')->delete($this->avatarpath);
    }
    public function avatarrefresh($avatar)
    {
        $this->avatar=$avatar;
    }


    /*
    public function updateavatar($id, $folder, $field)
    {
        if ($this->tempavatar)
        {
            $avatarfilename='avatar_'.Str::random(40).'.'.$this->ext;
            Storage::disk('public')->move($this->tempavatar,$folder.'/'.$avatarfilename);
            $this->emit('avatarstored', $id, $folder.'/'.$avatarfilename);
            return;
        }
        $this->emit('avatarstored', $id, null);
    }

    /*
    public function storeavatar($id, $folder, $field)
    {
        if ($this->avatarpath)
        {
            // Move from temp to folder
            $avatarfilename='avatar_'.Str::random(40).'.'.$this->ext;
            Storage::disk('public')->move($this->avatarpath,$folder.'/'.$avatarfilename);
            $this->emit('avatarstored', $id, $folder.'/'.$avatarfilename);
            return;
        }
        $this->emit('avatarstored', $id, null);
    }

    // // public function storeavatar($id, $folder, $field)
    // // {
    // //     if ($this->image)
    // //     {
    // //         // STORE
    // //         $filename=$this->image->getFileName();
    // //         $savedimage=$this->image->store($folder,'public');
    // //         $handlerimg=Image::make($this->image->getRealPath())->fit(300);
    // //         $ret=$handlerimg->save(Storage::disk('public')->path($savedimage));
    // //     }
    // //     $this->avatar=Storage::disk('public')->url(config('lopsoft.default_avatar'));
    // //     $this->emit('avatarstored', $id, $savedimage);
    // // }

    public function updateavatar($id, $folder, $field, $oldtodelete)
    {
        //dd($this->avatarpath, $oldtodelete);

        if ( !Str::startsWith($oldtodelete, config('lopsoft.temp_dir').'/') )
        {
            Storage::disk('public')->delete($oldtodelete);
            // Move from temp to folder
            $avatarfilename='avatar_'.Str::random(40).'.'.$this->ext;
            if ($this->avatarpath && file_exists($this->avatarpath)) Storage::disk('public')->move($this->avatarpath,$folder.'/'.$avatarfilename);
        }
        $this->emit('avatarupdated', $id, $folder.'/'.$avatarfilename);




        // if ($this->image)
        // {
        //     // Delete
        //     Storage::disk('public')->delete($this->avatarpath);

        //     // STORE
        //     $filename=$this->image->getFileName();
        //     $savedimage=$this->image->store($folder,'public');
        //     $handlerimg=Image::make($this->image->getRealPath())->fit(300);
        //     $ret=$handlerimg->save(Storage::disk('public')->path($savedimage));
        //     $this->emit('avatarupdated', $id, $savedimage);
        //     return;
        // }
        // $this->avatar=Storage::disk('public')->url(config('lopsoft.default_avatar'));
        // $this->emit('avatarupdated', $id, null);

    }*/
    public function render()
    {
        return view('components.lopsoft.avatar');
    }
}
