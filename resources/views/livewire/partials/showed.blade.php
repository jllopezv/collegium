<div class='flex items-center justify-end '>
    @isSuperadmin
        @if($mode=='edit')
            <div class='mr-2'><x-lopsoft.button.info wire:click='resetShowed' icon='fa fa-power-off' help='RESETEAR VISITAS' helpclass='tooltiptext-down-left' buttonxs/></div>
        @endif
        <div class='tooltip'>
            <div class='flex items-center justify-end'>
                <x-lopsoft.control.input
                    wire:model.lazy='showed'
                    id='showed'
                    x-ref='showed'
                    class='text-right'
                    classcontainer='w-28'
                    mode="{{ $mode }}"
                />
                <div>
                    <i class='ml-2 fa fa-eye text-green-400'></i>
                </div>
                <span class='tooltiptext tooltiptext-down-left'>VISITADO</span>
            </div>
        </div>
    @else
    <div class='mr-2'>
        <div class='tooltip'>
            <div class='flex items-center justify-end'>
                {{ $showed }}
                <div>
                    <i class='ml-2 fa fa-eye text-green-400'></i>
                </div>
                <span class='tooltiptext tooltiptext-down-left'>VISITADO</span>
            </div>
        </div>
    </div>
    @endisSuperadmin
</div>
