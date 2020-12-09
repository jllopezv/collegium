@extends('livewire.layouts.indexlayout')

@section('header')
    <x-lopsoft.datatable.header-th class='w-16' justify='end' sortable sortorder='{{ $sortorder }}' columnname='id'>ID</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-60' sortable sortorder='{{ $sortorder }}' columnname='group'>GRUPO</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-60' sortable sortorder='{{ $sortorder }}' columnname='slug'>SLUG</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-3/4' sortable sortorder='{{ $sortorder }}' columnname='name'>NOMBRE</x-lopsoft.datatable.header-th>
@endsection

@section('headerxs')
@endsection
