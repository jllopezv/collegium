<?php

namespace App\Http\Livewire\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

Trait HasAvatar
{

    public $tempavatar=null;
    public $tempavatarext='';

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


            $avatarfilename='avatar_'.Str::random(40).'.'.$this->tempavatarext;
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


}
