@extends('livewire.layouts.indexlayout', [ 'minwidth' => '500px'])

@section('header')

    <x-lopsoft.datatable.header-th class='w-16' justify='center'>{{ transup('photo') }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-96'  sortable sortorder='{{ $sortorder }}' columnname='first_surname'>{{ transup('student')}}</x-lopsoft.datatable.header-th>
    @if($this->showOnlyEnrolls)
        <x-lopsoft.datatable.header-th class='w-60' sortable sortorder='{{ $sortorder }}' columnname='grade_id'>{{ transup('grade')}}</x-lopsoft.datatable.header-th>
        <x-lopsoft.datatable.header-th class='w-60' sortable sortorder='{{ $sortorder }}'  columnname='section_id'>{{ transup('section')}}</x-lopsoft.datatable.header-th>
        <x-lopsoft.datatable.header-th class='w-60' sortable sortorder='{{ $sortorder }}'  columnname='modality_id'>{{ transup('modality')}}</x-lopsoft.datatable.header-th>
    @else
        <x-lopsoft.datatable.header-th class='w-60' columnname='grade_id'>{{ transup('grade')}}</x-lopsoft.datatable.header-th>
        <x-lopsoft.datatable.header-th class='w-60' columnname='section_id'>{{ transup('section')}}</x-lopsoft.datatable.header-th>
        <x-lopsoft.datatable.header-th class='w-60' columnname='modality_id'>{{ transup('modality')}}</x-lopsoft.datatable.header-th>
    @endif

    <x-lopsoft.datatable.header-th-space class='w-full'></x-lopsoft.datatable.header-th-space>
    @include('components.lopsoft.datatable.header-anno-priority')
@endsection

@section('modelactions')
    @include('components.lopsoft.modelactions.showpriority')
    <div x-show='$wire.showOnlyEnrolls' class='mr-1 mb-1'>
        <x-lopsoft.button.gray
            wire:click='hideEnrolleds'
            icon='fa fa-graduation-cap'
            help='MOSTRAR NO INSCRITOS' helpclass='tooltiptext-up-right'>
        </x-lopsoft.button.gray>
    </div>
    <div x-cloak x-show='!$wire.showOnlyEnrolls' class='mr-1 mb-1'>
        <x-lopsoft.button.coolgray
            wire:click='showEnrolleds'
            icon='fa fa-graduation-cap'
            help='MOSTRAR SOLO INSCRITOS' helpclass='tooltiptext-up-right'>
        </x-lopsoft.button.coolgray>
    </div>
@endsection

@section('filters')
    <div class='flex flex-wrap items-center justify-start'>
        <div class='w-full mr-2 md:w-auto'>
            @livewire('controls.index-filter-component', [
                'mode'          => $mode,
                'label'         => transup('level'),
                'classdropdown' => 'w-full md:w-60',
                'options'       => \App\Lopsoft\LopHelp::getFilterDropdownBuilder(getUserAnnoSession()->schoolLevels(), 'id', 'level', '', true, ''),
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
                'classdropdown' => 'w-full md:w-60',
                'options'       => \App\Lopsoft\LopHelp::getFilterDropdownBuilder(getUserAnnoSession()->schoolGrades(), 'id', 'grade', '', true, ''),
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
                'label'         => transup('section'),
                'classdropdown' => 'w-full md:w-60',
                'options'       => \App\Lopsoft\LopHelp::getFilterDropdownBuilder(getUserAnnoSession()->schoolSections(), 'id', 'section', '', true, ''),
                'defaultvalue'  => '*',
                'eventname'     => 'eventfiltersection',
                'uid'           => 'filtersectioncomponent',
                'modelid'       => 'section_id',
                'isTop'         =>  false,
                'template'      => 'components.lopsoft.dropdown.schoolsections'
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
