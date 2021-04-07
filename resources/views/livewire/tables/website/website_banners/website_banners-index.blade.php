@extends('livewire.layouts.indexlayout', [ 'minwidth' => '950px'])

@section('header')
<x-lopsoft.datatable.header-th class='w-28' justify='center'>{{ transup('image') }}</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th class='w-60' sortable sortorder='{{ $sortorder }}' columnname='banner'>{{ transup('banner')}}</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th class='w-32' justify='end'><i class='fa fa-arrows-alt-h'></i> x <i class='fa fa-arrows-alt-v'></i></x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th class='w-24' justify='end'><i class='fa fa-image'></i></x-lopsoft.datatable.header-th>
@endsection

@section('headerxs')
@endsection
