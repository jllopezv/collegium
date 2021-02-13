@extends('livewire.layouts.indexlayout', [ 'minwidth' => '1400px'])

@section('header')
    <x-lopsoft.datatable.header-th class='w-16' justify='center'>{{ transup('photo') }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-full' sortable sortorder='{{ $sortorder }}' columnname='first_surname'>{{ transup('student')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-40' sortable sortorder='{{ $sortorder }}' columnname='grade_id'>{{ transup('grade')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-80' sortable sortorder='{{ $sortorder }}'  columnname='section_id'>{{ transup('section')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-24' justify='end' sortable sortorder='{{ $sortorder }}' columnname='priority'>{{ transup('priority')}}</x-lopsoft.datatable.header-th>
    @include('components.lopsoft.datatable.header-setpriority')
@endsection

@section('headerxs')
@endsection


@section('filters')
    @livewire('controls.index-filter-component', [
        'mode'          => $mode,
        'label'         => transup('grade'),
        'classdropdown' => 'md:w-60',
        'options'       => \App\Lopsoft\LopHelp::getFilterDropdownBuilder(getUserAnnoSession()->schoolGrades(), 'id', 'grade', '', true, ''),
        'defaultvalue'  => '*',
        'eventname'     => 'eventfiltergrade',
        'uid'           => 'filtergradecomponent',
        'modelid'       => 'gradeid',
        'isTop'         =>  false,
    ])
@endsection
