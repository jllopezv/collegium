<x-lopsoft.datatable.row-column-image
    canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
    class="{{ $classrow??'' }} "
    link="{{ route($table.'.show',$item->id) }}"
    justify='center'
    image='{{ $item->postImage }}'
    imageclass='rounded-lg shadow-lg'
    classcontainer="{{ config('lopsoft.posts_index_showthumb')?'h-26':'h-20' }}"
/>
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->title ])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->category->categoryName ])
