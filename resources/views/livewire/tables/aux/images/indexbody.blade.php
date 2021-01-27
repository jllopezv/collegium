<x-lopsoft.datatable.row-column-image
    canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
    class="{{ $classrow??'' }} "
    link="{{ route($table.'.show',$item->id) }}"
    justify='center'
    image='{{ $item->urlImage }}'
    imageclass='rounded-lg shadow-lg'
    classcontainer="{{ config('lopsoft.images_index_showthumb')?'h-26':'h-20' }}"
/>

@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->tag ])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->imageable_type ])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->imageable_id ])
