@extends('livewire.layouts.indexlayout', [ 'minwidth' => '1200px'])

@section('header')
    <x-lopsoft.datatable.header-th class='w-16' justify='center'>{{ transup('photo') }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-80' sortable sortorder='{{ $sortorder }}' columnname='teacher'>{{ transup('teacher')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-40' >{{ transup('username')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-60' >{{ transup('email')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th-space class='w-full'></x-lopsoft.datatable.header-th-space>
    @include('components.lopsoft.datatable.header-anno-priority')
@endsection

@section('modelactions')
    @include('components.lopsoft.modelactions.showanno')
    @include('components.lopsoft.modelactions.showpriority')
@endsection
