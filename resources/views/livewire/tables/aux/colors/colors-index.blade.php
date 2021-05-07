@extends('livewire.layouts.indexlayout')

@section('header')
    <x-lopsoft.datatable.header-th class='w-full' sortable sortorder='{{ $sortorder }}' columnname='name'>{{ transup('color') }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-3/4'>{{ transup('preview') }}</x-lopsoft.datatable.header-th>
@endsection
