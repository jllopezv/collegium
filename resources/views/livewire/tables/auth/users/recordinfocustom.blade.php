@hasAbility($table.".login")
    @if($record->id!=Auth::user()->id)
        <div class='w-full p-3 bg-gray-700'>
            <div class='text-right'>
                <div class='tooltip'>
                    <i wire:click="login({{ $record->id }})" class='cursor-pointer fa fa-sign-in fa-lg fa-fw text-cool-gray-400 hover:text-green-300'></i>
                    <span class='tooltiptext tooltiptext-center-left'>LOGIN</span>
                </div>
            </div>
        </div>
    @endif
@endhasAbility
