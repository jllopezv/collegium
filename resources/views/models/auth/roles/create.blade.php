@extends('lopsoft.layouts.page')

@php
    $module='auth';
    $component='role';
@endphp

@section('content')

    @include('livewire.partials.states.commonheader', ['mode' => 'create'] )

    <div class='flex flex-wrap items-top justify-center mt-4 p-2 w-full'>

        <div class='w-full xl:w-1/2 pb-4 xl:pr-4'>
            @livewire($module.'.'.$component.'-component', [
                'table'         =>  $table,
                'model'         =>  $model,
                'title'         =>  $title,
                'subtitle'      =>  $subtitle,
                'mode'          =>  'create',
                ])
        </div>



        <div class='w-full xl:w-1/2  xl:pl-1'>
            <div class='flex items-center justify-center mr-auto p-4 rounded-t-md bg-gray-700  text-white'>
                <div class='w-full py-2'>
                    <div class='text-lg font-bold'>
                        PERMISOS
                    </div>
                    <div class='text-sm text-gray-400'>
                        Seleccione los permisos asociados al rol.
                    </div>
                </div>
            </div>
            <div class='bg-white shadow-md rounded-b-md p-2 w-full'>

                <div class='flex items-center justify-center mt-4'>
                    <div>
                        @livewire('auth.permission-assign-component', ['permissionsselected' => []])
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
