<div class='flex items-center justify-end w-full bg-gray-700 p-3'>
    @if($record->employee!=null)
        <div class=''>
            <div class='text-right'>
                <div class='tooltip'>
                    <a href="{{ route($record->employee->getTable().'.show', ['id' => $record->employee->id] ) }}">
                        <i class='cursor-pointer fa fa-hard-hat fa-lg fa-fw text-cool-gray-400 hover:text-blue-400'></i>
                    </a>
                    <span class='tooltiptext tooltiptext-up-left'>EMPLEADO</span>
                </div>
            </div>
        </div>
    @endif
    @hasAbility($table.".login")
        @if($record->user->id!=Auth::user()->id)
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
