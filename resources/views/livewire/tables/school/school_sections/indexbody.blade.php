@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->section])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->grade!=null?$item->grade->grade:null ])
<x-lopsoft.datatable.row-column-space />
@include('components.lopsoft.datatable.row-anno-priority')
@include('components.lopsoft.datatable.row-priority')
@include('components.lopsoft.datatable.setpriority')
