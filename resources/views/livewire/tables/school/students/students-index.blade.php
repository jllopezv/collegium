@extends('livewire.layouts.indexlayout', [ 'minwidth' => '500px'])

@section('header')
    <x-lopsoft.datatable.header-th class='w-16' justify='center'>{{ transup('photo') }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-80'  sortable sortorder='{{ $sortorder }}' columnname='first_surname'>{{ transup('student')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-60' sortable sortorder='{{ $sortorder }}' columnname='grade_id'>{{ transup('grade')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-40' sortable sortorder='{{ $sortorder }}'  columnname='section_id'>{{ transup('section')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-40' sortable sortorder='{{ $sortorder }}'  columnname='modality_id'>{{ transup('modality')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-24' justify='end' sortable sortorder='{{ $sortorder }}' columnname='priority'>{{ transup('priority')}}</x-lopsoft.datatable.header-th>
    @include('components.lopsoft.datatable.header-setpriority')
@endsection

@section('headerxs')
@endsection

@section('filters')
    <div class='flex flex-wrap items-center justify-start'>
        <div class='w-full mr-2 md:w-auto'>
            @livewire('controls.index-filter-component', [
                'mode'          => $mode,
                'label'         => transup('grade'),
                'classdropdown' => 'w-full md:w-60',
                'options'       => \App\Lopsoft\LopHelp::getFilterDropdownBuilder(getUserAnnoSession()->schoolGrades(), 'id', 'grade', '', true, ''),
                'defaultvalue'  => '*',
                'eventname'     => 'eventfiltergrade',
                'uid'           => 'filtergradecomponent',
                'modelid'       => 'gradeid',
                'isTop'         =>  false,
            ])
        </div>
        <div class='w-full mr-2 md:w-auto'>
            @livewire('controls.index-filter-component', [
                'mode'          => $mode,
                'label'         => transup('section'),
                'classdropdown' => 'w-full md:w-60',
                'options'       => \App\Lopsoft\LopHelp::getFilterDropdownBuilder(getUserAnnoSession()->schoolSections(), 'id', 'section', '', true, ''),
                'defaultvalue'  => '*',
                'eventname'     => 'eventfiltersection',
                'uid'           => 'filtersectioncomponent',
                'modelid'       => 'sectionid',
                'isTop'         =>  false,
            ])
        </div>
        <div class='w-full mr-2 md:w-auto'>
            @livewire('controls.index-filter-component', [
                'mode'          => $mode,
                'label'         => transup('batch'),
                'classdropdown' => 'w-full md:w-60',
                'options'       => \App\Lopsoft\LopHelp::getFilterDropdownBuilder(getUserAnnoSession()->schoolBatches(), 'id', 'batch', '', true, ''),
                'defaultvalue'  => '*',
                'eventname'     => 'eventfilterbatch',
                'uid'           => 'filterbatchcomponent',
                'modelid'       => 'batchid',
                'isTop'         =>  false,
            ])
        </div>
        <div class='w-full mr-2 md:w-auto'>
            @livewire('controls.index-filter-component', [
                'mode'          => $mode,
                'label'         => transup('modality'),
                'classdropdown' => 'w-full md:w-60',
                'options'       => \App\Lopsoft\LopHelp::getFilterDropdownBuilder(getUserAnnoSession()->schoolModalities(), 'id', 'modality', '', true, ''),
                'defaultvalue'  => '*',
                'eventname'     => 'eventfiltermodality',
                'uid'           => 'filtermodalitycomponent',
                'modelid'       => 'modalityid',
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
                ['text' => 'ID', 'value' => 'id'],
                ['text' => 'GRADO', 'value' => 'grade_id'],
                ['text' => 'SECCIÓN', 'value' => 'section_id'],
                ['text' => 'TANDA', 'value' => 'batch_id'],
                ['text' => 'MODALIDAD', 'value' => 'modality_id'],
            ],
            'defaultvalue'  => $sortorder,
            'eventname'     => 'eventfilterorder',
            'uid'           => 'filterordercomponent',
            'modelid'       => 'orderid',
            'isTop'         =>  false,
        ])
    </div>
@endsection
