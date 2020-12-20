@extends('livewire.layouts.indexlayout', [ 'minwidth' => '500px'])

@section('header')
<x-lopsoft.datatable.header-th class='w-16' justify='end' sortable sortorder='{{ $sortorder }}' columnname='id'>ID</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th class='w-48' sortable sortorder='{{ $sortorder }}' columnname='anno'>{{ transup('anno')}}</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th class='w-36' sortable sortorder='{{ $sortorder }}' columnname='anno_start'>{{ transup('start')}}</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th class='w-36' sortable sortorder='{{ $sortorder }}' columnname='anno_end'>{{ transup('end')}}</x-lopsoft.datatable.header-th>
@endsection

@section('headerxs')
@endsection
