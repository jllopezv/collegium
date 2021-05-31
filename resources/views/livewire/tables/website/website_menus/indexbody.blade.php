@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->menu])
<x-lopsoft.datatable.row-column
    canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
    link="{{ route($table.'.show',$item->id) }}" >
        @if($item->link!='')
            <i class='fa fa-link text-blue-300'></i> {{ $item->link }}
        @else
            @if($item->page!='')
                <i class='fa fa-file-alt text-orange-300'></i> {{ $item->page->page }}
            @endif
        @endif
</x-lopsoft.datatable.row-column>
@include('components.lopsoft.datatable.row-priority')
@include('components.lopsoft.datatable.setpriority')
