<div class='tooltip'>
    <i wire:click="showStudentsAnno({{$itemid}})" class='cursor-pointer fa fa-graduation-cap fa-lg fa-fw text-cool-gray-400 hover:text-cool-gray-600'></i>
    <span class='tooltiptext tooltiptext-center-left'>{{ transup('students') }}</span>
</div>
@if(!$record->current)
    {{-- Login --}}
    <div class='tooltip'>
        <i wire:click="setCurrent({{ $itemid }})" class='text-green-400 cursor-pointer far fa-check-circle fa-lg fa-fw hover:text-green-600'></i>
        <span class='tooltiptext tooltiptext-center-left'>SELECCIONAR</span>
    </div>
@endif
