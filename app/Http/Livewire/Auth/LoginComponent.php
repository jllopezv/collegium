<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LoginComponent extends Component
{
    public $form=[
        'username'  =>  '',
        'password'  =>  '',
    ];

    public      $avatar;
    protected   $avatardefault;

    public function __construct()
    {
        $this->avatardefault=Storage::disk('public')->url(config('lopsoft.default_avatar'));
        $this->avatar=$this->avatardefault;
    }

    public function loadImage()
    {
        $this->avatar=$this->avatardefault;
        $user=User::where('username',$this->form['username'])->first();
        if ($user)
        {
            $this->avatar=$user->avatar;
        }

    }

    public function submit()
    {
        $this->validate([
            'form.username'  =>  'required',
            'form.password'  =>  'required',
        ]);

        $success = Auth::attempt($this->form);

        if ( $success )
        {
            if ( Auth::user()->roles->count()==0 )
            {
                Auth::logout();
                redirect(route('login'));
            }
            return redirect(route('dashboard'));
        }
        else
        {
            session()->flash('error', 'email and password are wrong.');
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
