@hasAbility('records.activateanno')
    @if(!$record->isInAnno())
        <div class='tooltip'>
            <i wire:click="activateRecordInAnno({{$record->id}})" class='cursor-pointer fa fa-play fa-lg fa-fw text-cool-gray-400 hover:text-blue-400'></i>
            <span class='tooltiptext tooltiptext-center-left'>{{ transup('open_this_year') }}</span>
        </div>
    @else
        <div class='tooltip'>
            <i wire:click="deactivateRecordInAnno({{$record->id}})" class='cursor-pointer fa fa-pause fa-lg fa-fw text-cool-gray-400 hover:text-red-400'></i>
            <span class='tooltiptext tooltiptext-center-left'>{{ transup('close_this_year') }}</span>
        </div>
    @endif
@endhasAbility
