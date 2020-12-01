{{-- AVATAR --}}
<div class='w-full'>
    <div class='items-center '>
        <div class='w-full mx-auto items-center  rounded-lg '>
            @livewire('auth.avatar-component', ['canmodify'=>$canmodify, 'preview' => $avatar, 'avatarpath' => $profile_photo_path])
            <div class='text-center mt-4'>
                <div class=''>
                    <span class='text-gray-500 font-bold'>{{ $exp }} </span>
                </div>
                <div class=''>
                    <span class='text-gray-400 text-sm'>{{ $name }} </span>
                </div>
            </div>
        </div>
    </div>
</div>
