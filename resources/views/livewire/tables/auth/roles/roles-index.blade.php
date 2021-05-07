@extends('livewire.layouts.indexlayout')

@section('header')
<x-lopsoft.datatable.header-th class='w-60'  sortable sortorder='{{ $sortorder }}' columnname='role'>{{ transup('role') }}</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th class='w-3/4' sortable sortorder='{{ $sortorder }}' columnname='level'>{{ transup('level') }}</x-lopsoft.datatable.header-th>
@endsection
