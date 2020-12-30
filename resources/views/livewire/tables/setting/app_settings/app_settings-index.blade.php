@extends('livewire.layouts.indexlayout', ['minwidth' => '500px'])

@section('header')
    <x-lopsoft.datatable.header-th class='w-16'  justify='end' sortable sortorder='{{ $sortorder }}' columnname='id'>ID</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-60' sortable sortorder='{{ $sortorder }}' columnname='settingkey'>{{ transup('key') }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-full' sortable sortorder='{{ $sortorder }}' columnname='settingvalue'> {{ transup('value') }} </x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-16' justify='center' sortable sortorder='{{ $sortorder }}' columnname='type'>{{ transup('type') }}</x-lopsoft.datatable.header-th>
@endsection

@section('headerxs')
@endsection
