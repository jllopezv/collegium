@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->priority, 'classrow' => 'text-right'])
@include('components.lopsoft.datatable.setpriority')
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->grade])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->level!=null?$item->level->level:null ])
