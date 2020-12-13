<x-lopsoft.control.inputform
    wire:model.lazy='slug'
    id='slug'
    x-ref='slug'
    label="{{ transup('slug') }}"
    classcontainer='w-1/2'
    nextref='name'
    requiredfield
    help="{{ transup('mandatory_unique') }}"
    autofocus
    mode='{{ $mode }}'
/>
<x-lopsoft.control.inputform
    wire:model.lazy='name'
    id='name'
    x-ref='name'
    label="{{ transup('name') }}"
    classcontainer='w-full'
    nextref='description'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode='{{ $mode }}'
/>
<x-lopsoft.control.inputform
    wire:model.lazy='description'
    id='description'
    x-ref='description'
    label="{{ transup('description') }}"
    classcontainer='w-full'
    nextref='btnCreate'
    mode='{{ $mode }}'
/>
@livewire('controls.drop-down-table-component', [
    'model'         => \App\Models\Auth\PermissionGroup::class,
    'mode'          =>  $mode,
    'filterraw'     => '',
    'label'         => transup('group'),
    'key'           => 'id',
    'field'         => 'group',
    'defaultvalue'  => $record->group??null,
    'eventname'     => 'eventsetgroup',
    'linknew'       => route('permission_groups.create'),
    'uid'           => 'groupcomponent',
    'modelid'       => 'group',
])
