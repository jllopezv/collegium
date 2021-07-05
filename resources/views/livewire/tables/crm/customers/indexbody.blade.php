@if(appsetting('customers_avatar'))
    <x-lopsoft.datatable.row-column-avatar
        canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
        class="{{ $classrow??'' }}"
        link="{{ route($table.'.show',$item->id) }}"
        justify='center'
        avatar="{{ $item->avatar }}"
    />
@endif
<x-lopsoft.datatable.row-column
    canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
    class="{{ $classrow??'' }}"
    link="{{ route($table.'.show',$item->id) }}">
        <div class='text-gray-500 font-bold'>{!! $item->code !!}</div>
        <div class='font-bold'>{!! $item->customer !!}</div>
</x-lopsoft.datatable.row-column>
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->rnc ])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->type->type??''])

