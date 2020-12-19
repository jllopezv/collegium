@hasAbility($table.".login")
    @if($itemid!=Auth::user()->id)
        {{-- Login --}}
        <div class='tooltip'>
            <i wire:click="login({{ $itemid }})" class='cursor-pointer fa fa-sign-in fa-lg fa-fw text-cool-gray-400 hover:text-cool-gray-600'></i>
            <span class='tooltiptext tooltiptext-down-left'>LOGIN</span>
        </div>
    @endif
@endhasAbility
