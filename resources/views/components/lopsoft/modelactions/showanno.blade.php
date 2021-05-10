<div x-show='$wire.showOnlyAnno' class='mr-1'>
    <x-lopsoft.button.gray
        wire:click='hideAnno'
        icon='far fa-calendar-times'
        help='MOSTRAR TODOS' helpclass='tooltiptext-up-right'>
    </x-lopsoft.button.gray>
</div>
<div x-cloak x-show='!$wire.showOnlyAnno' class='mr-1'>
    <x-lopsoft.button.danger
        wire:click='showAnno'
        icon='far fa-calendar-check'
        help='MOSTRAR SOLO AÑO ACTUAL' helpclass='tooltiptext-up-right'>
    </x-lopsoft.button.danger>
</div>
