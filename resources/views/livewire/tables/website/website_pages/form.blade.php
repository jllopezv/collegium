<x-lopsoft.control.inputform
    wire:model.lazy='pagetitle'
    id='page'
    x-ref='page'
    label="{{ transup('page') }}"
    class='w-full'
    autofocus
    classcontainer='w-full'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode="{{ $mode }}"
    nextref='btnCreate'
/>

@livewire('controls.rich-editor-component', [
    'uuid'      => 'filemanagerbody',  // filemanager uuid
    'modelid'   => 'body',
    'default'   => $record->body??'',
    'event'     => 'eventsetbody',
    'label'     => transup('body'),
    'mode'      => $mode,
])

