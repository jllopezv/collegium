@extends('livewire.layouts.indexlayout', [ 'minwidth' => '1400px'])

@section('header')
    <x-lopsoft.datatable.header-th class='w-48' sortable sortorder='{{ $sortorder }}' columnname='code'>{{ transup('code')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-80' sortable sortorder='{{ $sortorder }}' columnname='subject'>{{ transup('schoolsubject')}}</x-lopsoft.datatable.header-th>
    @if($showOnlyAnno)
        <x-lopsoft.datatable.header-th class='w-60' sortable sortorder='{{ $sortorder }}' columnname='grade_id'>{{ transup('grade')}}</x-lopsoft.datatable.header-th>
        <x-lopsoft.datatable.header-th class='w-60' sortable sortorder='{{ $sortorder }}' columnname='period_id'>{{ transup('period')}}</x-lopsoft.datatable.header-th>
    @else
        <x-lopsoft.datatable.header-th class='w-60' >{{ transup('grade')}}</x-lopsoft.datatable.header-th>
        <x-lopsoft.datatable.header-th class='w-60'>{{ transup('period')}}</x-lopsoft.datatable.header-th>
    @endif
    <x-lopsoft.datatable.header-th-space class='w-full'></x-lopsoft.datatable.header-th-space>
    @include('components.lopsoft.datatable.header-anno-priority')
@endsection

@section('modelactions')
    @include('components.lopsoft.modelactions.showanno')
    @include('components.lopsoft.modelactions.showpriority')
@endsection

@section('filters')
    <div class='flex flex-wrap items-center justify-start'>
        <div class='w-full mr-2 md:w-auto'>
            @livewire('controls.index-filter-component', [
                'mode'          => $mode,
                'label'         => transup('level'),
                'classdropdown' => 'w-full md:w-60 mr-2 ',
                'options'       => \App\Lopsoft\LopHelp::getFilterDropdownBuilder(getUserAnnoSession()->schoolLevels(), 'id', 'level', '', true, 'priority'),
                'defaultvalue'  => '*',
                'eventname'     => 'eventfilterlevel',
                'uid'           => 'filterlevelcomponent',
                'modelid'       => 'level_id',
                'isTop'         =>  false,
            ])
        </div>
        <div class='w-full mr-2 md:w-auto'>
            @livewire('controls.index-filter-component', [
                'mode'          => $mode,
                'label'         => transup('grade'),
                'classdropdown' => 'w-full md:w-60 mr-2',
                'options'       => \App\Lopsoft\LopHelp::getFilterDropdownBuilder(getUserAnnoSession()->schoolGrades(), 'id', 'grade', '', true, 'priority'),
                'defaultvalue'  => '*',
                'eventname'     => 'eventfiltergrade',
                'uid'           => 'filtergradecomponent',
                'modelid'       => 'grade_id',
                'isTop'         =>  false,
            ])
        </div>
        <div class='w-full mr-2 md:w-auto'>
            @livewire('controls.index-filter-component', [
                'mode'          => $mode,
                'label'         => transup('period'),
                'classdropdown' => 'w-full md:w-60',
                'options'       => \App\Lopsoft\LopHelp::getFilterDropdownBuilder(getUserAnnoSession()->schoolPeriods(), 'id', 'period', '', true, 'priority'),
                'defaultvalue'  => '*',
                'eventname'     => 'eventfilterperiod',
                'uid'           => 'filterperiodcomponent',
                'modelid'       => 'period_id',
                'isTop'         =>  false,
            ])
        </div>
    </div>
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
                ['text' => transup('grade'), 'value' => 'grade_id'],
            ],
            'defaultvalue'  => $sortorder,
            'eventname'     => 'eventfilterorder',
            'uid'           => 'filterordercomponent',
            'modelid'       => 'orderid',
            'isTop'         =>  false,
        ])
    </div>
@endsection

