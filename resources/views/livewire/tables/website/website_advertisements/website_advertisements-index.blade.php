@extends('livewire.layouts.indexlayout', [ 'minwidth' => '1000px'])

@section('header')
<x-lopsoft.datatable.header-th class='w-28' justify='center'>{{ transup('image') }}</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th class='w-32' justify='center'><i class='fa fa-question-circle'></i></x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th class='w-full' sortable sortorder='{{ $sortorder }}' columnname='title'>{{ transup('title')}}</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th class='w-40' sortable sortorder='{{ $sortorder }}' columnname='website_post_cat_id'>{{ transup('category')}}</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th class='w-28' justify='center' sortable sortorder='{{ $sortorder }}' columnname='showed'><i class='fa fa-eye text-green-300'></i></x-lopsoft.datatable.header-th>
@endsection
