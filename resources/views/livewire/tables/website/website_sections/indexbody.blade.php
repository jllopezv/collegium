@include('components.lopsoft.datatable.row-priority')
@include('components.lopsoft.datatable.setpriority')
<x-lopsoft.datatable.row-column-image
    canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
    class="{{ $classrow??'' }} "
    link="{{ route($table.'.show',$item->id) }}"
    justify='center'
    image='{{ $item->sectionImage }}'
    imageclass='rounded-lg'
    classcontainer="{{ config('lopsoft.sections_index_showthumb')?'h-26':'h-28' }}"
/>
<x-lopsoft.datatable.row-column
    canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
    link="{{ route($table.'.show',$item->id) }}">
    {!! $item->getStatusFormatted() !!}
</x-lopsoft.datatable.row-column>
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->title ])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->category->categoryName ])
