@extends('livewire.layouts.indexlayout', [ 'minwidth' => "{{ (!$showOnlyAnno && $showPriority)?'1200px':'1000px' }}"])

@section('header')
    <x-lopsoft.datatable.header-th class='w-80' sortable sortorder='{{ $sortorder }}' columnname='section'>{{ transup('section')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-60' sortable sortorder='{{ $sortorder }}' columnname='grade'>{{ transup('grade')}}</x-lopsoft.datatable.header-th>
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
        'label'         => transup('grade'),
        'classdropdown' => 'w-full md:w-60',
        'options'       => \App\Lopsoft\LopHelp::getFilterDropdownBuilder(getUserAnnoSession()->schoolGrades(), 'id', 'grade', '', true, 'priority'),
        'defaultvalue'  => '*',
        'eventname'     => 'eventfiltergrade',
        'uid'           => 'filtergradecomponent',
        'modelid'       => 'gradeid',
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
