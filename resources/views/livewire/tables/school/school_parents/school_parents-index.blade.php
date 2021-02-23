@extends('livewire.layouts.indexlayout', [ 'minwidth' => '800px'])

@section('header')
    <x-lopsoft.datatable.header-th class='w-full' sortable sortorder='{{ $sortorder }}' columnname='parent'>{{ transup('parent')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-full' >{{ transup('username')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-full' >{{ transup('email')}}</x-lopsoft.datatable.header-th>
@endsection

@section('headerxs')
@endsection
