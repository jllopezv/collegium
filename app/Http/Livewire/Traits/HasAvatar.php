<?php

namespace App\Http\Livewire\Traits;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

Trait HasAvatar
{

    public $tempavatar=null;
    public $tempavatarext='';
    public $avatar_prefix="avatar";

    public function avatarUpdated($tempavatar,$ext='')
    {
        $this->tempavatar=$tempavatar;
        $this->tempavatarext=$ext;
    }

    public function saveAvatar()
    {
        // Save new avatar
        if (!is_null($this->tempavatar))
        {
            // Delete all avatar if is exists
            if (Storage::disk('public')->exists($this->profile_photo_path)) Storage::disk('public')->delete($this->profile_photo_path);


            $avatarfilename=$this->avatar_prefix.'_'.Str::random(40).'.'.$this->tempavatarext;
            Storage::disk('public')->copy(config('lopsoft.temp_dir').'/'.$this->tempavatar,$this->avatarfolder.'/'.$avatarfilename);
            $this->profile_photo_path=$this->avatarfolder.'/'.$avatarfilename;
        }
        return true;
    }

    public function deleteAvatar($record)
    {
        try
        {
            Storage::disk('public')->delete($record->profile_photo_path);
            return true;
        }
        catch(\Exception $e)
        {
            return false;
        }
    }

    public function resetAvatar()
    {
        $this->emit('avatarreset');
        $this->tempavatar=null;
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

    public function resetImage()
    {
        $this->profile_photo_path='';
        $this->avatar=Storage::disk('public')->url(config('lopsoft.default_avatar'));
        $id=Auth::user()->id;
        $user=User::find($id);

        // DELETE OLD
        Storage::disk('public')->delete($user->profile_photo_path);
        Storage::disk('public')->delete('thumbs/'.$user->profile_photo_path);
        $user->avatar=null;
        $user->save();
    }

    public function imageRotate()
    {
        $id=Auth::user()->id;
        $user=User::find($id);
        if (is_null($user->profile_photo_path)) return;

        $basename=Str::random(40).'.jpg';
        $path=Str::before($user->profile_photo_path,basename($user->profile_photo_path));

        $handle=Image::make(Storage::disk(config('lopsoft.filemanager_disk'))->path($user->profile_photo_path));
        $handle->rotate(90);
        $handle->save(Storage::disk(config('lopsoft.filemanager_disk'))->path($path.$basename));
        Storage::disk('public')->delete($user->profile_photo_path);
        $user->profile_photo_path=$path.$basename;
        $user->save();
        $this->avatar=Storage::disk(config('lopsoft.filemanager_disk'))->url($path.$basename);

    }

    public function resetAvatarImage()
    {
        $this->tempavatar=null;
    }

    public function avatarRotate()
    {
        if ($this->record->profile_photo_path==null && $this->tempavatar==null) return;

        $avatarfile=$this->record->profile_photo_path;
        $disk=config('lopsoft.filemanager_disk');
        if ($this->tempavatar!=null)
        {
            $avatarfile=config('lopsoft.temp_dir').'/'.$this->tempavatar;
            $disk=config('lopsoft.temp_disk');
        }



        $basename=$this->avatar_prefix.'_'.Str::random(40).'.jpg';
        $path=Str::before($avatarfile,basename($avatarfile));

        try{
            $handle=Image::make(Storage::disk($disk)->path($avatarfile));
            $handle->rotate(90);
            $handle->save(Storage::disk($disk)->path($path.$basename));
            Storage::disk($disk)->delete($avatarfile);
            $this->tempavatar=$basename;


        }
        catch(\Exception $e)
        {
            $this->tempavatar=null;
            $path='';
            $basename=config('lopsoft.default_avatar');
        }


        $this->emit('updateavatar', Storage::disk($disk)->url($path.$basename));


    }


}
