<div>
    <div class='relative text-center'>
        <div wire:loading.delay class='absolute w-16 h-16' style='top: calc(50% - 1.5rem ); left: calc( 50% - 2rem )'>
            <i class='text-white opacity-75 fas fa-spinner fa-pulse fa-3x'></i>
        </div>
        <div class='w-40 h-40 mx-auto rounded-full' wire:loading.class='bg-black' >
        <img
            @mouseenter='showimagebuttons=true'
            @mouseout="showimagebuttons=false"
            wire:loading.delay.class='hidden'
            @if($canmodify)
                @click="$refs.fileavatar.click()"
            @endif
            class="mx-auto
                @if($canmodify)
                cursor-pointer
                @endif
                rounded-full w-40 h-40
                @error('image')
                border-2 border-red-500
                @enderror
                "
            src='{{ $preview }}' />
        </div>
        <div x-cloak x-show.transition.opaque.1s='showimagebuttons'
                @mouseenter='showimagebuttons=true'
                class='absolute flex items-center justify-center' style='left: calc(50% - 2.75rem); bottom: -1.25rem'>
                <div
                    wire:click="resetAvatar()"
                    @click='showimagebuttons=false'
                    class='w-10 bg-red-400 hover:bg-red-500 h-10 rounded-full text-center pt-2 opacity-75 cursor-pointer mr-1'>
                    <div class=''><i class='text-white fa fa-trash-alt'></i></div>
                </div>

                <div
                    wire:click='rotateAvatar()'
                    @click='showimagebuttons=false'
                    class='w-10 bg-blue-400 {{$mode!='create'?'hover:bg-blue-500':'' }} h-10 rounded-full text-center pt-2 opacity-75 cursor-pointer ml-1'>
                    <div class=''><i class='text-white fa fa-redo-alt'></i></div>
                </div>

            </div>
        <input type="file" class="hidden"
            wire:model="image"
            x-ref="fileavatar"
        />

    </div>
    <div class='mt-2 text-center'>
        @error('image') <span class='text-red-600'>{{$message}}</span> @enderror
    </div>


</div>

