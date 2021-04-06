@extends('livewire.layouts.indexlayout', [ 'minwidth' => '500px'])

@section('header')
<x-lopsoft.datatable.header-th class='w-24' justify='end' sortable sortorder='{{ $sortorder }}' columnname='priority'>{{ transup('priority')}}</x-lopsoft.datatable.header-th>
@include('components.lopsoft.datatable.header-setpriority')
<x-lopsoft.datatable.header-th width='w-full' sortable sortorder='{{ $sortorder }}' columnname='menu'>{{ transup('menu')}}</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th width='w-full' >{{ transup('destination')}}</x-lopsoft.datatable.header-th>
@endsection

@section('headerxs')
@endsection


@section('filters')
    @livewire('controls.index-filter-component', [
        'mode'          => $mode,
        'label'         => transup('father'),
        'classdropdown' => 'md:w-60',
        'options'       => \App\Lopsoft\LopHelp::getFilterDropdown(\App\Models\Website\WebsiteMenu::class, 'menu', 'label', '', false, 'priority asc'),
        'defaultvalue'  => 'ROOT',
        'eventname'     => 'eventfiltermenu',
        'uid'           => 'filtermenucomponent',
        'modelid'       => 'menuid',
        'isTop'         =>  false,
    ])
@endsection
