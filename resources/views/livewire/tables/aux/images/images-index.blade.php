@extends('livewire.layouts.indexlayout')

@section('header')
    <x-lopsoft.datatable.header-th class='w-28' justify='center'>{{ transup('image') }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-full' sortable sortorder='{{ $sortorder }}' columnname='tag'>{{ transup('tag')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-full' sortable sortorder='{{ $sortorder }}' columnname='imageable_type'>{{ transup('type')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-full' sortable sortorder='{{ $sortorder }}' columnname='imageable_id'>{{ transup('id')}}</x-lopsoft.datatable.header-th>
@endsection

@section('headerxs')
@endsection
