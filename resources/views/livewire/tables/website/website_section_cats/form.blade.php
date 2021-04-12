<x-lopsoft.control.inputform
    wire:model.lazy='priority'
    id='priority'
    x-ref='priority'
    label="{{ transup('priority') }}"
    sublabel='Orden en el que se mostrará cuando vaya a elegir el nivel en otro formulario'
    nextref='level'
    classcontainer='w-24'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode="{{ $mode }}"
/>
<x-lopsoft.control.inputform
    wire:model.lazy='category'
    id='category'
    x-ref='category'
    label="{{ transup('category') }}"
    class='w-full'
    autofocus
    classcontainer='w-full'
    requiredfield
    help="{{ transup('mandatory_unique') }}"
    mode="{{ $mode }}"
    nextref='btnCreate'
/>


@livewire('controls.drop-down-table-component', [
    'model'         => \App\Models\Aux\Color::class,
    'mode'          =>  $mode,
    'filterraw'     => '',
    'sortorder'     => 'id',
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

