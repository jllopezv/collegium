<x-lopsoft.control.inputform
    wire:model.lazy='pagetitle'
    id='page'
    x-ref='page'
    label="{{ transup('page') }}"
    class='w-full'
    classcontainer='w-full'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode="{{ $mode }}"
/>

@livewire('controls.rich-editor-component', [
    'uuid'      => 'filemanagerbody',  // filemanager uuid
    'modelid'   => 'body',
    'default'   => $record->body??'',
    'event'     => 'eventsetbody',
    'label'     => transup('body'),
    'mode'      => $mode,
])


@livewire('filemanager.filemanager', ['uuid' => 'filemanagerbody', 'multiselect' => false, 'root' => '/', 'allowedmimetypes' => '' ])


