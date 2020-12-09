<div>

    <div class='relative text-center'>
        <div wire:loading.delay class='absolute w-16 h-16' style='top: calc(50% - 1.5rem ); left: calc( 50% - 2rem )'>
            <i class='text-white opacity-75 fas fa-spinner fa-pulse fa-3x'></i>
        </div>
        <div class='w-40 h-40 mx-auto rounded-full' wire:loading.class='bg-black' >
        <img
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
        <input type="file" class="hidden"
            wire:model="image"
            x-ref="fileavatar"
        />

    </div>

    <div class='mt-2 text-center'>
        @error('image') <span class='text-red-600'>{{$message}}</span> @enderror
    </div>


</div>

