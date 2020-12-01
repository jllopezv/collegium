<x-lopsoft.button.danger icon='fa fa-trash' wire:click='destroyBatch' />
@if (property_exists($model,'hasactive'))
    <x-lopsoft.button.warning wire:click='lockBatch' help='BLOQUEAR REGISTRO' helpclass='tooltiptext-up-right' class='ml-1' icon='fa fa-lock' />
    <x-lopsoft.button.success wire:click='unlockBatch' help='DESBLOQUEAR REGISTRO' helpclass='tooltiptext-up-right' class='ml-1' icon='fa fa-unlock' />
@endif
