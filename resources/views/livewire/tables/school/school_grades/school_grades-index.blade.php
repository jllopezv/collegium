@extends('livewire.layouts.indexlayout', [ 'minwidth' => '500px'])

@section('header')
<x-lopsoft.datatable.header-th class='w-16' justify='end' sortable sortorder='{{ $sortorder }}' columnname='id'>ID</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th class='w-24' sortable sortorder='{{ $sortorder }}' columnname='showorder'>{{ transup('showorder')}}</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th width='w-full' sortable sortorder='{{ $sortorder }}' columnname='grade'>{{ transup('grade')}}</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th width='w-full' sortable sortorder='{{ $sortorder }}' columnname='level'>{{ transup('level')}}</x-lopsoft.datatable.header-th>
@endsection

@section('headerxs')
@endsection
