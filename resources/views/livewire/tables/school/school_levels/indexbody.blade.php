@include('components.lopsoft.datatable.rowcolumn', ['slot'=> ($item->priority==0)?"<i class='fa fa-lock fa-xs text-gra-600'></i>":$item->priority, 'classrow' => 'text-right'])
@include('components.lopsoft.datatable.setpriority')
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->level])
