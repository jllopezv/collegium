<x-lopsoft.control.inputform
    wire:model.lazy='banner'
    id='banner'
    x-ref='banner'
    label="{{ transup('banner') }}"
    class='w-full'
    autofocus
    classcontainer='w-full'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode="{{ $mode }}"
    nextref='width'
/>


<div class='flex flex-wrap items-center justify-start mb-4'>

    <x-lopsoft.control.inputform
        wire:model.lazy='width'
        id='width'
        x-ref='width'
        label="{{ transup('width') }}"
        class='w-full'
        autofocus
        classcontainer='w-full md:w-40'
        classcomponent='mr-2'
        requiredfield
        help="{{ transup('mandatory') }}"
        mode="{{ $mode=='edit'?'show':$mode }}"
        nextref='height'
    />

    <x-lopsoft.control.inputform
        wire:model.lazy='height'
        id='height'
        x-ref='height'
        label="{{ transup('height') }}"
        class='w-full'
        autofocus
        classcontainer='w-full md:w-40'
        requiredfield
        help="{{ transup('mandatory') }}"
        mode="{{ $mode=='edit'?'show':$mode }}"
        nextref='btnCreate'
    />
</div>

@if ($mode=='create')
    <div class='flex flex-wrap items-center justify-start mb-4 text-red-500'>
        El ancho y el alto ya no se podrán modificar después.
    </div>
@endif

{{-- <div class='h-4 mb-6 border-b-2 border-gray-200'></div> --}}

@livewire('controls.image-list-component', [

    'imageable_type'    =>  \App\Models\Website\WebsiteBanner::class,
    'imageable_id'      =>  $record->id??null,
    'mode'              =>  $mode,
    'table'             =>  'images',
    'uuid'              =>  'image-website-banner',
    'record'            =>  $record,
    'width'             =>  $record->width??null,
    'height'            =>  $record->height??null,
])



