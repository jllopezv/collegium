@include('livewire.partials.states.commonheader', ['mode' => 'edit'] )

<div class='flex flex-wrap items-top justify-center mt-4 p-2 w-full'>

    <div class='w-full xl:w-1/2 pb-4 xl:pr-4'>
        @livewire($module.'.'.$component.'-component', [
            'table'         =>  $table,
            'title'         =>  $title,
            'subtitle'      =>  $subtitle,
            'mode'          =>  'edit',
            'model'         =>  $model,
            'recordid'      =>  $recordid,
            ])
    </div>

    <div class='w-full xl:w-1/2  xl:pl-1'>
        @livewire($module.'.'.$component.'-component', \App\Lopsoft\LopHelp::getCommonOptionsIndexSlaveComponents($table, $model, $title, $subtitle))
    </div>

</div>
