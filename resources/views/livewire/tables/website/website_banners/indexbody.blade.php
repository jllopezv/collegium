<x-lopsoft.datatable.row-column-image
    canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
    class="{{ $classrow??'' }}"
    link="{{ route($table.'.show',$item->id) }}"
    justify='center'
    image='{{ $item->postImage }}'
    classcontainer="{{ config('lopsoft.posts_index_showthumb')?'h-26':'h-20' }}"
/>
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->banner])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->width."x".$item->height ])
