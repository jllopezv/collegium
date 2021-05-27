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
            try{
                Storage::disk('public')->copy(config('lopsoft.temp_dir').'/'.$this->tempavatar,$this->avatarfolder.'/'.$avatarfilename);
            }
            catch (\Exception $e) {
                Storage::disk('public')->copy($this->avatarfolder.'/'.$this->tempavatar,$this->avatarfolder.'/'.$avatarfilename);
                Storage::disk('public')->delete($this->avatarfolder.'/'.$this->tempavatar);
            }
            $this->profile_photo_path=$this->avatarfolder.'/'.$avatarfilename;
        }
        return true;
    }

    /**
     * Detele Avatar or record
     *
     * @param Model $record
     * @return void
     */
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


    /**
     * Reset Avatar in Model form
     *
     * @return void
     */
    public function resetAvatar()
    {
        $this->emit('modelavatarreset');
        $this->tempavatar=null;
    }

    public function clearAvatar()
    {
        Storage::disk('public')->delete($this->profile_photo_path);
        $this->profile_photo_path=null;
        $this->resetAvatar();
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
/*
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

    public function resetAvatarImage()
    {
        $this->tempavatar=null;
    }
    */

}
