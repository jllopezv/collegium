@hasAbility('users.changeannosession')
    <div x-show='$wire.showOnlyAnno' class='mr-1 mb-1'>
        <x-lopsoft.button.gray
            wire:click='hideAnnoGrid'
            icon='far fa-calendar-times fa-fw'
            help='MOSTRAR TODOS' helpclass='tooltiptext-up-right'>
        </x-lopsoft.button.gray>
    </div>
    <div x-cloak x-show='!$wire.showOnlyAnno'class='mr-1 mb-1'>
        <x-lopsoft.button.coolgray
            wire:click='showAnnoGrid'
            icon='far fa-calendar-check fa-fw'
            help='MOSTRAR SOLO AÑO ACTUAL' helpclass='tooltiptext-up-right'>
        </x-lopsoft.button.coolgray>
    </div>
@endhasAbility
