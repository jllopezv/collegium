<div class='flex items-center justify-end w-full bg-gray-700 p-3'>
    @isAdmin
        @if($record->profile!=null)
            <div class=''>
                <div class='text-right'>
                    <div class='tooltip'>
                        <a href="{{ route($record->profile->getTable().'.show', ['id' => $record->profile->id] ) }}">
                            <i class='cursor-pointer fa fa-user-circle fa-lg fa-fw text-cool-gray-400 hover:text-blue-400'></i>
                        </a>
                        <span class='tooltiptext tooltiptext-up-left'>PERFIL</span>
                    </div>
                </div>
            </div>
        @endif
    @endisAdmin
    @hasAbility($table.".login")
        @if($record->id!=Auth::user()->id)
            <div class=''>
                <div class='text-right'>
                    <div class='tooltip'>
                        <i wire:click="login({{ $record->id }})" class='cursor-pointer fa fa-sign-in fa-lg fa-fw text-cool-gray-400 hover:text-green-300'></i>
                        <span class='tooltiptext tooltiptext-up-left'>LOGIN</span>
                    </div>
                </div>
            </div>
        @endif
    @endhasAbility
</div>
