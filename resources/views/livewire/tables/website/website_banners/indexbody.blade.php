<x-lopsoft.datatable.row-column-image
    canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
    class="{{ $classrow??'' }}"
    link="{{ route($table.'.show',$item->id) }}"
    justify='center'
    image="{{ getImage(is_null($item->image)?'':$item->image->image, config('lopsoft.banners_index_showthumb')) }}"
    imageclass='rounded-lg'
    classcontainer="{{ config('lopsoft.banners_index_showthumb')?'h-26':'h-12' }}"
/>
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->banner])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->width."x".$item->height, 'classrow' => 'text-right' ])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> count($item->images), 'classrow' => 'text-right' ])
