@extends('lopsoft.layouts.page')

@php
    $module='school';
    $component='student';
@endphp

@section('content')

    @include('livewire.partials.states.commonheader', ['mode' => 'create'] )

    <div class='flex flex-wrap items-top justify-center mt-4 p-2 w-full'>

        <div class='w-full  pb-4 xl:pr-4'>
            @livewire($module.'.'.$component.'-component', [
                'table'         =>  $table,
                'model'         =>  $model,
                'title'         =>  $title,
                'subtitle'      =>  $subtitle,
                'mode'          =>  'create',
                ])
        </div>

    </div>

@endsection
