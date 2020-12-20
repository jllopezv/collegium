@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->anno ])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> getDateString($item->anno_start) ])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> getDateString($item->anno_end) ])
