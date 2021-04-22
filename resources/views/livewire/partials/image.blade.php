<div x-data="{showimagebuttons: false}" class='flex relative '>
    <div
        @if($mode!='show')
            wire:click="$emitTo('filemanager.filemanager','showFilemanager','filemanager-{{$table}}', 'image', '')"
        @endif
        @mouseenter='showimagebuttons=true'
        @mouseout="showimagebuttons=false"
        class="mx-auto {{ $mode!='show' ? 'cursor-pointer' : '' }} "><img class='rounded-lg shadow-lg' src="{{getImage( $image, false )}}" style='max-width: auto; max-height: {{ $max_height }}px' />
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
