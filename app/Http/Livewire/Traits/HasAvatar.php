<?php

namespace App\Http\Livewire\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

Trait HasAvatar
{

    public $tempavatar=null;
    public $tempavatarext='';
    public $avatar_prefix="avatar";

    public function avatarUpdated($tempavatar,$ext)
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
            Storage::disk('public')->move(config('lopsoft.temp_dir').'/'.$this->tempavatar,$this->avatarfolder.'/'.$avatarfilename);
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


}
