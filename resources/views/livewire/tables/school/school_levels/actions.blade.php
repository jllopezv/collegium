@if($showOnlyAnno=="true" && $record->isInAnno())
    <div class='tooltip'>
        <i wire:click="showStudentsLevel({{$record->id}})" class='cursor-pointer fa fa-graduation-cap fa-lg fa-fw text-cool-gray-400 hover:text-cool-gray-600'></i>
        <span class='tooltiptext tooltiptext-center-left'>{{ transup('students') }}</span>
    </div>
@endif


