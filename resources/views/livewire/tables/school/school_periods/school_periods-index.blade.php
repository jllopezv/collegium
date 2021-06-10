@extends('livewire.layouts.indexlayout', [ 'minwidth' => '1000px'])

@section('header')
    <x-lopsoft.datatable.header-th class='w-full' sortable sortorder='{{ $sortorder }}' columnname='period'>{{ transup('periodtype')}}</x-lopsoft.datatable.header-th>
    @include('components.lopsoft.datatable.header-anno-priority')
@endsection

@section('modelactions')
    @include('components.lopsoft.modelactions.showanno')
    @include('components.lopsoft.modelactions.showpriority')
@endsection

@section('sorts')
    <div class='w-full mr-2 md:w-auto md:hidden'>
        @livewire('controls.index-filter-component', [
            'mode'          => $mode,
            'label'         => transup('order'),
            'classdropdown' => 'w-full md:w-60',
            'options'       => [
                ['text' => transup('order'), 'value' => 'priority'],
                ['text' => 'ID', 'value' => 'id'],
                ['text' => transup('period'), 'value' => 'period'],
            ],
            'defaultvalue'  => $sortorder,
            'eventname'     => 'eventfilterorder',
            'uid'           => 'filterordercomponent',
            'modelid'       => 'orderid',
            'isTop'         =>  false,
        ])
    </div>
@endsection
