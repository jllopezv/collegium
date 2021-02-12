@include('components.lopsoft.datatable.row-priority')
@include('components.lopsoft.datatable.setpriority')
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

@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->grade->grade ])
