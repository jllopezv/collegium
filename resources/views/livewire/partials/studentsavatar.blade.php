{{-- AVATAR --}}
<div class='w-full'  x-data="{showimagebuttons: false}">
    <div class='items-center '>
        <div class='items-center w-full mx-auto rounded-lg '>
            @livewire('controls.model-avatar-component', ['mode' => $mode, 'canmodify'=>$canmodify, 'preview' => $avatar, 'avatarpath' => $profile_photo_path])
            <div class='mt-4 text-center'>
                <div class=''>
                    <span class='font-bold text-gray-500'>{{ $exp!='-'?$exp:'' }} </span>
                </div>
                <div class=''>
                    <span class='text-sm text-gray-400'>{{ $studentname }} </span>
                </div>
            </div>
        </div>
    </div>
</div>
