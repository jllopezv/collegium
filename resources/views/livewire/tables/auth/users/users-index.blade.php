@extends('livewire.layouts.indexlayout', ['minwidth' => '1300px'] )

@section('header')
    <x-lopsoft.datatable.header-th class='w-16' justify='center'>{{ transup('photo') }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-80' sortable sortorder='{{ $sortorder }}' columnname='name'>{{ transup('name') }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-32' sortable sortorder='{{ $sortorder }}' columnname='username'>{{ transup('username') }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-32' justify='end' columnname='level'>{{ transup('level') }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-48' columnname='roles'>{{ transup('roles') }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-20' >{{ transup('country') }}</x-lopsoft.datatable.header-th>
@endsection
