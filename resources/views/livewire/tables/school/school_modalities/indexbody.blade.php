@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->modality])
<x-lopsoft.datatable.row-column-space />
@include('components.lopsoft.datatable.row-anno-priority')
@include('components.lopsoft.datatable.row-priority')
@include('components.lopsoft.datatable.setpriority')
