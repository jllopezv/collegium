@extends('lopsoft.layouts.page')

@php
    $module='school';
    $component='student';
@endphp

@section('content')

    @include('livewire.partials.states.commonheader', ['mode' => 'create'] )

    <div class='flex flex-wrap justify-center w-full p-2 mt-4 items-top'>

        <div class='w-full pb-4 xl:pr-4'>
            @livewire($module.'.'.$component.'-component', [
                'table'         =>  $table,
                'model'         =>  $model,
                'title'         =>  $title,
                'subtitle'      =>  $subtitle,
                'mode'          =>  'create',
                ])
        </div>

    </div>

    <div class='h-32'></div>

@endsection
