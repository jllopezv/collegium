<x-lopsoft.datatable.row-column-avatar
    canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
    class="{{ $classrow??'' }}"
    link="{{ route($table.'.show',$item->id) }}"
    justify='center'
    avatar="{{ Str::contains($item->avatar, config('lopsoft.default_avatar'))?$item->user->avatar:$item->avatar }}"
/>
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->employee, 'classrow' => 'font-bold'])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->type->type??''])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> "<div class='text-gray-600 font-bold'>".getDateString($item->hired)."</div><div class='text-sm'>".getHiredTime($item->hired)."</div>" ])

<x-lopsoft.datatable.row-column-space />
@include('components.lopsoft.datatable.row-anno-priority')
@include('components.lopsoft.datatable.row-priority')
@include('components.lopsoft.datatable.setpriority')
