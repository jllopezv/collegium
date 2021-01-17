<x-lopsoft.datatable.row-column-image
    canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
    class="{{ $classrow??'' }}"
    link="{{ route($table.'.show',$item->id) }}"
    justify='center'
    image='{{ $item->postImage }}'
    classcontainer='h-28'
/>
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->title])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->category->categoryName ])
