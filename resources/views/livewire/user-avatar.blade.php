<div >
    <div class='relative text-center'>
        <div wire:loading class='absolute w-16 h-16' style='top: calc(50% - 1.5rem ); left: calc( 50% - 2rem )'>
            <i class='fas fa-spinner fa-pulse fa-3x text-white opacity-75'></i>
        </div>
        <div  class='mx-auto w-40 h-40 rounded-full' wire:loading.class='bg-black' >
            <div class='relative' >
                <img
                    @mouseenter='showimagebuttons=true'
                    @mouseout="showimagebuttons=false"
                    wire:loading.class='hidden'
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
                    src='{{ $avatar }}' />
            </div>
            <div x-cloak x-show.transition.opaque.1s='showimagebuttons'
                @mouseenter='showimagebuttons=true'
                class='absolute flex items-center justify-center' style='left: calc(50% - 2.75rem); bottom: -1.25rem'>
                <div
                    @click='$wire.resetImage()'
                    class='w-10 bg-red-400 hover:bg-red-500 h-10 rounded-full text-center pt-2 opacity-75 cursor-pointer mr-1'>
                    <div class=''><i class='text-white fa fa-trash-alt'></i></div>
                </div>
                <div
                    @click='$wire.imageRotate()'
                    class='w-10 bg-blue-400 hover:bg-blue-500 h-10 rounded-full text-center pt-2 opacity-75 cursor-pointer ml-1'>
                    <div class=''><i class='text-white fa fa-redo-alt'></i></div>
                </div>
            </div>
        </div>
        <div class='text-center mt-2'>
            @error('image') <span class='text-red-600'>{{$message}}</span> @enderror
        </div>

        <input type="file" class="hidden"
            wire:model="image"
            x-ref="fileavatar"
        />

    </div>


</div>

