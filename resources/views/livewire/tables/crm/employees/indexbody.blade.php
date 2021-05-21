<x-lopsoft.datatable.row-column-avatar
    canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
    class="{{ $classrow??'' }}"
    link="{{ route($table.'.show',$item->id) }}"
    justify='center'
    avatar='{{ $item->avatar }}'
/>
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->employee, 'classrow' => 'font-bold'])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->type])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->user->email??''])
