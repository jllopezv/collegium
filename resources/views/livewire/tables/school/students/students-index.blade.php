@extends('livewire.layouts.indexlayout')

@section('header')
    <x-lopsoft.datatable.header-th class='w-24' justify='end' sortable sortorder='{{ $sortorder }}' columnname='priority'>{{ transup('priority')}}</x-lopsoft.datatable.header-th>
    @include('components.lopsoft.datatable.header-setpriority')
    <x-lopsoft.datatable.header-th class='w-16' justify='center'>{{ transup('photo') }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-full' sortable sortorder='{{ $sortorder }}' columnname='first_surname'>{{ transup('student')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-full' sortable sortorder='{{ $sortorder }}' columnname='grade_id'>{{ transup('grade')}}</x-lopsoft.datatable.header-th>
@endsection

@section('headerxs')
@endsection
