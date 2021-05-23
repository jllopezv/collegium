@extends('livewire.layouts.indexlayout', [ 'minwidth' => '1200px'])

@section('header')
    <x-lopsoft.datatable.header-th class='w-16' justify='center'>{{ transup('photo') }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-80' sortable sortorder='{{ $sortorder }}' columnname='employee'>{{ transup('employee')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-40' sortable sortorder='{{ $sortorder }}' columnname='employee_type_id' >{{ transup('type')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-60' sortable sortorder='{{ $sortorder }}' columnname='hired' >{{ transup('hired')}}</x-lopsoft.datatable.header-th>
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
                'label'         => transup('type'),
                'classdropdown' => 'w-full md:w-60 mr-2 ',
                'options'       => \App\Lopsoft\LopHelp::getFilterDropdownBuilder(\App\Models\Crm\EmployeeType::query(), 'id', 'type', '', true, 'type'),
                'defaultvalue'  => '*',
                'eventname'     => 'eventfiltertype',
                'uid'           => 'filtertypecomponent',
                'modelid'       => 'type_id',
                'isTop'         =>  false,
            ])
        </div>
    </div>
@endsection

