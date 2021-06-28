@if(appsetting('suppliers_avatar'))
    <x-lopsoft.datatable.row-column-avatar
        canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
        class="{{ $classrow??'' }}"
        link="{{ route($table.'.show',$item->id) }}"
        justify='center'
        avatar="{{ $item->avatar }}"
    />
@endif
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->supplier, 'classrow' => 'font-bold'])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->rnc ])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->type->type??''])

