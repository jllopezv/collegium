@extends('livewire.layouts.indexlayout', [ 'minwidth' => '1000px'])

@section('header')
<x-lopsoft.datatable.header-th class='w-24' justify='end' sortable sortorder='{{ $sortorder }}' columnname='priority'>{{ transup('priority')}}</x-lopsoft.datatable.header-th>
@include('components.lopsoft.datatable.header-setpriority')
<x-lopsoft.datatable.header-th class='w-28' justify='center'>{{ transup('image') }}</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th class='w-32' justify='center'><i class='fa fa-question-circle'></i></x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th class='w-full' sortable sortorder='{{ $sortorder }}' columnname='title'>{{ transup('title')}}</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th class='w-40' sortable sortorder='{{ $sortorder }}' columnname='website_post_cat_id'>{{ transup('category')}}</x-lopsoft.datatable.header-th>
@endsection

@section('filters')
    @livewire('controls.index-filter-component', [
        'mode'          => $mode,
        'label'         => transup('category'),
        'classdropdown' => 'md:w-60',
        'options'       => \App\Lopsoft\LopHelp::getFilterDropdown(\App\Models\Website\WebsiteSectionCat::class, 'category', 'id', '', true, 'priority asc'),
        'defaultvalue'  => '*',
        'eventname'     => 'eventfiltercat',
        'uid'           => 'filtercatcomponent',
        'modelid'       => 'catid',
        'isTop'         =>  false,
    ])
@endsection

