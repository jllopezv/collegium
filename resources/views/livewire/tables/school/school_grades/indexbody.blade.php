@include('components.lopsoft.datatable.rowcolumn', ['slot'=> ($item->priority==0)?"<i class='fa fa-lock'></i>":$item->priority, 'classrow' => 'text-right'])
@include('components.lopsoft.datatable.setpriority')
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->grade])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->level!=null?$item->level->level:null ])
