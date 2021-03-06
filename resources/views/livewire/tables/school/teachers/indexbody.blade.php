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

<x-lopsoft.datatable.row-column-space />
@include('components.lopsoft.datatable.row-anno-priority')
@include('components.lopsoft.datatable.row-priority')
@include('components.lopsoft.datatable.setpriority')
