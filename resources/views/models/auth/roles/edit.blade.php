@extends('lopsoft.layouts.page')

@php
    $module='auth';
    $component='role';
@endphp

@section('content')

@include('livewire.partials.states.commonheader', ['mode' => 'edit'] )

<div class='flex flex-wrap justify-center w-full p-2 mt-4 items-top'>

    <div class='w-full pb-4 xl:w-1/2 xl:pr-4'>
        @livewire($module.'.'.$component.'-component', [
            'table'         =>  $table,
            'model'         =>  $model,
            'title'         =>  $title,
            'subtitle'      =>  $subtitle,
            'mode'          =>  'edit',
            'recordid'      =>  $recordid,
            ])
    </div>

    <div class='w-full xl:w-1/2 xl:pl-1'>
        <div class='flex items-center justify-center p-4 mr-auto text-white bg-gray-700 rounded-t-md'>
            <div class='w-full py-2'>
                <div class='text-lg font-bold'>
                    PERMISOS
                </div>
                <div class='text-sm text-gray-400'>
                    Seleccione los permisos asociados al rol.
                </div>
            </div>
        </div>
        <div class='w-full p-2 bg-white shadow-md rounded-b-md'>

            <div class='flex items-center justify-center mt-4'>
                <div class='w-full'>
                    @livewire('auth.permission-assign-component', [
                        'permissionsselected'   => $record->permissionsArray(),
                        'mode'                  => 'edit' ])
                </div>
            </div>
        </div>
    </div>

    <div class='h-32'></div>

</div>

<div class='w-full p-2'>
    @livewire($module.'.'.$component.'-component', \App\Lopsoft\LopHelp::getCommonOptionsIndexSlaveComponents($table, $model, $title, $subtitle))
</div>


@endsection
