@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->permissiongroup!=null?$item->permissiongroup->group:'' ])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->slug])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->name])
