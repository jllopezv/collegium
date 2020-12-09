@include('components.lopsoft.datatable.rowcolumnavatar')
<x-lopsoft.datatable.row-column
    canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
    link="{{ route($table.'.show',$item->id) }}">
    <div class=''>
        {{ $item->exp }}
    </div>
    <div class='font-bold'>
        {{ $item->name }}
    </div>
</x-lopsoft.datatable.row-column>
