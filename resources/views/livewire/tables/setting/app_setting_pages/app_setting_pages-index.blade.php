@extends('livewire.layouts.indexlayout', [ 'minwidth' => '800px'])

@section('header')
    <x-lopsoft.datatable.header-th class='w-16'  justify='end' sortable sortorder='{{ $sortorder }}' columnname='id'>ID</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-24' justify='end' sortable sortorder='{{ $sortorder }}' columnname='priority'>{{ transup('order') }}</x-lopsoft.datatable.header-th>
    @include('components.lopsoft.datatable.header-setpriority')
    <x-lopsoft.datatable.header-th class='w-full' sortable sortorder='{{ $sortorder }}' columnname='settingpage'>{{ transup('page') }}</x-lopsoft.datatable.header-th>
    @isSuperadmin
        <x-lopsoft.datatable.header-th class='w-16' justify='center' sortable sortorder='{{ $sortorder }}' columnname='onlysuperadmin'><i class='fa fa-user-shield fa-fw'></i></x-lopsoft.datatable.header-th>
    @endisSuperadmin
@endsection

@section('headerxs')
@endsection
