@extends('livewire.layouts.indexlayout', [ 'minwidth' => '1000px'])

@section('header')
    <x-lopsoft.datatable.header-th class='w-full' sortable sortorder='{{ $sortorder }}' columnname='section'>{{ transup('period')}}</x-lopsoft.datatable.header-th>
    @include('components.lopsoft.datatable.header-anno-priority')
@endsection

@section('modelactions')
    @include('components.lopsoft.modelactions.showanno')
@endsection
