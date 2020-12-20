@if(!$record->current)
    {{-- Login --}}
    <div class='tooltip'>
        <i wire:click="setCurrent({{ $itemid }})" class='text-green-400 cursor-pointer far fa-check-circle fa-lg fa-fw hover:text-green-600'></i>
        <span class='tooltiptext tooltiptext-center-left'>SELECCIONAR</span>
    </div>
@endif
