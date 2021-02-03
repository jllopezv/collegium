@extends('livewire.layouts.indexlayout', [ 'minwidth' => '500px'])

@section('header')
<x-lopsoft.datatable.header-th class='w-24' justify='end' sortable sortorder='{{ $sortorder }}' columnname='priority'>{{ transup('priority')}}</x-lopsoft.datatable.header-th>
@include('components.lopsoft.datatable.header-setpriority')
<x-lopsoft.datatable.header-th width='w-full' sortable sortorder='{{ $sortorder }}' columnname='level'>{{ transup('level')}}</x-lopsoft.datatable.header-th>
@endsection

@section('headerxs')
@endsection
