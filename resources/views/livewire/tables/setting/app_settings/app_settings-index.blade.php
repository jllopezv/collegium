@extends('livewire.layouts.indexlayout', ['minwidth' => '1200px'])

@section('header')
    <x-lopsoft.datatable.header-th class='w-16'  justify='end' sortable sortorder='{{ $sortorder }}' columnname='id'>ID</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-24' justify='end' sortable sortorder='{{ $sortorder }}' columnname='priority'>{{ transup('order') }}</x-lopsoft.datatable.header-th>
    @include('components.lopsoft.datatable.header-setpriority')
    <x-lopsoft.datatable.header-th class='w-36' sortable sortorder='{{ $sortorder }}' columnname='page_id'>{{ transup('page') }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-60' sortable sortorder='{{ $sortorder }}' columnname='settingkey'>{{ transup('key') }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-full' sortable sortorder='{{ $sortorder }}' columnname='settingvalue'> {{ transup('value') }} </x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-16' justify='center' sortable sortorder='{{ $sortorder }}' columnname='type'>{{ transup('type') }}</x-lopsoft.datatable.header-th>
@endsection

@section('headerxs')
@endsection
