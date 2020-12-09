@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->language])
<x-lopsoft.datatable.row-column
    canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
    link="{{ route($table.'.show',$item->id) }}">
    <div class='flex items-center justify-start'>
        <div class=''>
            {!! $item->flag !!}
        </div>
        <div class='pt-1 pl-2'>
            {{ strtoupper($item->code) }}
        </div>
    </div>
</x-lopsoft.datatable.row-column>
