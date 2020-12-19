<x-lopsoft.control.inputform
    wire:model.lazy='role'
    id='role'
    x-ref='role'
    label="{{ transup('role') }}"
    classcontainer='w-full md:w-3/4'
    nextref='level'
    requiredfield
    help="{{ transup('mandatory_unique') }}"
    autofocus
    mode='{{ $mode }}'
/>
<x-lopsoft.control.inputform
    wire:model.lazy='level'
    id='level'
    x-ref='level'
    label="{{ transup('level') }}"
    classcontainer='w-20'
    nextref='description'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode='{{ $mode }}'
/>
<x-lopsoft.control.inputform
    wire:model.lazy='dashboard'
    id='dashboard'
    x-ref='dashboard'
    label="{{ transup('dashboard') }}"
    classcontainer='w-full md:w-3/4'
    nextref='color'
    mode='{{ $mode }}'
/>

@livewire('controls.drop-down-table-component', [
    'model'         => \App\Models\Aux\Color::class,
    'mode'          =>  $mode,
    'filterraw'     => '',
    'label'         => transup('color'),
    'key'           => 'id',
    'field'         => 'name',
    'defaultvalue'  => $record->color_id??null,
    'eventname'     => 'eventsetcolor',
    'linknew'       => route('colors.create'),
    'uid'           => 'colorcomponent',
    'modelid'       => 'color_id',
    'template'      => 'components.lopsoft.dropdown.colors',
    'cansearch'     => true,
    'isTop'         => true,
    'classdropdown' => 'w-full sm:w-2/3',
])

