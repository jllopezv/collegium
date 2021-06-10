@extends('livewire.layouts.indexlayout', [ 'minwidth' => "1000px" ])

@section('header')
    <x-lopsoft.datatable.header-th class='w-80' sortable sortorder='{{ $sortorder }}' columnname='type'>{{ transup('type')}}</x-lopsoft.datatable.header-th>
@endsection


@section('sorts')
    <div class='w-full mr-2 md:w-auto md:hidden'>
        @livewire('controls.index-filter-component', [
            'mode'          => $mode,
            'label'         => transup('order'),
            'classdropdown' => 'w-full md:w-60',
            'options'       => [
                ['text' => 'ID', 'value' => 'id'],
                ['text' => transup('type'), 'value' => 'type'],
            ],
            'defaultvalue'  => $sortorder,
            'eventname'     => 'eventfilterorder',
            'uid'           => 'filterordercomponent',
            'modelid'       => 'orderid',
            'isTop'         =>  false,
        ])
    </div>
@endsection
