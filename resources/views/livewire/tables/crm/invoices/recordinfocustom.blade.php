<div class='flex items-center justify-end w-full bg-gray-700 p-3'>
    @hasAbility($table.".login")
        @if($record->user!=null && $record->user->id!=Auth::user()->id)
            <div class=''>
                <div class='text-right'>
                    <div class='tooltip'>
                        <i wire:click="login('{{ $table }}',{{ $record->user->id }})" class='cursor-pointer fa fa-sign-in fa-lg fa-fw text-cool-gray-400 hover:text-green-300'></i>
                        <span class='tooltiptext tooltiptext-up-left'>LOGIN</span>
                    </div>
                </div>
            </div>
        @endif
    @endhasAbility
</div>
