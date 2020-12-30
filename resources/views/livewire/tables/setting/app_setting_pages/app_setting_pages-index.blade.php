@extends('livewire.layouts.indexlayout', ['minwidth' => '500px'])

@section('header')
    <x-lopsoft.datatable.header-th class='w-16'  justify='end' sortable sortorder='{{ $sortorder }}' columnname='id'>ID</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-24' justify='end' sortable sortorder='{{ $sortorder }}' columnname='priority'>{{ transup('order') }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-full' sortable sortorder='{{ $sortorder }}' columnname='settingpage'>{{ transup('page') }}</x-lopsoft.datatable.header-th>
@endsection

@section('headerxs')
@endsection
