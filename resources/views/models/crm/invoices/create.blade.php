@extends('lopsoft.layouts.page')

@php
    $module='crm';
    $component='invoice';
@endphp

@section('content')

    @include('livewire.partials.states.commonheader', ['mode' => 'create'] )

    <div class='justify-center inline-block w-full p-2 mt-4 items-top'>

        <div class='w-full mx-auto'>
            @livewire($module.'.'.$component.'-component', [
                'table'         =>  $table,
                'model'         =>  $model,
                'title'         =>  $title,
                'subtitle'      =>  $subtitle,
                'mode'          =>  'create',
                'invoice_source' => $invoice_source??'',
                'invoice_source_id' => $invoice_source_id??0,
                'hideselectsource'  => $hideselectsource??false,
                ])
        </div>

    </div>

    <div class='h-32'></div>

@endsection

