@extends('livewire.layouts.indexlayout', [ 'minwidth' => '1000px'])

@section('header')
<x-lopsoft.datatable.header-th class='w-16' justify='end' sortable sortorder='{{ $sortorder }}' columnname='id'>ID</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th class='w-28' justify='center'>{{ transup('image') }}</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th class='w-full' sortable sortorder='{{ $sortorder }}' columnname='title'>{{ transup('title')}}</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th class='w-40' sortable sortorder='{{ $sortorder }}' columnname='website_post_cat_id'>{{ transup('category')}}</x-lopsoft.datatable.header-th>
@endsection

@section('headerxs')
@endsection
