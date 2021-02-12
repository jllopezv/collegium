@extends('livewire.layouts.indexlayout', [ 'minwidth' => '1000px'])

@section('header')
<x-lopsoft.datatable.header-th class='w-24' justify='end' sortable sortorder='{{ $sortorder }}' columnname='priority'>{{ transup('priority')}}</x-lopsoft.datatable.header-th>
@include('components.lopsoft.datatable.header-setpriority')
<x-lopsoft.datatable.header-th width='w-full' sortable sortorder='{{ $sortorder }}' columnname='section'>{{ transup('section')}}</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th width='w-full' sortable sortorder='{{ $sortorder }}' columnname='grade'>{{ transup('grade')}}</x-lopsoft.datatable.header-th>
@endsection

@section('headerxs')
@endsection
