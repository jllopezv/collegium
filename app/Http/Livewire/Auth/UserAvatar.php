<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UserAvatar extends Component
{
    use WithFileUploads;

    public $profile_photo_path;
    public $image;
    public $canmodify;
    public $previewimage;
    public $avatar;

    public function mount()
    {
        $user=Auth::user();
        $this->previewimage=$user->avatar;
        $this->avatar=$user->avatar;
    }

    public function updatedImage()
    {

        $this->validate([
            'image' => 'nullable|image'
        ]);

        $this->previewimage=$this->avatar;

        if ($this->image)
        {
            $this->previewimage=$this->image->temporaryUrl();
        }

        $this->save();
    }

    public function updateAvatar()
    {
        $id=Auth::user()->id;
        $user=User::find($id);
        $this->avatar=$user->avatar;

    }

    public function save()
    {

        $id=Auth::user()->id;
        $user=User::find($id);

        // STORE
        $filename=$this->image->getFileName();
        $savedimage=$this->image->store('profile-photos','public');
        // DELETE OLD
        Storage::disk('public')->delete($user->profile_photo_path);
        Storage::disk('public')->delete('thumbs/'.$user->profile_photo_path);

        $handlerimg=Image::make($this->image->getRealPath())->fit(300);
        $ret=$handlerimg->save(Storage::disk('public')->path($savedimage));

        // Save thumbnail
        /*
        $handlerimg=Image::make($this->image->getRealPath())->fit(300);
        $ret=$handlerimg->save(Storage::disk('public')->path('thumbs/'.$savedimage));
        */
        $this->avatar=$savedimage;

        $user->avatar=$this->avatar;
        $user->save();

        $this->updateAvatar();

    }

    public function render()
    {
        return view('livewire.user-avatar');
    }
}
