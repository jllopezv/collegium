<div class='mt-1 text-center'>
    <div class='font-bold '>{!! $item->settingkey !!}</div>
    <div class='text-xs font-bold text-cool-gray-600'>{{ $item->page->settingpage }}</div>
    <div class=''>
        @switch($item->type)
            @case('text')
                <i class='text-cool-gray-400 fa fa-keyboard fa-fw'></i> <span class='text-gray-600'> {{ $item->settingvalue }}</span>
            @break
            @case('number')
                <i class='text-green-300 fa fa-calculator fa-fw'></i> <span class='text-gray-600'> {{ $item->settingvalue }}</span>
            @break
            @case('boolean')
                @if($item->settingvalue=='true')
                    <i class='text-blue-400 fa fa-toggle-on fa-fw'></i>
                @else
                    <i class='text-red-400 fa fa-toggle-off fa-fw'></i>
                @endif
            @break
            @case('image')
                <i class='text-orange-300 fa fa-image fa-fw'></i> <span class='text-gray-600'> {{ $item->settingvalue }}</span>
            @break
        @endswitch
    </div>
</div>
