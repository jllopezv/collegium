@extends('lopsoft.layouts.page')

@section('content')

    @php
        $user=Auth::user();

    @endphp

    <div class='flex flex-wrap items-center justify-center '  x-data="{showimagebuttons: false}">
        <div class='self-start w-full lg:w-1/4'>
            @livewire('controls.model-avatar-component', [
                'mode'          =>  'edit',
                'canmodify'     =>  true,
                'preview'       =>  $user->avatar,
                'avatarpath'    =>  $user->profile_photo_path,
                ])
        </div>
    </div>



@endsection
