<x-lopsoft.datatable.row-column
    canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
    class="{{ 'text-right' }}"
    link="{{ route($table.'.show',$item->id) }}">
        {!! ($item->priority==0)?"<i class='fa fa-lock'></i>":$item->priority !!}
</x-lopsoft.datatable.row-column>
