@extends('livewire.layouts.indexlayout', [ 'minwidth' => '800px'])

@section('header')
    <x-lopsoft.datatable.header-th class='w-40' sortable sortorder='{{ $sortorder }}' columnname='group'>GRUPO</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-52' sortable sortorder='{{ $sortorder }}' columnname='slug'>SLUG</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-3/4' sortable sortorder='{{ $sortorder }}' columnname='name'>NOMBRE</x-lopsoft.datatable.header-th>
@endsection

@section('headerxs')
@endsection
