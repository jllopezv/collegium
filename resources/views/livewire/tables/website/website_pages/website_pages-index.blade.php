@extends('livewire.layouts.indexlayout', [ 'minwidth' => '1000px'])

@section('header')
<x-lopsoft.datatable.header-th class='w-full' sortable sortorder='{{ $sortorder }}' columnname='page'>{{ transup('page')}}</x-lopsoft.datatable.header-th>
@endsection

@section('headerxs')
@endsection
