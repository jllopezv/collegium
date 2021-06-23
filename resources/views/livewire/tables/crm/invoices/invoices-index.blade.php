@extends('livewire.layouts.indexlayout', [ 'minwidth' => '1200px'])

@section('header')
    <x-lopsoft.datatable.header-th class='w-80' sortable sortorder='{{ $sortorder }}' columnname='ref'>{{ transup('ref')}}</x-lopsoft.datatable.header-th>
@endsection
