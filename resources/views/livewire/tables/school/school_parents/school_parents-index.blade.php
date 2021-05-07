@extends('livewire.layouts.indexlayout', [ 'minwidth' => '1200px'])

@section('header')
    <x-lopsoft.datatable.header-th class='w-16' justify='center'>{{ transup('photo') }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-80' sortable sortorder='{{ $sortorder }}' columnname='parent'>{{ transup('parent')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-40' >{{ transup('username')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-60' >{{ transup('email')}}</x-lopsoft.datatable.header-th>
@endsection
