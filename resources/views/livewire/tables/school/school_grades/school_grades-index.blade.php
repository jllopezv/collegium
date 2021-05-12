@extends('livewire.layouts.indexlayout', [ 'minwidth' => '1400px'])

@section('header')
    <x-lopsoft.datatable.header-th class='w-80' sortable sortorder='{{ $sortorder }}' columnname='grade'>{{ transup('grade')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-80' sortable sortorder='{{ $sortorder }}' columnname='level_id'>{{ transup('level')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th-space class='w-full'></x-lopsoft.datatable.header-th-space>
    @include('components.lopsoft.datatable.header-anno-priority')
@endsection

@section('modelactions')
    @include('components.lopsoft.modelactions.showanno')
    @include('components.lopsoft.modelactions.showpriority')
@endsection

@section('filters')
    @livewire('controls.index-filter-component', [
        'mode'          => $mode,
        'label'         => transup('level'),
        'classdropdown' => 'w-full md:w-60',
        'options'       => \App\Lopsoft\LopHelp::getFilterDropdownBuilder(getUserAnnoSession()->schoolLevels(), 'id', 'level', '', true, 'priority'),
        'defaultvalue'  => '*',
        'eventname'     => 'eventfilterlevel',
        'uid'           => 'filterlevelcomponent',
        'modelid'       => 'levelid',
        'isTop'         =>  false,
    ])
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
                ['text' => transup('grade'), 'value' => 'grade'],
                ['text' => transup('level'), 'value' => 'level_id'],
            ],
            'defaultvalue'  => $sortorder,
            'eventname'     => 'eventfilterorder',
            'uid'           => 'filterordercomponent',
            'modelid'       => 'orderid',
            'isTop'         =>  false,
        ])
    </div>
@endsection

