@extends('livewire.layouts.indexlayout', [ 'minwidth' => '800px'])

@section('header')
    <x-lopsoft.datatable.header-th class='w-full' sortable sortorder='{{ $sortorder }}' columnname='group'>GRUPO</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-24' justify='end' sortable sortorder='{{ $sortorder }}' columnname='priority'>ORDEN</x-lopsoft.datatable.header-th>
    @include('components.lopsoft.datatable.header-setpriority')
@endsection

