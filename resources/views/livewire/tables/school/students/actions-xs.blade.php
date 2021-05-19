@hasAbility('students.edit')
    @if(!$record->isEnrolled())
        <div class='tooltip'>
            <i wire:click="enroll({{$record->id}})" class='cursor-pointer fa fa-graduation-cap fa-lg fa-fw text-cool-gray-400 hover:text-purple-500'></i>
            <span class='tooltiptext tooltiptext-center-left'>{{ transup('enroll') }}</span>
        </div>
    @else
        {{--
            <div class='tooltip'>
                <i wire:click="unenroll({{$record->id}})" class='cursor-pointer fa fa-graduation-cap fa-lg fa-fw text-cool-gray-400 hover:text-red-400'></i>
                <span class='tooltiptext tooltiptext-center-left'>{{ transup('unenroll') }}</span>
            </div>
        --}}
    @endif
@endhasAbility
