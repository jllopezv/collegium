<x-lopsoft.control.inputform
    wire:model.lazy='settingkey'
    id='settingkey'
    x-ref='settingkey'
    label="{{ transup('key') }}"
    sublabel="Descriptor único de la configuración"
    autofocus
    classcontainer='w-full md:w-1/2 xl:w-full'
    requiredfield
    help="{{ transup('mandatory_unique') }}"
    nextref='settingdesc'
    mode="{{ $mode }}"
/>
<x-lopsoft.control.inputform
    wire:model.lazy='settingdesc'
    id='settingdesc'
    x-ref='settingdesc'
    label="{{ transup('description') }}"
    autofocus
    classcontainer='w-full'
    requiredfield
    help="{{ transup('mandatory_unique') }}"
    nextref='settingvalue'
    mode="{{ $mode }}"
/>

<div class='inline-flex items-center justify-start w-full'>
    <div class='mr-2'>
        @livewire('controls.drop-down-component', [
                'mode'          => $mode,
                'label'         => transup('type'),
                'classdropdown' => 'w-60',
                'options'       => \App\Lopsoft\LopHelp::getAppSettingTypesDropDown(),
                'defaultvalue'  => $record->type??'text',
                'eventname'     => 'eventsettype',
                'uid'           => 'typecomponent',
                'modelid'       => 'type',
                'isTop'         =>  true,
            ])
    </div>
    <div x-data='{}' class='w-full'>

        <div x-show="$wire.type=='text' || $wire.type=='number'">
            <x-lopsoft.control.inputform
                wire:model.lazy='settingvalue'
                id='settingvalue'
                x-ref='settingvalue'
                label="{{ transup('value') }}"
                autofocus
                classcontainer='w-full'
                requiredfield
                help="{{ transup('mandatory_unique') }}"
                nextref='type'
                mode="{{ $mode }}"
            />
        </div>

        <div x-show="$wire.type=='boolean'" >
            <x-lopsoft.control.checkboxform label="{{ transup('value') }}" model='typecheckbox' color='text-blue-400' classlabel='font-bold'/>
        </div>

        <div x-show="$wire.type=='image'" >
            <x-lopsoft.control.imageform
                wire:model.lazy='typeimage'
                id='typeimage'
                x-ref='typeimage'
                label="{{ transup('image') }}"
                autofocus
                classcontainer='w-full'
                requiredfield
                help="{{ transup('mandatory_unique') }}"
                nextref='type'
                mode="{{ $mode }}"
                fileid="filetypeimage"
            />
        </div>

    </div>
</div>

@livewire('controls.drop-down-table-component', [
    'model'         => \App\Models\Setting\AppSettingPage::class,
    'mode'          =>  $mode,
    'filterraw'     => '',
    'label'         => transup('page'),
    'sublabel'      => 'Página dónde se guardará la configuración',
    'key'           => 'id',
    'field'         => 'settingpage',
    'defaultvalue'  => $record->page_id??null,
    'eventname'     => 'eventsetpage',
    'linknew'       => route('app_setting_pages.create'),
    'uid'           => 'appsettingpagecomponent',
    'modelid'       => 'page_id',
    'isTop'         =>  true,
])

@livewire('filemanager.filemanager', ['uuid' => 'filemanager-'.$table, 'multiselect' => false, 'root' => '/', 'allowedmimetypes' => '' ])
