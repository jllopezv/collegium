<div class='flex items-center justify-end'>
    <div class='mr-2'>
        <x-lopsoft.control.checkbox
            id='published'
            label="<i class='text-green-400 cursor-pointer fa fa-globe-americas fa-fw fa-xl'></i>"
            color='text-green-400' classlabel='font-bold'
            wire:model='published'
            help='PUBLICADO'
            mode="{{ $mode }}"
            />
    </div>
    <div class='mr-2'>
        <x-lopsoft.control.checkbox
            id='top'
            label="<i class='text-blue-400 cursor-pointer far fa-thumbs-up fa-fw fa-xl'></i>"
            color='text-blue-400' classlabel='font-bold'
            wire:model='top'
            help='TOP'
            mode="{{ $mode }}"
            />
    </div>
    <div class='mr-2'>
        <x-lopsoft.control.checkbox
            id='fixed'
            label="<i class='text-red-400 cursor-pointer fa fa-thumbtack fa-fw fa-xl'></i>"
            color='text-red-400' classlabel='font-bold'
            wire:model='fixed'
            help='FIJADO'
            mode="{{ $mode }}"
            />
    </div>
    <div class=''>
        <x-lopsoft.control.checkbox
            id='starred'
            label="<i class='text-yellow-300 cursor-pointer fa fa-star fa-fw fa-xl'></i>"
            color='text-yellow-300' classlabel='font-bold'
            wire:model='starred'
            help='DESTACADO'
            mode="{{ $mode }}"
            />
    </div>
</div>

@include('livewire.partials.showed')

@include('livewire.partials.image', [
    'mode'       => $mode,
    'table'      => $table,
    'image'      => $image,
    'max_height' => appsetting('news_default_height'),

])

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


@livewire('filemanager.filemanager', ['uuid' => 'filemanager-'.$table, 'multiselect' => false, 'root' => '/', 'allowedmimetypes' => '' ])

<x-lopsoft.control.inputform
    wire:model.lazy='posttitle'
    id='title'
    x-ref='title'
    label="{{ transup('title') }}"
    class='w-full'
    autofocus
    classcontainer='w-full'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode="{{ $mode }}"
    nextref='btnCreate'
/>


 @livewire('controls.drop-down-table-component', [
    'model'         => \App\Models\Website\WebsiteNewsCat::class,
    'mode'          =>  $mode,
    'filterraw'     => '',
    'sortorder'     => 'priority',
    'label'         =>  mb_strtoupper(trans('lopsoft.category')),
    'classdropdown' => 'w-1/4',
    'key'           => 'id',
    'field'         => 'category',
    'defaultvalue'  =>  $record->website_news_cat_id??null,
    'eventname'     => 'eventsetcat',
    'uid'           => 'website_news_cat_component',
    'modelid'       => 'website_news_cat_id',
    'isTop'         =>  false,
    'template'      => 'components.lopsoft.dropdown.websitenewscat',
])

@livewire('filemanager.filemanager', ['uuid' => 'filemanagerbody', 'multiselect' => false, 'root' => '/', 'allowedmimetypes' => '' ])

@livewire('controls.rich-editor-component', [
    'uuid'      => 'filemanagerbody',  // filemanager uuid
    'modelid'   => 'body',
    'default'   => $record->body??'',
    'event'     => 'eventsetbody',
    'label'     => transup('body'),
    'mode'      => $mode,
])

