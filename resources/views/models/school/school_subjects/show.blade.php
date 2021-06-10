@extends('lopsoft.layouts.page')

@php
    $module='school';
    $component='school-subject';
@endphp

@section('content')

    @include('livewire.partials.states.commonheader', ['mode' => 'show'] )

    <div class='justify-center inline-block w-full p-2 mt-4 items-top'>

        <div class='w-full mx-auto lg:w-3/4'>
            @livewire($module.'.'.$component.'-component', [
                'table'         =>  $table,
                'model'         =>  $model,
                'title'         =>  $title,
                'subtitle'      =>  $subtitle,
                'mode'          =>  'show',
                'recordid'      =>  $recordid,
                ])
        </div>

    </div>

    <div class='h-32'></div>

@endsection
