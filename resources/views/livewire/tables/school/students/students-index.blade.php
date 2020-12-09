@extends('livewire.layouts.indexlayout')

@section('header')
    <x-lopsoft.datatable.header-th class='w-16' justify='end' sortable sortorder='{{ $sortorder }}' columnname='id'>ID</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-16' justify='center'>{{ transup('photo') }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th width='w-full' sortable sortorder='{{ $sortorder }}' columnname='first_surname'>{{ transup('student')}}</x-lopsoft.datatable.header-th>
@endsection

@section('headerxs')
@endsection
