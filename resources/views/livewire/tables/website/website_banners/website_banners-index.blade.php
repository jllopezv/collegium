@extends('livewire.layouts.indexlayout', [ 'minwidth' => '500px'])

@section('header')
<x-lopsoft.datatable.header-th class='w-16' justify='end' sortable sortorder='{{ $sortorder }}' columnname='id'>ID</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th class='w-28' justify='center'>{{ transup('image') }}</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th width='w-full' sortable sortorder='{{ $sortorder }}' columnname='banner'>{{ transup('banner')}}</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th width='w-full' sortable sortorder='{{ $sortorder }}' columnname='width'>{{ transup('width')."x".transup('height') }}</x-lopsoft.datatable.header-th>
@endsection

@section('headerxs')
@endsection
