@extends('livewire.layouts.indexlayout')

@section('header')
    <x-lopsoft.datatable.header-th class='w-1/3' sortable sortorder='{{ $sortorder }}' columnname='language'>{{ transup('language') }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-60' sortable sortorder='{{ $sortorder }}' columnname='code'>{{ transup('code') }}</x-lopsoft.datatable.header-th>
@endsection

@section('headerxs')
@endsection
