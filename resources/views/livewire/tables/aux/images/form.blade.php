
<div class='flex'>
    <div
        @if($mode!='show')
            wire:click="$emitTo('filemanager.filemanager','showFilemanager','filemanager-{{$table}}', 'image', '')"
        @endif
        class="mx-auto {{ $mode!='show' ? 'cursor-pointer' : '' }} "><img class='rounded-lg shadow-lg' src="{{getImage( $image, false )}}" style='max-width: auto; max-height: {{appsetting('posts_default_height')}}px' /></div>
</div>

<div class='flex flex-wrap items-center justify-start hidden md:flex-no-wrap'>
    <div class='w-full'>
        <x-lopsoft.control.imageform
            wire:model.lazy='image'
            id='image'
            x-ref='image'
            label="{{ transup('image').' ('.appsetting('posts_default_width').'x'.appsetting('posts_default_height').')' }}"
            autofocus
            classcontainer='w-full'
            requiredfield
            help="{{ transup('mandatory_unique') }}"
            nextref='type'
            mode="{{ $mode }}"
            fileid="fileimage"
            modelid='image'
            uuid='filemanager-'.$table
        />
    </div>
</div>

<div class='h-32'></div>


@livewire('filemanager.filemanager', ['uuid' => 'filemanager-'.$table, 'multiselect' => false, 'root' => '/', 'allowedmimetypes' => '' ])

<x-lopsoft.control.inputform
    wire:model.lazy='tag'
    id='tag'
    x-ref='tag'
    label="{{ transup('tag') }}"
    sublabel="Permite especificar una etiqueta para marcar la imagen"
    class='w-full'
    autofocus
    classcontainer='w-60'
    mode="{{ $mode }}"
    nextref='btnCreate'
/>


@livewire('filemanager.filemanager', ['uuid' => 'filemanagerdata', 'multiselect' => false, 'root' => '/', 'allowedmimetypes' => '' ])

@livewire('controls.rich-editor-component', [
    'uuid'      => 'filemanagerdata',  // filemanager uuid
    'modelid'   => 'imagedata',
    'default'   => $record->data??'',
    'event'     => 'eventsetdata',
    'label'     => transup('data'),
    'mode'      => $mode,
])

