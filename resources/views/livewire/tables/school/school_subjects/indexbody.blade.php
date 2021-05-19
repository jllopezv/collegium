@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->code])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->subject])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->grade->grade??'' ])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->period->period??'' ])
<x-lopsoft.datatable.row-column-space />
@include('components.lopsoft.datatable.row-anno-priority')
@include('components.lopsoft.datatable.row-priority')
@include('components.lopsoft.datatable.setpriority')
