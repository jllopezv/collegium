@include('livewire.partials.states.commonheader', ['mode' => 'edit'] )

<div class='flex flex-wrap justify-center w-full p-2 mt-4 items-top'>

    <div class='w-full pb-4 xl:w-1/2 xl:pr-4'>
        @livewire($module.'.'.$component.'-component', [
            'table'         =>  $table,
            'title'         =>  $title,
            'subtitle'      =>  $subtitle,
            'mode'          =>  'edit',
            'model'         =>  $model,
            'recordid'      =>  $recordid,
            ])
    </div>

    <div class='w-full xl:w-1/2 xl:pl-1'>
        @livewire($module.'.'.$component.'-component', \App\Lopsoft\LopHelp::getCommonOptionsIndexSlaveComponents($table, $model, $title, $subtitle))
    </div>

</div>

<div class='h-32'></div>
