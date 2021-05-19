@hasAbility('records.changepriority')
    @if($data!=null && $data->count()>0)
        <div x-show='!$wire.showPriority' class='mr-1 mb-1'>
            <x-lopsoft.button.gray
                wire:click='showPriority'
                icon='fa fa-sort fa-fw'
                help='MOSTRAR ORDEN' helpclass='tooltiptext-up-right'>
            </x-lopsoft.button.gray>
        </div>
        <div x-cloak x-show='$wire.showPriority' class='mr-1 mb-1'>
            <x-lopsoft.button.coolgray
                wire:click='hidePriority'
                icon='fa fa-arrows-h fa-fw'
                help='OCULTAR ORDEN' helpclass='tooltiptext-up-right'>
            </x-lopsoft.button.coolgray>
        </div>
    @endif
@endhasAbility
