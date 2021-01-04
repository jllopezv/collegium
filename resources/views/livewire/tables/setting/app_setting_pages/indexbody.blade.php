@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->priority, 'classrow' => 'text-right'])
@include('components.lopsoft.datatable.setpriority')
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->settingpage ])
@isSuperadmin
<x-lopsoft.datatable.row-column
    canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
    link="{{ route($table.'.show',$item->id) }}" >
        <div class='text-center'>
            @if($item->onlysuperadmin)
                <i class='text-green-400 fa fa-check fa-fw'></i>
            @else
                <i class='text-red-400 fa fa-times fa-fw'></i>
            @endif
        </div>
</x-lopsoft.datatable.row-column>
@endisSuperadmin
