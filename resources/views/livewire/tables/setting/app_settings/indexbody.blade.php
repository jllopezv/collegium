@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->priority, 'classrow' => 'text-right'])
@include('components.lopsoft.datatable.setpriority')
<x-lopsoft.datatable.row-column
    canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
    link="{{ route($table.'.show',$item->id) }}" >
        <div class=''>
            {{ $item->page->settingpage }}
        </div>
</x-lopsoft.datatable.row-column>
<x-lopsoft.datatable.row-column
    canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
    link="{{ route($table.'.show',$item->id) }}" >
    {{ $item->settingkey }}
</x-lopsoft.datatable.row-column>
<x-lopsoft.datatable.row-column
    canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
    link="{{ route($table.'.show',$item->id) }}" >
    <div class=''>
        @switch($item->type)
            @case('text')
                <i class='text-cool-gray-400 fa fa-keyboard fa-fw'></i> {{ $item->settingvalue }}
            @break
            @case('number')
                <i class='text-green-300 fa fa-calculator fa-fw'></i> {{ $item->settingvalue }}
            @break
            @case('boolean')
                @if($item->settingvalue=='true')
                    <i class='text-blue-400 fa fa-toggle-on fa-fw'></i>
                @else
                    <i class='text-red-400 fa fa-toggle-off fa-fw'></i>
                @endif
            @break
            @case('image')
                <i class='text-orange-300 fa fa-image fa-fw'></i> {{ $item->settingvalue }}
            @break
        @endswitch
    </div>
</x-lopsoft.datatable.row-column>
<x-lopsoft.datatable.row-column
    canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
    link="{{ route($table.'.show',$item->id) }}" >
    <div class='flex items-center justify-center'>
        @switch($item->type)
            @case('text')
                <i class='text-cool-gray-400 fa fa-keyboard fa-fw'></i>
            @break
            @case('number')
                <i class='text-green-300 fa fa-calculator fa-fw'></i>
            @break
            @case('boolean')
                <i class='text-blue-400 fa fa-toggle-on fa-fw'></i>
            @break
            @case('image')
                <i class='text-orange-300 fa fa-image fa-fw'></i>
            @break
        @endswitch
    </div>
</x-lopsoft.datatable.row-column>

