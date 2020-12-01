{{-- AVATAR --}}
<div class='w-full'>
    <div class='items-center '>
        <div class='w-full mx-auto items-center  rounded-lg '>
            @livewire('auth.avatar-component', ['canmodify'=>$canmodify, 'preview' => $avatar, 'avatarpath' => $profile_photo_path])
            <div class='text-center mt-4'>
                <div class=''>
                    <span class='text-gray-500 font-bold'>{{ $username }} </span>
                </div>
                <div class=''>
                    <a href='mailto: {{$email}}'><span class='text-gray-400 text-sm'>{{ $email }} </span></a>
                </div>
            </div>
        </div>
    </div>
</div>
