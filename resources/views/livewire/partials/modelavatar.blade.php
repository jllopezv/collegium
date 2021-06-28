{{-- AVATAR --}}
<div class='w-full'  x-data="{showimagebuttons: true}">
    <div class='items-center '>
        <div class='items-center w-full mx-auto rounded-lg '>
            @livewire('controls.model-avatar-component', ['mode' => $mode, 'canmodify'=>$canmodify, 'preview' => $avatar, 'avatarpath' => $profile_photo_path])
        </div>
    </div>
</div>
