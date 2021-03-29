<x-lopsoft.control.inputform
    wire:model.lazy='priority'
    id='priority'
    x-ref='priority'
    label="{{ transup('priority') }}"
    sublabel="Orden en el que se mostrará cuando vaya a elegir el nivel en otro formulario"
    nextref='level'
    classcontainer='w-24'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode="{{ $mode }}"
/>
<x-lopsoft.control.inputform
    wire:model.lazy='menu'
    id='menu'
    x-ref='menu'
    label="{{ transup('menu') }}"
    sublabel="Nombre único para idenficar al menú"
    class='w-full'
    autofocus
    classcontainer='w-1/2'
    requiredfield
    help="{{ transup('mandatory_unique') }}"
    mode="{{ $mode }}"
    nextref='btnCreate'
/>
<x-lopsoft.control.inputform
    wire:model.lazy='label'
    id='label'
    x-ref='label'
    label="{{ transup('label') }}"
    sublabel='Nombre que aparecerá en el menú'
    class='w-full'
    autofocus
    classcontainer='w-full'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode="{{ $mode }}"
    nextref='btnCreate'
/>


@livewire('controls.drop-down-table-component', [
    'model'         => \App\Models\Website\WebsiteMenu::class,
    'mode'          =>  $mode,
    'filterraw'     => '',
    'sortorder'     => 'id',
    'label'         => transup('father'),
    'sublabel'      => 'Menú padre',
    'key'           => 'id',
    'field'         => 'menu',
    'defaultvalue'  => $record->parent_id??null,
    'eventname'     => 'eventsetparent',
    'linknew'       => route('website_menus.create'),
    'uid'           => 'parentcomponent',
    'modelid'       => 'parent_id',
    'cansearch'     => true,
    'isTop'         => true,
    'classdropdown' => 'w-full sm:w-2/3',
    'requiredfield' => 'true',
    'help'          => transup('mandatory')
])


<x-lopsoft.control.inputform
    wire:model.lazy='menulink'
    id='menulink'
    x-ref='menulink'
    label="{{ transup('link') }}"
    sublabel="Enlace al que apunta el menú<br/><span class='text-red-400'>Deje en blanco si desea acceder a una página</span>"
    class='w-full'
    autofocus
    classcontainer='w-full'
    mode="{{ $mode }}"
    placeholder='https://www.example.com'
    nextref='btnCreate'
/>


@livewire('controls.drop-down-table-component', [
    'model'         => \App\Models\Website\WebsitePage::class,
    'mode'          =>  $mode,
    'filterraw'     => '',
    'sortorder'     => 'id',
    'label'         => transup('page'),
    'sublabel'      => 'Página a la que accederá el menú',
    'key'           => 'id',
    'field'         => 'page',
    'defaultvalue'  => $record->website_page_id??null,
    'eventname'     => 'eventsetpage',
    'linknew'       => route('website_pages.create'),
    'uid'           => 'pagecomponent',
    'modelid'       => 'website_page_id',
    'cansearch'     => true,
    'isTop'         => true,
    'classdropdown' => 'w-full',
])

