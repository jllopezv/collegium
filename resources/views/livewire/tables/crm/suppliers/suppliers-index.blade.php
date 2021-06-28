@extends('livewire.layouts.indexlayout', [ 'minwidth' => '1200px'])

@section('header')
    @if(appsetting('suppliers_avatar'))
        <x-lopsoft.datatable.header-th class='w-16' justify='center'>{{ transup('photo') }}</x-lopsoft.datatable.header-th>
    @endif
    <x-lopsoft.datatable.header-th class='w-80' sortable sortorder='{{ $sortorder }}' columnname='supplier'>{{ transup('supplier')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-60' sortable sortorder='{{ $sortorder }}' columnname='rnc' >{{ transup('rnc')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-40' sortable sortorder='{{ $sortorder }}' columnname='supplier_type_id' >{{ transup('type')}}</x-lopsoft.datatable.header-th>
@endsection

@section('filters')
    <div class='flex flex-wrap items-center justify-start'>
        <div class='w-full mr-2 md:w-auto'>
            @livewire('controls.index-filter-component', [
                'mode'          => $mode,
                'label'         => transup('type'),
                'classdropdown' => 'w-full md:w-60 mr-2 ',
                'options'       => \App\Lopsoft\LopHelp::getFilterDropdownBuilder(\App\Models\Crm\SupplierType::query(), 'id', 'type', '', true, 'type'),
                'defaultvalue'  => '*',
                'eventname'     => 'eventfiltertype',
                'uid'           => 'filtertypecomponent',
                'modelid'       => 'type_id',
                'isTop'         =>  false,
            ])
        </div>
    </div>
@endsection

