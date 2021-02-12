@include('components.lopsoft.datatable.row-priority')
@include('components.lopsoft.datatable.setpriority')
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->grade])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->level!=null?$item->level->level:null ])
