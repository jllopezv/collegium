@extends('livewire.layouts.indexlayout')

@section('header')
    <x-lopsoft.datatable.header-th class='w-24' sortable sortorder='{{ $sortorder }}' columnname='flag' >{{ transup('flag')  }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-60' sortable sortorder='{{ $sortorder }}' columnname='country' >{{ transup('country')  }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-32' sortable sortorder='{{ $sortorder }}' columnname='iso' >{{ transup('code') }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-60' sortable sortorder='{{ $sortorder }}' columnname='iso3' >{{ transup('alpha3')  }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-60' sortable sortorder='{{ $sortorder }}' columnname='phonecode' >{{ transup('phonecode')  }}</x-lopsoft.datatable.header-th>
@endsection

