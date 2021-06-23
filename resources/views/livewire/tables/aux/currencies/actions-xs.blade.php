@if(!$record->current)
    <div class='tooltip'>
        <i wire:click="setCurrent({{ $itemid }})" class='text-green-400 cursor-pointer far fa-check-circle fa-lg fa-fw hover:text-green-600'></i>
        <span class='tooltiptext tooltiptext-center-left'>SELECCIONAR</span>
    </div>
    <div class='tooltip'>
        <i wire:click="updateCurrencyManual({{ $itemid }})" class='text-cool-gray-400 hover:cool-gray-600  cursor-pointer far fa-download fa-lg fa-fw'></i>
        <span class='tooltiptext tooltiptext-center-left'>ACTUALIZAR TASA</span>
    </div>
@endif
