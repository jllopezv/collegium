@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->showorder])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->grade])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->level!=null?$item->level->level:null ])
