@extends('livewire.layouts.indexlayout', [ 'minwidth' => '1200px'])

@section('modelactions')
    @include('components.lopsoft.modelactions.updaterate')
@endsection

@section('header')
    <x-lopsoft.datatable.header-th class='w-80' sortable sortorder='{{ $sortorder }}' columnname='currency'>{{ transup('currency')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-32' sortable sortorder='{{ $sortorder }}' columnname='code'>{{ transup('code')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-32' justify='end' sortable sortorder='{{ $sortorder }}' columnname='rate'>{{ transup('rate')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-full' justify='end'>{{ transup('preview')}}</x-lopsoft.datatable.header-th>
@endsection
