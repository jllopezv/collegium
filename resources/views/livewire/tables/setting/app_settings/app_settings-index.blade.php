@extends('livewire.layouts.indexlayout', ['minwidth' => '1200px'])

@section('header')
    <x-lopsoft.datatable.header-th class='w-24' justify='end' sortable sortorder='{{ $sortorder }}' columnname='priority'>{{ transup('order') }}</x-lopsoft.datatable.header-th>
    @include('components.lopsoft.datatable.header-setpriority')
    <x-lopsoft.datatable.header-th class='w-36' sortable sortorder='{{ $sortorder }}' columnname='page_id'>{{ transup('page') }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-60' sortable sortorder='{{ $sortorder }}' columnname='settingkey'>{{ transup('key') }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-full' sortable sortorder='{{ $sortorder }}' columnname='settingvalue'> {{ transup('value') }} </x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-16' justify='center' sortable sortorder='{{ $sortorder }}' columnname='type'>{{ transup('type') }}</x-lopsoft.datatable.header-th>
@endsection

@section('filters')
    @livewire('controls.index-filter-component', [
        'mode'          => $mode,
        'label'         => transup('page'),
        'classdropdown' => 'md:w-60',
        'options'       => \App\Lopsoft\LopHelp::getFilterDropdown(\App\Models\Setting\AppSettingPage::class, 'id', 'settingpage', Auth::user()->level!=1?'onlysuperadmin=0':'', true, 'priority asc'),
        'defaultvalue'  => '*',
        'eventname'     => 'eventfilterpage',
        'uid'           => 'filterpagecomponent',
        'modelid'       => 'pageid',
        'isTop'         =>  false,
    ])
@endsection
