<x-lopsoft.datatable.row-column-avatar
    canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
    class="{{ $classrow??'' }}"
    link="{{ route($table.'.show',$item->id) }}"
    justify='center'
    avatar='{{ $item->avatar }}'
/>
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->teacher, 'classrow' => 'font-bold'])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->user->username??''])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->user->email??''])
