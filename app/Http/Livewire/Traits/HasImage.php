<?php

namespace App\Http\Livewire\Traits;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

Trait HasImage
{

    public function resetImage()
    {
        $this->image='';
    }

    public function imageRotate()
    {
        if ($this->image==null || is_null($this->image)) return;

        $basename=basename($this->image);
        $path=Str::before($this->image,$basename);
        $newfile=$basename;
        if (!Str::startsWith($basename, 'rotated-'))
        {
            $newfile='rotated-'.Str::random(10).$basename;
        }
        else
        {
            $newfile='rotated-'.Str::random(10).substr($basename,18,strlen($basename)-18);
        }
        $handle=Image::make(Storage::disk(config('lopsoft.filemanager_disk'))->path($path.$basename));
        $handle->rotate(90);
        $handle->save(Storage::disk(config('lopsoft.filemanager_disk'))->path($path.$newfile));
        if ( Str::startsWith($basename, 'rotated-') && file_exists(Storage::disk(config('lopsoft.filemanager_disk'))->path($path.$basename)))
        {
            try
            {
                unlink(Storage::disk(config('lopsoft.filemanager_disk'))->path($path.$basename));
                unlink(Storage::disk(config('lopsoft.filemanager_disk'))->path('thumbs/'.$path.$basename));
            }
            catch(\Exception $e)
            {

            }

        }
        // thumb save
        $handle=Image::make(Storage::disk(config('lopsoft.filemanager_disk'))->path($path.$newfile))->fit(300);
        $handle->save(Storage::disk(config('lopsoft.filemanager_disk'))->path('thumbs/'.$path.$newfile));
        $this->image=$path.$newfile;
    }

}
