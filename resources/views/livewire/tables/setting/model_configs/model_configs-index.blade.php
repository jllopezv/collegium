@extends('livewire.layouts.indexlayout', [ 'minwidth' => '500px'])

@section('header')
<x-lopsoft.datatable.header-th class='w-16' justify='end' sortable sortorder='{{ $sortorder }}' columnname='id'>ID</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th class='w-80' >{{ transup('model') }}</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th class='w-12' justify='end' >{{ transup('id') }}</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th class='pl-10 w-80' >{{ transup('data') }}</x-lopsoft.datatable.header-th>
@endsection

@section('headerxs')
@endsection
