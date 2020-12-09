<x-lopsoft.datatable.row-column-avatar
    canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
    class="{{ $classrow??'' }}"
    link="{{ route($table.'.show',$item->id) }}"
    justify='center'
    avatar='{{ $item->avatar }}'
/>
