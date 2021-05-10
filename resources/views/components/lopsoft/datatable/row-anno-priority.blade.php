@if(!$showOnlyAnno)
    @include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->annosToLabel(), 'classrow' => 'text-center' ])
@endif
